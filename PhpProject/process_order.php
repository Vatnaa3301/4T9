<?php
header('Content-Type: application/json');
require_once 'includes/db.php';

// Get JSON data from request
$input = file_get_contents('php://input');
$orderData = json_decode($input, true);

if (!$orderData) {
    echo json_encode(['success' => false, 'message' => 'Invalid order data']);
    exit;
}

try {
    // Start transaction
    $pdo->beginTransaction();
    
    // Create orders table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_number VARCHAR(50) UNIQUE NOT NULL,
        customer_name VARCHAR(255) NOT NULL,
        customer_phone VARCHAR(50) NOT NULL,
        customer_email VARCHAR(255) NOT NULL,
        total_amount DECIMAL(10, 2) NOT NULL,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create order_items table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT NOT NULL,
        category VARCHAR(50) NOT NULL,
        product_name VARCHAR(255) NOT NULL,
        product_price DECIMAL(10, 2) NOT NULL,
        quantity INT NOT NULL,
        subtotal DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
    )");
    
    // Insert order
    $stmt = $pdo->prepare("INSERT INTO orders (order_number, customer_name, customer_phone, customer_email, total_amount) 
                          VALUES (:order_number, :customer_name, :customer_phone, :customer_email, :total_amount)");
    
    $stmt->execute([
        'order_number' => $orderData['orderNumber'],
        'customer_name' => $orderData['customerName'],
        'customer_phone' => $orderData['customerPhone'],
        'customer_email' => $orderData['customerEmail'],
        'total_amount' => $orderData['total']
    ]);
    
    $orderId = $pdo->lastInsertId();
    
    // Insert order items and update stock
    $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, category, product_name, product_price, quantity, subtotal) 
                               VALUES (:order_id, :product_id, :category, :product_name, :product_price, :quantity, :subtotal)");
    
    foreach ($orderData['items'] as $item) {
        // Insert order item
        $itemStmt->execute([
            'order_id' => $orderId,
            'product_id' => $item['id'],
            'category' => $item['category'],
            'product_name' => $item['name'],
            'product_price' => $item['price'],
            'quantity' => $item['quantity'],
            'subtotal' => $item['price'] * $item['quantity']
        ]);
        
        // Update stock quantity for products from database (not featured products)
        if ($item['category'] !== 'featured') {
            $updateStmt = $pdo->prepare("UPDATE {$item['category']} SET qty = qty - :quantity WHERE id = :product_id AND qty >= :quantity");
            $updateStmt->execute([
                'quantity' => $item['quantity'],
                'product_id' => $item['id']
            ]);
            
            // Check if stock was updated (if not, product doesn't exist or insufficient stock)
            if ($updateStmt->rowCount() === 0) {
                throw new Exception("Insufficient stock for product: " . $item['name']);
            }
        }
    }
    
    // Commit transaction
    $pdo->commit();
    
    echo json_encode([
        'success' => true,
        'message' => 'Order processed successfully',
        'orderId' => $orderId
    ]);
    
} catch (Exception $e) {
    // Rollback transaction on error
    $pdo->rollBack();
    
    echo json_encode([
        'success' => false,
        'message' => 'Order processing failed: ' . $e->getMessage()
    ]);
}
?>
