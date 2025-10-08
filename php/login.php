<?php
session_start();
// This page is for admins, so we can call the session 'admin_loggedin'
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    header('Location: ../php/admin/admin_panel.php'); // Or your main admin page
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h1 { text-align: center; color: #333; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; color: #555; }
        input[type="text"], input[type="password"] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        .error { padding: 10px; border-radius: 4px; text-align: center; margin-bottom: 20px; color: #D8000C; background-color: #FFBABA; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'invalid') {
            echo '<div class="error">Invalid username or password.</div>';
        }
        ?>
        <form action="authenticate.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" style="margin-top: 15px;">Login</button>
        </form>
    </div>
</body>
</html>