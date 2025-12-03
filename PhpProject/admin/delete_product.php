<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';

$id = $_GET['id'] ?? '';
$category = $_GET['category'] ?? 'men';

if ($id) {
    try {
        // Get product image path before deleting
        $stmt = $pdo->prepare("SELECT image FROM $category WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();
        
        if ($product) {
            // Delete product from database
            $stmt = $pdo->prepare("DELETE FROM $category WHERE id = :id");
            $stmt->execute(['id' => $id]);
            
            // Delete image file if exists
            if (file_exists('../uploadimg/' . $product['image'])) {
                unlink('../uploadimg/' . $product['image']);
            }
            
            header('Location: view_products.php?category=' . $category . '&success=Product deleted successfully!');
            exit;
        }
    } catch (PDOException $e) {
        header('Location: view_products.php?category=' . $category . '&error=Failed to delete product');
        exit;
    }
}

header('Location: view_products.php?category=' . $category);
exit;
?>
