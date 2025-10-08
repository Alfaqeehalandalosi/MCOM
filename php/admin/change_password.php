<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $admin_id = $_SESSION['admin_id'];

    if ($new_password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT password_hash FROM admins WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($current_password, $result['password_hash'])) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt_update = $conn->prepare("UPDATE admins SET password_hash = ? WHERE id = ?");
        $stmt_update->bind_param("si", $hashed_password, $admin_id);
        if ($stmt_update->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Password changed successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error updating password.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect current password.']);
    }
    exit;
}
?>
<div class="card form-container">
    <h1>Change Your Password</h1>
    <form id="changePasswordForm" action="change_password.php" method="post">
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
        <div class="form-actions">
            <button type="submit" class="action-button">Update Password</button>
        </div>
    </form>
    <div id="form-message" style="margin-top: 20px;"></div>
</div>