<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
$campaign_id = $_GET['id'] ?? '';

if ($campaign_id && $action == 'cancel') {
    $stmt = $conn->prepare("UPDATE donation_campaigns SET status = 'Cancelled' WHERE id = ?");
    $stmt->bind_param("s", $campaign_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Campaign has been cancelled.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error cancelling campaign.']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action or campaign ID.']);
}

$conn->close();
exit();