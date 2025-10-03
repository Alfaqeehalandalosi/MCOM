<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, contact_number) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $email, $contact_number);
    
    if ($stmt->execute()) {
        header("Location: users.php?status=user_added");
        exit;
    } else {
        $error_message = "Error: Could not add user. The email might already exist.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <style>body { font-family: Arial, sans-serif; background-color: #f4f4f4; }.admin-container { max-width: 700px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }.form-group { margin-bottom: 15px; }label { display: block; margin-bottom: 5px; font-weight: bold; }input[type="text"], input[type="email"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }button { padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }</style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        <h1>Add a New User</h1>
        <?php if (isset($error_message)): ?><p style="color:red;"><?php echo $error_message; ?></p><?php endif; ?>
        <form method="post">
            <div class="form-group"><label for="full_name">Full Name</label><input type="text" name="full_name" required></div>
            <div class="form-group"><label for="email">Email</label><input type="email" name="email" required></div>
            <div class="form-group"><label for="contact_number">Contact Number</label><input type="text" name="contact_number"></div>
            <button type="submit">Save User</button>
        </form>
    </div>
</body>
</html>