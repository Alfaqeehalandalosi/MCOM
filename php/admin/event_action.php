<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

header('Content-Type: application/json'); // Respond with JSON for all actions
$action = $_GET['action'] ?? '';
$event_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($event_id > 0) {
    if ($action == 'delete') {
        $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $event_id);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting event.']);
        }
        $stmt->close();
    } 
    // --- NEW LOGIC FOR CANCELLING AN EVENT ---
    elseif ($action == 'cancel') {
        $stmt = $conn->prepare("UPDATE events SET status = 'Cancelled' WHERE id = ?");
        $stmt->bind_param("i", $event_id);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Event has been cancelled.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error cancelling event.']);
        }
        $stmt->close();
    } 
    else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action specified.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid or missing event ID.']);
}

$conn->close();
exit();