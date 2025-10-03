<?php
// Use the security check to ensure only a logged-in admin can access this page
require_once 'admin_check.php';
require_once '../db_connect.php';

// Get the logged-in admin's ID from the session
$admin_id = $_SESSION['admin_id'];
$error_message = '';
$success_message = '';

// Handle the form submission when the admin tries to change the password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // First, get the admin's current hashed password from the database
    $stmt = $conn->prepare("SELECT password_hash FROM admins WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->bind_result($password_hash);
    $stmt->fetch();
    $stmt->close();

    // 1. Verify the current password is correct
    if (!password_verify($current_password, $password_hash)) {
        $error_message = "Your current password is not correct.";
    } 
    // 2. Check if the new password and confirmation match
    elseif ($new_password !== $confirm_password) {
        $error_message = "The new password and confirmation password do not match.";
    } 
    // 3. All checks passed, proceed with the update
    else {
        // Hash the new password securely
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Update the password in the database
        $update_stmt = $conn->prepare("UPDATE admins SET password_hash = ? WHERE id = ?");
        $update_stmt->bind_param("si", $new_hashed_password, $admin_id);
        
        if ($update_stmt->execute()) {
            $success_message = "Your password has been updated successfully!";
        } else {
            $error_message = "An error occurred. Please try again.";
        }
        $update_stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { max-width: 600px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="password"] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .error, .success { padding: 10px; border-radius: 4px; text-align: center; margin-bottom: 20px; }
        .error { color: #D8000C; background-color: #FFBABA; }
        .success { color: #155724; background-color: #D4EDDA; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        <h1>Change Your Password</h1>
        
        <?php 
        if ($error_message) { echo '<div class="error">' . $error_message . '</div>'; }
        if ($success_message) { echo '<div class="success">' . $success_message . '</div>'; }
        ?>

        <form action="change_password.php" method="post">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Update Password</button>
        </form>
    </div>
</body>
</html>