<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$admins = $conn->query("SELECT id, full_name, username, created_at FROM admins ORDER BY full_name ASC")->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<div class="card full-width">
    <div class="toolbar">
        <a href="admins_hub.php" class="action-button ajax-link">&larr; Back to Admin Hub</a>
        <h1>Manage Admins</h1>
        <a href="create_admin.php" class="action-button ajax-link">Create New Admin</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?php echo htmlspecialchars($admin['full_name']); ?></td>
                <td><?php echo htmlspecialchars($admin['username']); ?></td>
                <td><?php echo date("M j, Y", strtotime($admin['created_at'])); ?></td>
                <td>
                    <a href="edit_admin.php?id=<?php echo $admin['id']; ?>" class="table-action-btn edit ajax-link">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>