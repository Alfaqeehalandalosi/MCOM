<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt_check = $conn->prepare("SELECT id FROM admins WHERE username = ?");
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'This username is already taken.']);
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt_insert = $conn->prepare("INSERT INTO admins (full_name, username, password_hash) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sss", $full_name, $username, $hashed_password);
        if ($stmt_insert->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'New admin created successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: Could not create admin account.']);
        }
    }
    exit;
}
?>
<div class="card form-container">
    <a href="manage_admins.php" class="action-button ajax-link" style="margin-bottom: 20px;">&larr; Back to Admin List</a>
    <h1>Create a New Admin</h1>
    
    <form id="createAdminForm" action="create_admin.php" method="post">
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
        <div class="form-actions">
            <button type="submit" class="action-button">Create Admin</button>
        </div>
    </form>
    <div id="form-message" style="margin-top: 20px;"></div>
</div>