<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

// This query fetches all forms and also counts how many "Unread" submissions each one has.
$sql = "SELECT
            f.id,
            f.form_slug,
            f.title,
            f.status,
            COUNT(fs.id) AS unread_submissions
        FROM
            forms AS f
        LEFT JOIN
            form_submissions AS fs ON f.form_slug = fs.form_slug AND fs.status = 'Unread'
        GROUP BY
            f.id, f.form_slug, f.title, f.status
        ORDER BY
            f.title ASC";

$forms = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Forms</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; }
        .admin-container { max-width: 1000px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        .add-button { display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; }
        .add-button:hover { background-color: #218838; }
        .badge { background-color: #dc3545; color: white; padding: 3px 8px; border-radius: 10px; font-size: 0.8em; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; // Include your standard admin navigation ?>
        <h1>Manage Forms</h1>
        <a href="create_edit_form.php" class="add-button">Add New Form</a>

        <table>
            <thead>
                <tr>
                    <th>Form Title</th>
                    <th>Status</th>
                    <th>New Submissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($forms)): ?>
                    <tr>
                        <td colspan="4">No forms have been created yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($forms as $form): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($form['title']); ?></td>
                        <td><?php echo htmlspecialchars($form['status']); ?></td>
                        <td>
                            <?php echo $form['unread_submissions']; ?>
                            <?php if ($form['unread_submissions'] > 0): ?>
                                <span class="badge">New</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="view_submissions.php?form=<?php echo htmlspecialchars($form['form_slug']); ?>">View Submissions</a> |
                            <a href="create_edit_form.php?id=<?php echo $form['id']; ?>">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>