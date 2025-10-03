<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

// Check for a valid ID in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_admins.php");
    exit;
}
$admin_id = $_GET['id'];

// Fetch the admin's current data
$stmt = $conn->prepare("SELECT full_name, username FROM admins WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Admin not found.");
}
$admin = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { max-width: 700px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .cancel-link { display: inline-block; margin-left: 10px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        <h1>Edit Admin: <?php echo htmlspecialchars($admin['username']); ?></h1>
        
        <form action="process_admin_edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $admin_id; ?>">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($admin['full_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
            </div>
            <button type="submit">Update Admin</button>
            <a href="manage_admins.php" class="cancel-link">Cancel</a>
        </form>
    </div>
</body>
</html>