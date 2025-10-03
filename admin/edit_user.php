<?php
session_start();
require_once '../db_connect.php';

// Admin-only page
if (!isset($_SESSION['admin_loggedin'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_GET['id'] ?? 0;
if (!$user_id) {
    die("Invalid user ID.");
}

$error_message = '';
$user = null;

// Handle form submission to UPDATE the user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ?, contact_number = ? WHERE id = ?");
    $stmt->bind_param("sssi", $_POST['full_name'], $_POST['email'], $_POST['contact_number'], $user_id);
    $stmt->execute();
    
    // Redirect back to the user's details page after updating
    header("Location: details.php?user_id=" . $user_id);
    exit;
}

// Fetch the current user data to populate the form
$stmt = $conn->prepare("SELECT full_name, email, contact_number FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$user) {
    die("User not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h1 { text-align: center; color: #333; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        .cancel-link { display: block; text-align: center; margin-top: 15px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit User Details</h1>
        <form method="post">
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
            <button type="submit">Save Changes</button>
            <a href="details.php?user_id=<?php echo $user_id; ?>" class="cancel-link">Cancel</a>
        </form>
    </div>
</body>
</html>