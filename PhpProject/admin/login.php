<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === '123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - 4T9</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background: #fff;
            padding: 50px;
            border-radius: 2px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-logo {
            text-align: center;
            font-size: 48px;
            font-weight: 900;
            letter-spacing: -2px;
            margin-bottom: 10px;
        }

        .login-title {
            text-align: center;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 40px;
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

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e5e5e5;
            font-size: 14px;
            outline: none;
            transition: border 0.3s;
        }

        .form-group input:focus {
            border-color: #000;
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 3px solid #c62828;
        }

        .btn-login {
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

        .btn-login:hover {
            background: #333;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #666;
            text-decoration: none;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .back-link a:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-logo">4T9</div>
        <div class="login-title">Admin Login</div>

        <?php if ($error): ?>
        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-login">Log In</button>
        </form>

        <div class="back-link">
            <a href="../index.php">← Back to Store</a>
        </div>
    </div>
</body>
</html>
