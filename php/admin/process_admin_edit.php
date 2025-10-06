<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    // --- IMPORTANT: Check for duplicate username ---
    // Check if the new username is already taken by ANOTHER admin
    $stmt = $conn->prepare("SELECT id FROM admins WHERE username = ? AND id != ?");
    $stmt->bind_param("si", $username, $id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        die("Error: This username is already taken by another account. Please go back and choose a different username.");
    }
    $stmt->close();
    // --- End of duplicate check ---

    // Proceed with the update
    $update_stmt = $conn->prepare("UPDATE admins SET full_name = ?, username = ? WHERE id = ?");
    $update_stmt->bind_param("ssi", $full_name, $username, $id);
    
    if ($update_stmt->execute()) {
        header("location: manage_admins.php");
        exit;
    } else {
        echo "Error: Could not update the admin account.";
    }
    $update_stmt->close();
    $conn->close();
}
?>