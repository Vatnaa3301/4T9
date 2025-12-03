<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';

$category = $_GET['category'] ?? 'men';
$success = $_GET['success'] ?? '';

// get products from selected category
$stmt = $pdo->prepare("SELECT * FROM $category ORDER BY id DESC");
$stmt->execute();
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - 4T9 Admin</title>
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
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            padding: 40px;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .card h2 {
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .category-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 1px solid #e5e5e5;
        }

        .tab-btn {
            padding: 12px 24px;
            border: none;
            background: transparent;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .tab-btn.active {
            border-bottom-color: #000;
            font-weight: 600;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 3px solid #2e7d32;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table th,
        .products-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e5e5e5;
        }

        .products-table th {
            background: #f8f8f8;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .products-table td {
            font-size: 13px;
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 2px;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .btn-edit,
        .btn-delete {
            padding: 6px 12px;
            border: none;
            font-size: 10px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background: #2196F3;
            color: #fff;
        }

        .btn-edit:hover {
            background: #1976D2;
        }

        .btn-delete {
            background: #f44336;
            color: #fff;
        }

        .btn-delete:hover {
            background: #d32f2f;
        }

        .no-products {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            background: #000;
            color: #fff;
            font-size: 10px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-radius: 2px;
        }

        .badge.low-stock {
            background: #ff9800;
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
            <a href="../index.php">View Store</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h2>Manage Products</h2>

            <?php if ($success): ?>
            <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <div class="category-tabs">
                <button class="tab-btn <?php echo $category === 'men' ? 'active' : ''; ?>" 
                        onclick="window.location.href='?category=men'">Men</button>
                <button class="tab-btn <?php echo $category === 'women' ? 'active' : ''; ?>" 
                        onclick="window.location.href='?category=women'">Women</button>
                <button class="tab-btn <?php echo $category === 'accessories' ? 'active' : ''; ?>" 
                        onclick="window.location.href='?category=accessories'">Accessories</button>
            </div>

            <?php if (empty($products)): ?>
            <div class="no-products">
                <p>No products found in this category.</p>
            </div>
            <?php else: ?>
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td>
                            <img src="../uploadimg/<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                 class="product-img">
                        </td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>$<?php echo number_format($product['price'], 2); ?></td>
                        <td><?php echo $product['qty']; ?></td>
                        <td>
                            <?php if ($product['qty'] < 10): ?>
                            <span class="badge low-stock">Low Stock</span>
                            <?php else: ?>
                            <span class="badge">In Stock</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="edit_product.php?id=<?php echo $product['id']; ?>&category=<?php echo $category; ?>" 
                                   class="btn-edit">Edit</a>
                                <a href="delete_product.php?id=<?php echo $product['id']; ?>&category=<?php echo $category; ?>" 
                                   class="btn-delete" 
                                   onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
