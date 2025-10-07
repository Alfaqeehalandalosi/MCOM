<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');

    $name = $_POST['name'];
    $description = $_POST['description'];
    $goal_amount = $_POST['goal_amount'];
    $start_date = $_POST['start_date'] ?: null; // Handle empty dates
    $end_date = $_POST['end_date'] ?: null;
    $id = $_POST['id'] ?? null;

    // --- AUTOMATIC STATUS LOGIC ---
    $status = '';
    $today = new DateTime();
    $startDateTime = $start_date ? new DateTime($start_date) : null;
    $endDateTime = $end_date ? new DateTime($end_date) : null;

    if ($startDateTime && $today < $startDateTime) {
        $status = 'Upcoming';
    } elseif ($endDateTime && $today > $endDateTime) {
        $status = 'Completed';
    } else {
        $status = 'Active'; // Default case if between dates or dates are not set
    }

    if (!empty($id)) { // This is an UPDATE
        // First, check if the status is already 'Cancelled'. If so, don't change it.
        $stmt_check = $conn->prepare("SELECT status FROM donation_campaigns WHERE id = ?");
        $stmt_check->bind_param("s", $id);
        $stmt_check->execute();
        $current_status = $stmt_check->get_result()->fetch_assoc()['status'];
        $stmt_check->close();

        if ($current_status === 'Cancelled') {
            $status = 'Cancelled'; // Preserve the cancelled status
        }
        
        $sql = "UPDATE donation_campaigns SET name=?, description=?, goal_amount=?, start_date=?, end_date=?, status=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsssi", $name, $description, $goal_amount, $start_date, $end_date, $status, $id);
    } else { // This is an INSERT
        $new_id = $_POST['campaign_id_field'];
        $sql = "INSERT INTO donation_campaigns (id, name, description, goal_amount, start_date, end_date, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssissi", $new_id, $name, $description, $goal_amount, $start_date, $end_date, $status);
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Campaign saved successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: Could not save the campaign. Check if the ID is unique.']);
    }

    $stmt->close();
    $conn->close();
    exit;
}