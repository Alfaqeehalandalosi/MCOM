<?php
// Secure this page
require_once 'admin_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        /* Basic styles for the admin panel */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { max-width: 1000px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #333; }

        /* Consistent button styles */
        .action-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #28a745; /* Green for primary create/manage actions */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.2s;
        }
        .action-button:hover {
            background-color: #218838;
        }
        .action-button.secondary {
             background-color: #007bff; /* Blue for other actions */
        }
        .action-button.secondary:hover {
             background-color: #0056b3;
        }
        .quick-actions {
            display: flex;
            gap: 15px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        
        <?php include 'admin_nav.php'; ?>
        
        <h1>Admin Dashboard</h1>
        <p>Welcome to the main dashboard. Select an option from the menu or a quick action below to get started.</p>

        <div class="quick-actions">
            <a href="manage_admins.php" class="action-button">Manage Admins</a>
            <a href="manage_forms.php" class="action-button">Manage Forms</a>
            <a href="create_admin.php" class="action-button">Create New Admin</a>
            <a href="change_password.php" class="action-button secondary">Change Your Password</a>
        </div>

    </div>
</body>
</html>