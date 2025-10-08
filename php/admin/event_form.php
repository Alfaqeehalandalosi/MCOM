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

<div class="card form-container">
    <h1><?php echo $page_title; ?></h1>

    <form id="eventForm" action="process_event.php" method="post">
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
        
        <div class="form-actions">
            <button type="submit" class="action-button"><?php echo !empty($event['id']) ? 'Update' : 'Create'; ?> Event</button>
            <a href="manage_events.php" class="ajax-link btn-secondary">Cancel</a>
            
            <!-- THIS IS THE NEW BUTTON - It only shows up when editing -->
            <?php if (!empty($event['id'])): ?>
                <a href="event_action.php?action=cancel&id=<?php echo $event['id']; ?>" 
                   class="ajax-link btn-danger" 
                   data-confirm="Are you sure you want to cancel this event? This will set its status to Cancelled.">
                   Cancel Event
                </a>
            <?php endif; ?>
        </div>
    </form>
    <div id="form-message" style="margin-top: 20px;"></div>
</div>