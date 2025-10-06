<?php
// Secure this page
require_once 'admin_check.php';
// Connect to the database
require_once '../db_connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $goal_amount = $_POST['goal_amount'];
    $status = $_POST['status'];
    
    // Check if an 'id' was submitted. If so, we are UPDATING.
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        
        $sql = "UPDATE donation_campaigns SET name = ?, description = ?, goal_amount = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        // Note the order and types: s (string), s, d (double/decimal), s, s
        $stmt->bind_param("ssdss", $name, $description, $goal_amount, $status, $id);
        
    } else {
        // If no 'id' was submitted, we are INSERTING a new record.
        $id = $_POST['campaign_id_field']; // The editable ID field for new campaigns
        
        $sql = "INSERT INTO donation_campaigns (id, name, description, goal_amount, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // Note the order and types: s, s, s, d, s
        $stmt->bind_param("sssds", $id, $name, $description, $goal_amount, $status);
    }

    // Execute the statement and redirect
    if ($stmt->execute()) {
        // Success! Redirect back to the main campaigns list
        header("location: campaigns.php");
        exit;
    } else {
        // Handle error
        echo "Error: Could not save the campaign. Please try again.";
    }

    $stmt->close();
    $conn->close();

} else {
    // If not a POST request, redirect
    header("location: campaigns.php");
    exit;
}
?>