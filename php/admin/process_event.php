<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    $title = $_POST['title'];
    $event_date = $_POST['event_date']; // This comes from Flatpickr in 'YYYY-MM-DD HH:MM' format
    $location = $_POST['location'];
    $description = $_POST['description'];
    $id = $_POST['id'] ?? null;

    // --- AUTOMATIC STATUS LOGIC ---
    // Create DateTime objects to compare
    $eventDateTime = new DateTime($event_date);
    $nowDateTime = new DateTime();

    // If the event's date is in the future, it's 'Upcoming'. Otherwise, it's 'Completed'.
    if ($eventDateTime > $nowDateTime) {
        $status = 'Upcoming';
    } else {
        $status = 'Completed';
    }
    // Note: You could add logic for 'Cancelled' status elsewhere if needed.

    if (!empty($id)) {
        $sql = "UPDATE events SET title=?, event_date=?, location=?, description=?, status=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $title, $event_date, $location, $description, $status, $id);
    } else {
        $sql = "INSERT INTO events (title, event_date, location, description, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $title, $event_date, $location, $description, $status);
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Event saved successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: Could not save the event.']);
    }
    $stmt->close();
    $conn->close();
    exit;
}