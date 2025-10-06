<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "UPDATE events SET title=?, event_date=?, location=?, description=?, status=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $title, $event_date, $location, $description, $status, $id);
    } else {
        $sql = "INSERT INTO events (title, event_date, location, description, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $title, $event_date, $location, $description, $status);
    }

    if ($stmt->execute()) {
        header("location: manage_events.php");
        exit;
    } else {
        echo "Error: Could not save the event.";
    }
    $stmt->close();
    $conn->close();
}
?>