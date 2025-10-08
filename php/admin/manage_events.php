<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$events = $conn->query("SELECT id, title, event_date, status FROM events ORDER BY event_date DESC")->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<div class="card full-width">
    <h1>Manage Events</h1>
    <a href="event_form.php" class="action-button ajax-link">Add New Event</a>

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
                <td>
                    <a href="event_form.php?id=<?php echo $event['id']; ?>" class="table-action-btn edit ajax-link">Edit</a>
                    <a href="event_action.php?action=delete&id=<?php echo $event['id']; ?>" class="table-action-btn deactivate ajax-link" data-confirm="Are you sure you want to delete this event? This action cannot be undone.">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>