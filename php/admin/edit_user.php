<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$user_id = $_GET['id'] ?? 0;
if (!$user_id) { die("Invalid user ID."); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';

    if (empty($full_name) || empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Full Name and Email are required.']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ?, contact_number = ? WHERE id = ?");
    $stmt->bind_param("sssi", $full_name, $email, $contact_number, $user_id);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User updated successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating user.']);
    }
    exit;
}

$stmt_fetch = $conn->prepare("SELECT full_name, email, contact_number FROM users WHERE id = ?");
$stmt_fetch->bind_param("i", $user_id);
$stmt_fetch->execute();
$user = $stmt_fetch->get_result()->fetch_assoc();
if (!$user) { die("User not found."); }
?>

<a href="manage_users.php" class="action-button ajax-link" style="margin-bottom: 20px;">&larr; Back to All Users</a>

<div class="card form-container">
    <h1>Edit User Details</h1>

    <form id="editUserForm" method="post" action="edit_user.php?id=<?php echo $user_id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" name="contact_number" value="<?php echo htmlspecialchars($user['contact_number']); ?>">
        </div>
        <div class="form-actions">
            <button type="submit" class="action-button">Save Changes</button>
            <a href="details.php?user_id=<?php echo $user_id; ?>" class="ajax-link btn-secondary">Cancel</a>
        </div>
    </form>
    <div id="form-message" style="margin-top: 20px;"></div>
</div>