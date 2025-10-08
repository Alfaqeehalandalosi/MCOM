<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$admin_id = $_GET['id'] ?? 0;
if (!$admin_id) { die("Invalid admin ID."); }

// Handle form submission to UPDATE the admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    
    $full_name = $_POST['full_name'] ?? '';
    $username = $_POST['username'] ?? '';

    if (empty($full_name) || empty($username)) {
        echo json_encode(['status' => 'error', 'message' => 'Full Name and Username are required.']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE admins SET full_name = ?, username = ? WHERE id = ?");
    $stmt->bind_param("ssi", $full_name, $username, $admin_id);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Admin updated successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating admin. The username might already be taken.']);
    }
    exit;
}

// Fetch the current admin data to populate the form
$stmt_fetch = $conn->prepare("SELECT full_name, username FROM admins WHERE id = ?");
$stmt_fetch->bind_param("i", $admin_id);
$stmt_fetch->execute();
$admin = $stmt_fetch->get_result()->fetch_assoc();
if (!$admin) { die("Admin not found."); }
?>

<div class="card form-container">
    <a href="manage_admins.php" class="action-button ajax-link" style="margin-bottom: 20px;">&larr; Back to Admin List</a>
    <h1>Edit Admin Details</h1>

    <form id="editAdminForm" method="post" action="edit_admin.php?id=<?php echo $admin_id; ?>">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($admin['full_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
        </div>
        <div class="form-actions">
            <button type="submit" class="action-button">Save Changes</button>
            <a href="manage_admins.php" class="ajax-link btn-secondary">Cancel</a>
        </div>
    </form>
    <div id="form-message" style="margin-top: 20px;"></div>
</div>