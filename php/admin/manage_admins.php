<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

// Fetch all admins from the database
$admins = $conn->query("SELECT id, full_name, username, created_at FROM admins ORDER BY full_name ASC")->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Admins</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { max-width: 1000px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        <h1>Manage Admins</h1>

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
                    <td><a href="edit_admin.php?id=<?php echo $admin['id']; ?>">Edit</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>