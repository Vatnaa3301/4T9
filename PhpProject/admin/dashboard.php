<?php

session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}


require_once '../includes/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $qty = $_POST['qty'] ?? '';
    
    // Handle image upload
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = '../uploadimg/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $imageExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $imageExtension;
        $targetPath = $uploadDir . $newImageName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $newImageName; 
        } else {
            $error = 'Failed to upload image';
        }
    }
    
    if (!$error && $category && $name && $price && $qty && $imagePath) {
        try {
            $sql = "INSERT INTO $category (name, price, qty, image) VALUES (:name, :price, :qty, :image)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'price' => $price,
                'qty' => $qty,
                'image' => $imagePath
            ]);
            $success = 'Product added successfully!';
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    } elseif (!$error) {
        $error = 'Please fill all fields';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - VANA</title>
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
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: #fff;
            padding: 40px;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card h2 {
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #e5e5e5;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #000;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 3px solid #2e7d32;
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 3px solid #c62828;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #000;
            color: #fff;
            border: none;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #333;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: block;
            padding: 12px;
            border: 2px dashed #e5e5e5;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s;
            font-size: 13px;
            color: #666;
        }

        .file-input-label:hover {
            border-color: #000;
        }

        .file-name {
            margin-top: 10px;
            font-size: 12px;
            color: #666;
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
            <h2>Add New Product</h2>

            <?php if ($success): ?>
            <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="accessories">Accessories</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="number" id="qty" name="qty" min="0" required>
                </div>

                <div class="form-group">
                    <label>Product Image</label>
                    <div class="file-input-wrapper">
                        <label for="image" class="file-input-label">
                            Click to upload image
                        </label>
                        <input type="file" id="image" name="image" accept="image/*" required onchange="displayFileName(this)">
                    </div>
                    <div id="file-name" class="file-name"></div>
                </div>

                <button type="submit" class="btn-submit">Add Product</button>
            </form>
        </div>
    </div>

    <script>
        function displayFileName(input) {
            const fileName = input.files[0]?.name || '';
            document.getElementById('file-name').textContent = fileName ? 'Selected: ' + fileName : '';
        }
    </script>
</body>
</html>
