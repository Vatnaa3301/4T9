<?php
require_once 'includes/db.php';

// Get filter parameter
$filter = $_GET['filter'] ?? 'newest';

// Determine sort order
$orderBy = ($filter === 'oldest') ? 'id ASC' : 'id DESC';

// Fetch accessories products
$stmt = $pdo->query("SELECT * FROM accessories ORDER BY $orderBy");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories Collection - 4T9</title>
    <?php include 'includes/styles.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main>
        <section class="products-section">
            <div class="page-header">
                <h1>Accessories Collection</h1>
                <div class="filter-controls">
                    <span class="filter-label">SORT BY:</span>
                    <select id="filterSelect" onchange="window.location.href='?filter=' + this.value" class="filter-dropdown">
                        <option value="newest" <?php echo $filter === 'newest' ? 'selected' : ''; ?>>Newest First</option>
                        <option value="oldest" <?php echo $filter === 'oldest' ? 'selected' : ''; ?>>Oldest First</option>
                    </select>
                </div>
            </div>

            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if ($product['qty'] < 10): ?>
                        <span class="product-badge">Low Stock</span>
                        <?php endif; ?>
                        <img src="uploadimg/<?php echo htmlspecialchars($product['image']); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <button class="quick-add" onclick="addToCart(<?php echo $product['id']; ?>, 'accessories')">+ Quick Add</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                        <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                        <div class="product-colors">
                            <span class="color-dot" style="background: #000;"></span>
                            <span class="color-dot" style="background: #fff; border-color: #000;"></span>
                            <span class="color-dot" style="background: #888;"></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php if (empty($products)): ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                    <p style="font-size: 18px; color: #666;">No products available yet.</p>
                    <a href="admin/login.php" style="display: inline-block; margin-top: 20px; padding: 10px 30px; border: 1px solid #000; text-decoration: none; color: #000; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Add Products</a>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/cart.php'; ?>
</body>
</html>
