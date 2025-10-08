<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';

    if (empty($full_name) || empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Full Name and Email are required.']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, contact_number) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $email, $contact_number);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User added successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: Could not add user. The email might already exist.']);
    }
    exit;
}
?>

<a href="manage_users.php" class="action-button ajax-link" style="margin-bottom: 20px;">&larr; Back to All Users</a>

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