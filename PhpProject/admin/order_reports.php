<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';


$searchQuery = $_GET['search'] ?? '';
$dateFrom = $_GET['date_from'] ?? '';
$dateTo = $_GET['date_to'] ?? '';
$sortBy = $_GET['sort_by'] ?? 'order_date';
$sortOrder = $_GET['sort_order'] ?? 'DESC';

$sql = "SELECT o.*, 
        (SELECT COUNT(*) FROM order_items oi WHERE oi.order_id = o.id) as item_count
        FROM orders o
        WHERE 1=1";

$params = [];

if ($searchQuery) {
    $sql .= " AND (o.order_number LIKE :search 
              OR o.customer_name LIKE :search 
              OR o.customer_email LIKE :search 
              OR o.customer_phone LIKE :search)";
    $params['search'] = "%$searchQuery%";
}

if ($dateFrom) {
    $sql .= " AND DATE(o.order_date) >= :date_from";
    $params['date_from'] = $dateFrom;
}

if ($dateTo) {
    $sql .= " AND DATE(o.order_date) <= :date_to";
    $params['date_to'] = $dateTo;
}

$allowedSortColumns = ['order_date', 'order_number', 'customer_name', 'total_amount'];
$sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'order_date';
$sortOrder = ($sortOrder === 'ASC') ? 'ASC' : 'DESC';
$sql .= " ORDER BY o.$sortBy $sortOrder";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalOrders = count($orders);
    $totalRevenue = array_sum(array_column($orders, 'total_amount'));
    
} catch (PDOException $e) {
    $orders = [];
    $error = "Database error: " . $e->getMessage();
}

