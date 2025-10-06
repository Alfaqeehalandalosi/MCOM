<?php
session_start();
// This is a protected page for admins only
if (!isset($_SESSION['admin_loggedin'])) {
    // Corrected path for the redirect as well
    header('Location: ../login.php');
    exit;
}

// CORRECTED FILE PATH on the next line
require_once '../db_connect.php';
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error_message = "This username is already taken.";
    } else {
        // Insert the new admin record
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt_insert = $conn->prepare("INSERT INTO admins (full_name, username, password_hash) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sss", $full_name, $username, $hashed_password);
        
        if ($stmt_insert->execute()) {
            $success_message = "New admin '".htmlspecialchars($username)."' created successfully!";
        } else {
            $error_message = "Error: Could not create admin account.";
        }
        $stmt_insert->close();
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; padding: 40px 0; }
        .container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .error, .success { padding: 10px; border-radius: 4px; text-align: center; margin-bottom: 20px; }
        .error { color: #D8000C; background-color: #FFBABA; }
        .success { color: #155724; background-color: #D4EDDA; }
    </style>
</head>
<body>
    <div class="container">
        <?php include 'admin_nav.php'; ?>
        
        <h1>Create a New Admin</h1>
        <?php 
        if ($error_message) { echo '<div class="error">' . $error_message . '</div>'; }
        if ($success_message) { echo '<div class="success">' . $success_message . '</div>'; }
        ?>
        <form action="create_admin.php" method="post">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Create Admin</button>
        </form>
    </div>
</body>
</html>