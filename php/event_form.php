<?php
// Core files
require_once 'db_connect.php';
require_once 'user_functions.php';

// Get the Event ID from the URL and validate it
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Event ID is missing or invalid.");
}
$event_id = (int)$_GET['id'];

// Fetch the specific event's title to display
$stmt = $conn->prepare("SELECT title FROM events WHERE id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
$stmt->close();

if (!$event) {
    http_response_code(404);
    die("Sorry, the event you are trying to register for could not be found.");
}

// Get user info from cookie to pre-populate the form
$user_details = [];
if (isset($_COOKIE['mcom_user_token'])) {
    $token = $_COOKIE['mcom_user_token'];
    $user_details = getUserByToken($conn, $token);
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register for <?php echo htmlspecialchars($event['title']); ?> - Manifestation City Outreach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark: #000000; --accent-teal: #47ab9d; --accent-teal-hover: #348b7f;
            --text-light: #ffffff; --text-dark: #272722; --text-muted: #999999;
            --bg-light: #f8f9fa; --border-color: #e0e0e0;
        }
        body, html { margin: 0; padding: 0; font-family: 'Lato', sans-serif; background-color: var(--bg-light); color: var(--text-dark); }
        .container { width: 90%; max-width: 800px; margin: 0 auto; }
        .site-header { position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; padding: 20px 0; background-color: #000; }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .navigation .sf-menu { display: flex; list-style: none; margin: 0; padding: 0; align-items: center; gap: 35px; }
        .navigation .sf-menu > li > a { color: var(--text-light); font-family: 'Open Sans', sans-serif; text-transform: uppercase; font-size: 0.85em; letter-spacing: 0.2em; text-decoration:none; }
        .header-button .btn { color: var(--text-light); border: 2px solid var(--text-light); padding: 8px 20px; border-radius: 5px; text-decoration: none; }
        main { padding-top: 120px; padding-bottom: 60px; }
        .form-container { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 40px; }
        h2 { font-family: 'Playfair Display', serif; font-size: 2.2em; text-align: center; margin-top: 0; margin-bottom: 30px; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 1.5em; margin-bottom: 20px; border-bottom: 2px solid var(--accent-teal); padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 700; }
        input[type="text"], input[type="email"], input[type="tel"], select { width:100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1em; font-family: 'Open Sans', sans-serif; box-sizing: border-box; }
        .submit-btn { width: 100%; padding: 15px; background-color: var(--accent-teal); color: var(--text-light); border: none; border-radius: 5px; font-size: 1.2em; font-weight: 700; cursor: pointer; margin-top: 30px; }
        .site-footer { background-color: var(--primary-dark); color: var(--text-light); padding: 20px 0; text-align: center; font-size: 0.9em; }
        .back-link { display: inline-block; margin-bottom: 20px; color: var(--accent-teal); font-weight: bold; text-decoration: none; }
    </style>
</head>
<body>
    <header class="site-header">
        </header>
    <main>
        <div class="container">
            <a href="event_details.php?id=<?php echo $event_id; ?>" class="back-link">&larr; Back to Event Details</a>
            <div class="form-container">
                <h2>Register for <?php echo htmlspecialchars($event['title']); ?></h2>
                <form action="event_signup_success.php" method="post" class="signup-form">
                    <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event_id); ?>">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user_details['full_name'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_details['email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="tel" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($user_details['contact_number'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <div style="display: flex; align-items: center; margin-top: 10px;">
                            <input type="checkbox" name="remember_me" id="remember_me" value="1" <?php if(isset($_COOKIE['mcom_user_token'])) echo 'checked'; ?> style="width: auto; margin: 0 10px 0 0;">
                            <label for="remember_me" style="display: inline; font-weight: normal; margin: 0;">Remember me for next time.</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">I would like to join as a...</label>
                        <select id="role" name="role" required>
                            <option value="Participant">Participant</option>
                            <option value="Volunteer">Volunteer</option>
                        </select>
                    </div>
                    <button type="submit" class="submit-btn">Complete Registration</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="site-footer">
        </footer>
</body>
</html>