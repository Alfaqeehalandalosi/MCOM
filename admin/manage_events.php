<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$events = $conn->query("SELECT id, title, event_date, status FROM events ORDER BY event_date DESC")->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Events</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; }
        .admin-container { max-width: 1000px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        nav { background-color: #333; padding: 10px; text-align: center; margin-bottom: 20px; border-radius: 8px 8px 0 0; }
        nav a { color: white; padding: 10px 15px; text-decoration: none; }
        nav a:hover { background-color: #555; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        .add-button { display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; }
        .add-button:hover { background-color: #218838; }
        .action-links a { margin-right: 10px; }
        .action-links a.delete { color: #dc3545; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        <h1>Manage Events</h1>
        <a href="event_form.php" class="add-button">Add New Event</a>

        <table>
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['title']); ?></td>
                    <td><?php echo date("D, M j, Y @ g:i A", strtotime($event['event_date'])); ?></td>
                    <td><?php echo htmlspecialchars($event['status']); ?></td>
                    <td class="action-links">
                        <a href="event_form.php?id=<?php echo $event['id']; ?>">Edit</a>
                        <a href="event_action.php?action=delete&id=<?php echo $event['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this event? This action cannot be undone.');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>