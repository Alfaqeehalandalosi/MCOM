<?php
// We must start the PHP logic before any HTML is sent.
require_once 'db_connect.php';
require_once 'user_functions.php';

// Only process the form if it was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. Get User and Event Info from Form ---
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $event_id = (int)$_POST['event_id'];
    $role = $_POST['role']; // 'Participant' or 'Volunteer'

    // --- 2. Find or Create the User ---
    // This uses the function we created in user_functions.php
    $user_id = findOrCreateUser($conn, $full_name, $email, $contact_number);

    // --- 3. Handle the "Remember Me" Checkbox ---
    if (isset($_POST['remember_me']) && $user_id) {
        $token = bin2hex(random_bytes(32));
        $stmt = $conn->prepare("UPDATE users SET persistent_token = ? WHERE id = ?");
        $stmt->bind_param("si", $token, $user_id);
        $stmt->execute();
        $stmt->close();
        // Set cookie for 1 year
        setcookie('mcom_user_token', $token, time() + (86400 * 365), "/"); 
    }

    // --- 4. Register User for the Event and Update Their Stats ---
    $conn->begin_transaction();
    try {
        // First, get the event's name to update the user's profile
        $stmt_event = $conn->prepare("SELECT title FROM events WHERE id = ?");
        $stmt_event->bind_param("i", $event_id);
        $stmt_event->execute();
        $event_title = $stmt_event->get_result()->fetch_assoc()['title'];
        $stmt_event->close();

        // Insert into event_attendees table (it will fail silently if they are already registered)
        $stmt_attend = $conn->prepare("INSERT IGNORE INTO event_attendees (user_id, event_id, role) VALUES (?, ?, ?)");
        $stmt_attend->bind_param("iis", $user_id, $event_id, $role);
        $stmt_attend->execute();
        $stmt_attend->close();

        // Update the summary columns in the users table
        $stmt_update_user = $conn->prepare("UPDATE users SET total_attended_events = total_attended_events + 1, attend_upcoming_event = ? WHERE id = ?");
        $stmt_update_user->bind_param("si", $event_title, $user_id);
        $stmt_update_user->execute();
        $stmt_update_user->close();

        $conn->commit();

    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        // In a real application, you would log this error.
        // For now, we just stop the process.
        die("There was a database error. Please try again.");
    }

    $conn->close();

} else {
    // If someone tries to access this page directly, redirect them.
    header('Location: events.php');
    exit();
}

// --- The original success message HTML will be displayed below ---
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Successful!</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
        .container { max-width: 600px; margin: auto; }
        h1 { color: #28a745; }
        p { font-size: 1.2em; }
        a { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You!</h1>
        <p>You have successfully registered for the event. We look forward to seeing you there!</p>
        <a href="events.php">See More Events</a>
        <a href="dashboard.php">Return to Homepage</a>
    </div>
</body>
</html>