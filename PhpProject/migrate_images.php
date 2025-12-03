<?php
/**
 * Image Migration Script
 * This script migrates images from uploads/ folder to uploadimg/ folder
 * and updates database entries to store only filenames instead of full paths
 */

require_once 'includes/db.php';

$migrationLog = [];
$errors = [];

// Create uploadimg folder if it doesn't exist
if (!file_exists('uploadimg')) {
    mkdir('uploadimg', 0777, true);
    $migrationLog[] = "Created uploadimg folder";
}

// Categories to migrate
$categories = ['men', 'women', 'accessories'];

foreach ($categories as $category) {
    $migrationLog[] = "\n--- Migrating $category category ---";
    
    try {
        // Fetch all products from category
        $stmt = $pdo->query("SELECT id, name, image FROM $category");
        $products = $stmt->fetchAll();
        
        if (empty($products)) {
            $migrationLog[] = "No products found in $category category";
            continue;
        }
        
        $updateStmt = $pdo->prepare("UPDATE $category SET image = :new_image WHERE id = :id");
        
        foreach ($products as $product) {
            $oldImagePath = $product['image'];
            $productName = $product['name'];
            
            // Check if path already contains just filename (already migrated)
            if (strpos($oldImagePath, '/') === false && strpos($oldImagePath, '\\') === false) {
                $migrationLog[] = "Product '{$productName}' already migrated (filename only in DB)";
                
                // Check if file exists in uploadimg folder
                if (file_exists('uploadimg/' . $oldImagePath)) {
                    $migrationLog[] = "  ✓ Image file exists in uploadimg/";
                } else {
                    $errors[] = "  ✗ Image file NOT found in uploadimg/: {$oldImagePath}";
                }
                continue;
            }
            
            // Extract filename from path (handles both uploads/file.jpg and full paths)
            $filename = basename($oldImagePath);
            
            // Source and destination paths
            $sourcePath = $oldImagePath; // Could be "uploads/file.jpg" or just path
            $destPath = 'uploadimg/' . $filename;
            
            // Try to move/copy the file
            $fileMoved = false;
            
            // Check if source file exists
            if (file_exists($sourcePath)) {
                if (copy($sourcePath, $destPath)) {
                    $fileMoved = true;
                    $migrationLog[] = "Product '{$productName}': Copied image from {$sourcePath} to {$destPath}";
                    
                    // Delete old file after successful copy
                    if (unlink($sourcePath)) {
                        $migrationLog[] = "  ✓ Deleted old image: {$sourcePath}";
                    }
                } else {
                    $errors[] = "Failed to copy image for '{$productName}': {$sourcePath} -> {$destPath}";
                }
            } else {
                // Try alternate path (maybe it's already in uploads folder without prefix)
                $alternatePath = 'uploads/' . $filename;
                if (file_exists($alternatePath)) {
                    if (copy($alternatePath, $destPath)) {
                        $fileMoved = true;
                        $migrationLog[] = "Product '{$productName}': Copied image from {$alternatePath} to {$destPath}";
                        
                        if (unlink($alternatePath)) {
                            $migrationLog[] = "  ✓ Deleted old image: {$alternatePath}";
                        }
                    }
                } else {
                    $errors[] = "Source image not found for '{$productName}': {$sourcePath} (tried {$alternatePath})";
                }
            }
            
            // Update database to store only filename
            try {
                $updateStmt->execute([
                    'new_image' => $filename,
                    'id' => $product['id']
                ]);
                $migrationLog[] = "  ✓ Updated database: '{$oldImagePath}' -> '{$filename}'";
            } catch (PDOException $e) {
                $errors[] = "Database update failed for '{$productName}': " . $e->getMessage();
            }
        }
        
    } catch (PDOException $e) {
        $errors[] = "Error processing $category category: " . $e->getMessage();
    }
}

// Output results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Migration - 4T9</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #252526;
            padding: 30px;
            border-radius: 4px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }

        h1 {
            color: #4ec9b0;
            margin-bottom: 30px;
            font-size: 28px;
            border-bottom: 2px solid #4ec9b0;
            padding-bottom: 10px;
        }

        h2 {
            color: #569cd6;
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .log-entry {
            padding: 8px 0;
            border-bottom: 1px solid #3e3e42;
            line-height: 1.6;
        }

        .log-entry.success {
            color: #4ec9b0;
        }

        .log-entry.error {
            color: #f48771;
        }

        .log-entry.info {
            color: #d4d4d4;
        }

        .log-entry.header {
            color: #dcdcaa;
            font-weight: bold;
            margin-top: 15px;
        }

        .summary {
            background: #1e1e1e;
            padding: 20px;
            border-radius: 4px;
            margin-top: 30px;
            border-left: 4px solid #4ec9b0;
        }

        .summary.has-errors {
            border-left-color: #f48771;
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background: #007acc;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: #005a9e;
        }

        code {
            background: #1e1e1e;
            padding: 2px 6px;
            border-radius: 3px;
            color: #ce9178;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 Image Migration Results</h1>

        <div class="summary <?php echo !empty($errors) ? 'has-errors' : ''; ?>">
            <strong>Migration Summary:</strong><br>
            Total log entries: <?php echo count($migrationLog); ?><br>
            Errors: <?php echo count($errors); ?><br>
            Status: <?php echo empty($errors) ? '✓ SUCCESS' : '⚠ COMPLETED WITH ERRORS'; ?>
        </div>

        <h2>📋 Migration Log</h2>
        <?php foreach ($migrationLog as $entry): ?>
            <?php
            $class = 'info';
            if (strpos($entry, '✓') !== false) {
                $class = 'success';
            } elseif (strpos($entry, '---') !== false) {
                $class = 'header';
            }
            ?>
            <div class="log-entry <?php echo $class; ?>"><?php echo htmlspecialchars($entry); ?></div>
        <?php endforeach; ?>

        <?php if (!empty($errors)): ?>
        <h2>❌ Errors</h2>
        <?php foreach ($errors as $error): ?>
            <div class="log-entry error"><?php echo htmlspecialchars($error); ?></div>
        <?php endforeach; ?>
        <?php endif; ?>

        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #3e3e42;">
            <p style="margin-bottom: 15px;">
                <strong>Next Steps:</strong>
            </p>
            <ol style="margin-left: 20px; line-height: 2;">
                <li>Check the migration log above for any errors</li>
                <li>Verify images are displaying correctly on your website</li>
                <li>If everything looks good, you can safely delete the old <code>uploads/</code> folder</li>
                <li>Delete this migration script: <code>migrate_images.php</code></li>
            </ol>
        </div>

        <a href="admin/dashboard.php" class="back-btn">Go to Admin Dashboard</a>
        <a href="index.php" class="back-btn" style="background: #4ec9b0;">View Store</a>
    </div>
</body>
</html>

```