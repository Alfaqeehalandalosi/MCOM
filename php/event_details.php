<?php
require_once 'db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Event ID is missing or invalid.");
}
$event_id = (int)$_GET['id'];

// Fetch all event data for display
$stmt_event = $conn->prepare("SELECT id, title, description, event_date, location, image_path FROM events WHERE id = ?");
$stmt_event->bind_param("i", $event_id);
$stmt_event->execute();
$event = $stmt_event->get_result()->fetch_assoc();
$stmt_event->close();

if (!$event) {
    http_response_code(404);
    die("Sorry, the event you are looking for could not be found.");
}

// --- NEW: Check if a custom form is associated with this event ---
$form_slug = null;
$stmt_form = $conn->prepare("SELECT form_slug FROM forms WHERE event_id = ? AND status = 'Active' LIMIT 1");
$stmt_form->bind_param("i", $event_id);
$stmt_form->execute();
$result_form = $stmt_form->get_result();
if ($result_form->num_rows === 1) {
    $form_slug = $result_form->fetch_assoc()['form_slug'];
}
$stmt_form->close();
$conn->close();
?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($event['title']); ?> - Manifestation City Outreach</title>
    <style>
         /* All your previous styles... */
        :root {
            --primary-dark: #000000; --accent-teal: #47ab9d; --accent-teal-hover: #348b7f;
            --text-light: #ffffff; --text-dark: #272727; --text-muted: #999999;
            --bg-light: #f8f9fa; --border-color: #e0e0e0;
        }
        body, html { margin: 0; padding: 0; font-family: 'Lato', sans-serif; background-color: var(--bg-light); color: var(--text-dark); }
        .container { width: 90%; max-width: 960px; margin: 0 auto; }
        main { padding-top: 120px; }
        .event-detail-card { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); overflow: hidden; margin-bottom: 40px; }
        .event-detail-image { width: 100%; height: 400px; background-size: cover; background-position: center; }
        .event-detail-content { padding: 40px; }
        .event-detail-title { font-family: 'Playfair Display', serif; font-size: 2.8em; margin: 0 0 10px 0; }
        .event-meta { font-size: 1.1em; color: var(--text-muted); margin-bottom: 30px; display: flex; flex-wrap: wrap; gap: 20px; }
        .event-meta span { display: flex; align-items: center; gap: 8px; }
        .event-description { font-family: 'Open Sans', sans-serif; font-size: 1.1em; line-height: 1.8; color: #444; }
        .back-link { display: inline-block; margin: 20px 0; color: var(--accent-teal); font-weight: bold; text-decoration: none; }
        .register-button-wrap { text-align: center; margin-top: 40px; padding-top: 40px; border-top: 1px solid var(--border-color); }
        .register-button { display: inline-block; padding: 15px 40px; background-color: var(--accent-teal); color: var(--text-light); text-decoration: none; border-radius: 5px; font-size: 1.2em; font-weight: 700; transition: background-color 0.3s ease; }
        .register-button:hover { background-color: var(--accent-teal-hover); }
        .no-registration { color: var(--text-muted); font-style: italic; }
    </style>
</head>
<body>
    <header class="site-header">
        </header>
    <main>
        <div class="container">
            <a href="events.php" class="back-link">&larr; Back to All Events</a>
            <div class="event-detail-card">
                <div class="event-detail-image" style="background-image: url('<?php echo htmlspecialchars($event['image_path']); ?>');"></div>
                <div class="event-detail-content">
                    <h1 class="event-detail-title"><?php echo htmlspecialchars($event['title']); ?></h1>
                    <div class="event-meta">
                        <span><i class="fa fa-calendar"></i> <?php echo date('l, F j, Y', strtotime($event['event_date'])); ?></span>
                        <span><i class="fa fa-clock-o"></i> <?php echo date('g:i A', strtotime($event['event_date'])); ?></span>
                        <span><i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($event['location']); ?></span>
                    </div>
                    <div class="event-description">
                        <?php echo nl2br(htmlspecialchars($event['description'])); ?>
                    </div>

                    <div class="register-button-wrap">
                        <?php if ($form_slug): ?>
                            <a href="forms.php?show_slug=<?php echo htmlspecialchars($form_slug); ?>" class="register-button">Register for this Event</a>
                        <?php else: ?>
                            <p class="no-registration">Registration for this event is not available at this time.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
</html>