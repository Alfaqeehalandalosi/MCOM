<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

// NEW: Fetch the details of all upcoming events
$upcoming_events = [];
$sql = "SELECT title, event_date, location 
        FROM events 
        WHERE status = 'Upcoming' AND event_date >= NOW() 
        ORDER BY event_date ASC";
$result = $conn->query($sql);
if ($result) {
    $upcoming_events = $result->fetch_all(MYSQLI_ASSOC);
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events Overview</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; }
        .admin-container { max-width: 1000px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        nav { background-color: #333; padding: 10px; text-align: center; margin-bottom: 20px; border-radius: 8px 8px 0 0; }
        nav a { color: white; padding: 10px 15px; text-decoration: none; }
        nav a:hover { background-color: #555; }
        h1, h2 { color: #333; }
        ul { list-style-type: none; padding: 0; }
        li { background-color: #f9f9f9; border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px; }
        li strong { color: #0056b3; }
        .no-events { color: #777; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        
        <h1>Events Overview</h1>
        <h2>Upcoming Events</h2>

        <?php if (!empty($upcoming_events)): ?>
            <ul>
                <?php foreach ($upcoming_events as $event): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($event['title']); ?></strong><br>
                        <small>
                            Date: <?php echo date("D, M j, Y @ g:i A", strtotime($event['event_date'])); ?><br>
                            Location: <?php echo htmlspecialchars($event['location'] ?? 'TBD'); ?>
                        </small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-events">There are no upcoming events scheduled.</p>
        <?php endif; ?>

    </div>
</body>
</html>