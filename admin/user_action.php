<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$action = $_GET['action'] ?? '';
$user_id = $_GET['id'] ?? 0;

if (($action === 'activate' || $action === 'deactivate') && $user_id > 0) {
    $new_status = ($action === 'activate') ? 'Active' : 'Inactive';
    
    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $user_id);
    $stmt->execute();
}

// FIXED: Redirect back to the correct page name
header("Location: manage_users.php"); 
exit;