// Function to get order items
function getOrderItems($pdo, $orderId) {
    $stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
    $stmt->execute(['order_id' => $orderId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Reports - Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f5f5;
        }

        .admin-header {
            background: #000;
            color: #fff;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-logo {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -2px;
        }

        .admin-nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .admin-nav a:hover {
            opacity: 0.7;
        }

        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: #fff;
            padding: 30px;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .summary-card h3 {
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 10px;
        }

        .summary-card .value {
            font-size: 36px;
            font-weight: 300;
            color: #000;
        }

        .filter-card {
            background: #fff;
            padding: 30px;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #e5e5e5;
            font-size: 13px;
            outline: none;
            transition: border 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #000;
        }

        .btn {
            padding: 10px 24px;
            background: #000;
            color: #fff;
            border: none;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: #333;
        }

        .btn-secondary {
            background: #666;
        }

        .btn-secondary:hover {
            background: #888;
        }

        .orders-table {
            background: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f9f9f9;
        }

        th {
            padding: 15px;
            text-align: left;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #e5e5e5;
        }

        th a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        th a:hover {
            color: #000;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        .order-number {
            font-weight: 600;
            color: #000;
        }

        .view-btn {
            padding: 6px 12px;
            background: #000;
            color: #fff;
            border: none;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
        }

        .view-btn:hover {
            background: #333;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            overflow-y: auto;
        }

        .modal-content {
            background: #fff;
            margin: 50px auto;
            padding: 40px;
            width: 90%;
            max-width: 800px;
            border-radius: 2px;
            position: relative;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 28px;
            font-weight: 300;
            cursor: pointer;
            color: #666;
        }

        .close:hover {
            color: #000;
        }

        .modal-header {
            margin-bottom: 30px;
        }

        .modal-header h2 {
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .order-details {
            margin-bottom: 30px;
        }

        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-label {
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #666;
            width: 150px;
        }

        .detail-value {
            font-size: 14px;
            color: #000;
        }

        .items-table {
            margin-top: 30px;
        }

        .items-table h3 {
            font-size: 16px;
            font-weight: 300;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .no-orders {
            padding: 60px;
            text-align: center;
            color: #666;
            font-size: 14px;
            background: #fff;
            border-radius: 2px;
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 3px solid #c62828;
        }

        .export-btn {
            padding: 10px 24px;
            background: #4CAF50;
            color: #fff;
            border: none;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .export-btn:hover {
            background: #45a049;
        }

        @media (max-width: 1200px) {
            .filter-form {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .filter-form {
                grid-template-columns: 1fr;
            }

            .orders-table {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="admin-logo">4T9</div>
        <div class="admin-nav">
            <a href="dashboard.php">Add Product</a>
            <a href="view_products.php">View Products</a>
            <a href="order_reports.php">Order Reports</a>
            <a href="../home.php">View Store</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1 class="page-title">Order Reports</h1>

        <?php if (isset($error)): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="summary-card">
                <h3>Total Orders</h3>
                <div class="value"><?php echo number_format($totalOrders ?? 0); ?></div>
            </div>
            <div class="summary-card">
                <h3>Total Revenue</h3>
                <div class="value">$<?php echo number_format($totalRevenue ?? 0, 2); ?></div>
            </div>
            <div class="summary-card">
                <h3>Average Order</h3>
                <div class="value">$<?php echo $totalOrders > 0 ? number_format(($totalRevenue ?? 0) / $totalOrders, 2) : '0.00'; ?></div>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="filter-card">
            <form method="GET" class="filter-form">
                <div class="form-group">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" placeholder="Order #, Customer Name, Email, Phone" value="<?php echo htmlspecialchars($searchQuery); ?>">
                </div>

                <div class="form-group">
                    <label for="date_from">Date From</label>
                    <input type="date" id="date_from" name="date_from" value="<?php echo htmlspecialchars($dateFrom); ?>">
                </div>

                <div class="form-group">
                    <label for="date_to">Date To</label>
                    <input type="date" id="date_to" name="date_to" value="<?php echo htmlspecialchars($dateTo); ?>">
                </div>

                <div class="form-group">
                    <label for="sort_by">Sort By</label>
                    <select id="sort_by" name="sort_by">
                        <option value="order_date" <?php echo $sortBy === 'order_date' ? 'selected' : ''; ?>>Date</option>
                        <option value="order_number" <?php echo $sortBy === 'order_number' ? 'selected' : ''; ?>>Order #</option>
                        <option value="customer_name" <?php echo $sortBy === 'customer_name' ? 'selected' : ''; ?>>Customer</option>
                        <option value="total_amount" <?php echo $sortBy === 'total_amount' ? 'selected' : ''; ?>>Amount</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sort_order">Order</label>
                    <select id="sort_order" name="sort_order">
                        <option value="DESC" <?php echo $sortOrder === 'DESC' ? 'selected' : ''; ?>>Descending</option>
                        <option value="ASC" <?php echo $sortOrder === 'ASC' ? 'selected' : ''; ?>>Ascending</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Filter</button>
                </div>
            </form>
        </div>

        <!-- Orders Table -->
        <?php if (!empty($orders)): ?>
        <div class="orders-table">
            <table>
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Items</th>
                        <th>Total Amount</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="order-number"><?php echo htmlspecialchars($order['order_number']); ?></td>
                        <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['customer_email']); ?></td>
                        <td><?php echo htmlspecialchars($order['customer_phone']); ?></td>
                        <td><?php echo $order['item_count']; ?> item(s)</td>
                        <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><?php echo date('M d, Y g:i A', strtotime($order['order_date'])); ?></td>
                        <td>
                            <button class="view-btn" onclick="viewOrder(<?php echo $order['id']; ?>)">View Details</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="no-orders">
            <p>No orders found matching your criteria.</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Order Details Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2>Order Details</h2>
            </div>
            <div id="orderDetailsContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        function viewOrder(orderId) {
            const modal = document.getElementById('orderModal');
            const content = document.getElementById('orderDetailsContent');
            
            // Show modal
            modal.style.display = 'block';
            content.innerHTML = '<p style="text-align:center;padding:20px;">Loading...</p>';
            
            // Fetch order details
            fetch('get_order_details.php?id=' + orderId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayOrderDetails(data.order, data.items);
                    } else {
                        content.innerHTML = '<p style="color:#c62828;">Error loading order details.</p>';
                    }
                })
                .catch(error => {
                    content.innerHTML = '<p style="color:#c62828;">Error loading order details.</p>';
                });
        }

        function displayOrderDetails(order, items) {
            const content = document.getElementById('orderDetailsContent');
            
            let html = `
                <div class="order-details">
                    <div class="detail-row">
                        <div class="detail-label">Order Number:</div>
                        <div class="detail-value">${order.order_number}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Customer Name:</div>
                        <div class="detail-value">${order.customer_name}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">${order.customer_email}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Phone:</div>
                        <div class="detail-value">${order.customer_phone}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Order Date:</div>
                        <div class="detail-value">${new Date(order.order_date).toLocaleString()}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Amount:</div>
                        <div class="detail-value"><strong>$${parseFloat(order.total_amount).toFixed(2)}</strong></div>
                    </div>
                </div>

                <div class="items-table">
                    <h3>Order Items</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            items.forEach(item => {
                html += `
                    <tr>
                        <td>${item.product_name}</td>
                        <td>${item.category.charAt(0).toUpperCase() + item.category.slice(1)}</td>
                        <td>$${parseFloat(item.product_price).toFixed(2)}</td>
                        <td>${item.quantity}</td>
                        <td>$${parseFloat(item.subtotal).toFixed(2)}</td>
                    </tr>
                `;
            });

            html += `
                        </tbody>
                    </table>
                </div>
            `;

            content.innerHTML = html;
        }

        function closeModal() {
            document.getElementById('orderModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('orderModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
