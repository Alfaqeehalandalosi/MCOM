<?php
session_start();
require_once 'db_connect.php';

// Check if username and password were submitted
if (!isset($_POST['username'], $_POST['password'])) {
    exit('Please fill both the username and password fields!');
}

// Prepare SQL to prevent injection, querying the 'admins' table
$stmt = $conn->prepare('SELECT id, full_name, password_hash FROM admins WHERE username = ?');
$stmt->bind_param('s', $_POST['username']);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($admin_id, $full_name, $password_hash);
    $stmt->fetch();
    
    // Verify the password against the stored hash
    if (password_verify($_POST['password'], $password_hash)) {
        // Verification success! Create new session
        session_regenerate_id();
        $_SESSION['admin_loggedin'] = TRUE;
        $_SESSION['admin_name'] = $full_name;
        $_SESSION['admin_id'] = $admin_id;
        
        // Redirect to the admin dashboard
        header('Location: admin/index.php');
        exit;
    } else {
        // Incorrect password
        header('Location: login.php?error=invalid');
        exit;
    }
} else {
    // Incorrect username
    header('Location: login.php?error=invalid');
    exit;
}

$stmt->close();
$conn->close();
?>