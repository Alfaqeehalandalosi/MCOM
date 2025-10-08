<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

// This block handles the background POST request from our JavaScript
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set the header to indicate a JSON response
    header('Content-Type: application/json');

    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';

    // Basic validation
    if (empty($full_name) || empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Full Name and Email are required.']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, contact_number) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $email, $contact_number);
    
    if ($stmt->execute()) {
        // Send a success response back to the JavaScript
        echo json_encode(['status' => 'success', 'message' => 'User added successfully!']);
    } else {
        // Send an error response
        echo json_encode(['status' => 'error', 'message' => 'Error: Could not add user. The email might already exist.']);
    }
    // Stop the script after sending the JSON response
    exit;
}
?>

<div class="card form-container">
    <h1>Add a New User</h1>

    <form id="addUserForm" method="post" action="add_user.php">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number (Optional)</label>
            <input type="tel" id="contact_number" name="contact_number">
        </div>

        <div class="form-actions">
            <button type="submit" class="action-button">Save</button>
            <a href="manage_users.php" class="ajax-link btn-secondary">Cancel</a>
        </div>
    </form>

    <div id="form-message" style="margin-top: 20px;"></div>
</div>