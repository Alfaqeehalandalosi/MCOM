<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$form_slug = $_GET['form_slug'] ?? '';
if (!$form_slug) { die("No form specified."); }

// Mark submissions as 'Read' when viewed
$conn->query("UPDATE form_submissions SET status = 'Read' WHERE form_slug = '{$conn->real_escape_string($form_slug)}' AND status = 'Unread'");

$form_title = $conn->query("SELECT title FROM forms WHERE form_slug = '{$conn->real_escape_string($form_slug)}'")->fetch_assoc()['title'];
$submissions = $conn->query("SELECT * FROM form_submissions WHERE form_slug = '{$conn->real_escape_string($form_slug)}' ORDER BY submitted_at DESC")->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<div class="card full-width">
    <a href="manage_forms.php" class="action-button ajax-link" style="margin-bottom: 20px;">&larr; Back to Forms List</a>
    <h1>Submissions for "<?php echo htmlspecialchars($form_title); ?>"</h1>

    <?php if (empty($submissions)): ?>
        <p>There are no submissions for this form yet.</p>
    <?php else: ?>
        <?php foreach ($submissions as $sub): 
            $data = json_decode($sub['submission_data'], true);
        ?>
            <div class="submission-card">
                <div class="submission-header">
                    <strong>Submission #<?php echo $sub['id']; ?></strong>
                    <small>Received on: <?php echo date("M j, Y, g:i a", strtotime($sub['submitted_at'])); ?></small>
                </div>
                <div class="submission-body">
                    <?php if (is_array($data)): foreach ($data as $label => $value): ?>
                        <p><strong><?php echo htmlspecialchars($label); ?>:</strong> <?php echo nl2br(htmlspecialchars($value)); ?></p>
                    <?php endforeach; else: ?>
                        <p>Could not read submission data.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>
    .submission-card { border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; }
    .submission-header { background-color: #f8f9fa; padding: 10px 15px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; }
    .submission-body { padding: 15px; }
    .submission-body p { margin: 0 0 10px 0; border-bottom: 1px solid #eee; padding-bottom: 10px; }
    .submission-body p:last-child { border-bottom: none; }
</style>