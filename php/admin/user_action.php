<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

header('Content-Type: application/json'); // We will always respond with JSON
$action = $_GET['action'] ?? '';
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (($action === 'activate' || $action === 'deactivate') && $user_id > 0) {
    $new_status = ($action === 'activate') ? 'Active' : 'Inactive';
    
    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $user_id);
    
    if ($stmt->execute()) {
        $message = ($action === 'activate') ? 'User has been activated.' : 'User has been deactivated.';
        echo json_encode(['status' => 'success', 'message' => $message]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: Could not update user status.']);
    }
    $stmt->close();

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action or user ID.']);
}

$conn->close();
exit();