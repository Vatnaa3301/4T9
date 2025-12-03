<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

require_once '../includes/db.php';

$orderId = $_GET['id'] ?? null;

if (!$orderId) {
    echo json_encode(['success' => false, 'message' => 'Order ID required']);
    exit;
}

try {
    // Get order details
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = :id");
    $stmt->execute(['id' => $orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo json_encode(['success' => false, 'message' => 'Order not found']);
        exit;
    }

    // Get order items
    $stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = :order_id ORDER BY id");
    $stmt->execute(['order_id' => $orderId]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'order' => $order,
        'items' => $items
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
