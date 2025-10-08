<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

// FIX #1: The SQL query is updated to count ALL submissions
$sql = "SELECT
            f.id, f.form_slug, f.title, f.status,
            (SELECT COUNT(*) FROM form_submissions fs WHERE fs.form_slug = f.form_slug) AS total_submissions
        FROM forms AS f
        ORDER BY f.title ASC";

$forms = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<div class="card full-width">
    <h1>Manage Forms</h1>
    
    <a href="create_edit_form.php" class="action-button">Add New Form</a>

    <table>
        <thead>
            <tr>
                <th>Form Title</th>
                <th>Status</th>
                <th>Total Submissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($forms)): ?>
                <tr><td colspan="4" style="text-align:center;">No forms have been created yet.</td></tr>
            <?php else: foreach ($forms as $form): ?>
            <tr>
                <td><?php echo htmlspecialchars($form['title']); ?></td>
                <td><?php echo htmlspecialchars($form['status']); ?></td>
                <td>
                    <?php echo $form['total_submissions']; ?>
                </td>
                <td>
                    <a href="view_submissions.php?form_slug=<?php echo htmlspecialchars($form['form_slug']); ?>" class="table-action-btn view ajax-link">View Submissions</a>
                    <a href="create_edit_form.php?id=<?php echo $form['id']; ?>" class="table-action-btn edit">Edit</a>
                </td>
            </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>