<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$event = [];
$page_title = "Add New Event";

if (isset($_GET['id'])) {
    $page_title = "Edit Event";
    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0;}
        .admin-container { max-width: 800px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="datetime-local"], textarea, select {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;
        }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        nav { background-color: #333; padding: 10px; text-align: center; margin-bottom: 20px; border-radius: 8px 8px 0 0; }
        nav a { color: white; padding: 10px 15px; text-decoration: none; }
        nav a:hover { background-color: #555; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        <h1><?php echo $page_title; ?></h1>
        <form action="process_event.php" method="post">
            <?php if (!empty($event['id'])): ?>
                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($event['title'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="event_date">Date and Time</label>
                <input type="datetime-local" id="event_date" name="event_date" value="<?php echo !empty($event['event_date']) ? date('Y-m-d\TH:i', strtotime($event['event_date'])) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($event['location'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5"><?php echo htmlspecialchars($event['description'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Upcoming" <?php echo (isset($event['status']) && $event['status'] == 'Upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                    <option value="Completed" <?php echo (isset($event['status']) && $event['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                    <option value="Cancelled" <?php echo (isset($event['status']) && $event['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit"><?php echo !empty($event['id']) ? 'Update' : 'Create'; ?> Event</button>
        </form>
    </div>
</body>
</html>