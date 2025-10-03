<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

// Check if the action is 'delete' and an ID is provided
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    
    $event_id = (int)$_GET['id'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $event_id);

    // Execute the query
    if ($stmt->execute()) {
        // Success: Redirect back to the manage page with a success message
        header("Location: manage_events.php?message=deletesuccess");
    } else {
        // Failure: Redirect with an error message
        header("Location: manage_events.php?message=deleteerror");
    }
    
    $stmt->close();
    $conn->close();

} else {
    // If the required parameters aren't set, just redirect back
    header("Location: manage_events.php");
}
exit(); // Always exit after a header redirect
?>