<?php
require_once 'db_connect.php';
require_once 'user_functions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Event ID is missing or invalid.");
}
$event_id = (int)$_GET['id'];

// Fetch event title
$stmt = $conn->prepare("SELECT title FROM events WHERE id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$event) {
    die("Event not found.");
}

// Get user info from cookie
$user_details = [];
if (isset($_COOKIE['mcom_user_token'])) {
    $user_details = getUserByToken($conn, $_COOKIE['mcom_user_token']);
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register for <?php echo htmlspecialchars($event['title']); ?></title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="../colors/color1.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .main { padding-top: 150px; padding-bottom: 60px; }
        .form-container { max-width: 800px; margin: 0 auto; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 40px; }
        h2 { font-family: 'Playfair Display', serif; text-align: center; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 700; }
        input, select { width:100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 5px; font-size: 1em; box-sizing: border-box; }
        .submit-btn { width: 100%; padding: 15px; background-color: #47ab9d; color: #fff; border: none; border-radius: 5px; font-size: 1.2em; cursor: pointer; margin-top: 20px; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #47ab9d; font-weight: bold; text-decoration: none; }
    </style>
</head>
<body class="body">
    
    <?php // include '../header.php'; ?>

    <main class="main" role="main">
        <div class="container">
            <a href="event_details.php?id=<?php echo $event_id; ?>" class="back-link">&larr; Back to Event Details</a>
            <div class="form-container">
                <h2>Register for <?php echo htmlspecialchars($event['title']); ?></h2>
                <form action="event_signup_success.php" method="post">
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" value="<?php echo htmlspecialchars($user_details['full_name'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user_details['email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="tel" name="contact_number" value="<?php echo htmlspecialchars($user_details['contact_number'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember_me" id="remember_me" value="1" <?php if(isset($_COOKIE['mcom_user_token'])) echo 'checked'; ?>>
                        <label for="remember_me" style="display: inline;">Remember me for next time.</label>
                    </div>
                    <button type="submit" class="submit-btn">Complete Registration</button>
                </form>
            </div>
        </div>
    </main>

    <?php // include '../footer.php'; ?>

</body>
</html>