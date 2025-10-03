<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) { die("Invalid user ID."); }
$user_id = (int)$_GET['user_id'];
$admin_id = $_SESSION['admin_id'];

// Handle submission of a new note
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['note'])) {
    $note = $_POST['note'];
    $stmt = $conn->prepare("INSERT INTO user_notes (user_id, admin_id, note) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $admin_id, $note);
    $stmt->execute();
    header("Location: details.php?user_id=" . $user_id); // Refresh to show the new note
    exit;
}

// Get User Info
$user_info = $conn->prepare("SELECT * FROM users WHERE id = ?");
$user_info->bind_param("i", $user_id);
$user_info->execute();
$user = $user_info->get_result()->fetch_assoc();
if (!$user) { die("User not found."); }

// Get Donation History
$donations = [];
$sql_donations = "SELECT d.amount, d.created_at, c.name FROM donations d JOIN donation_campaigns c ON d.campaign_id = c.id WHERE d.user_id = ? ORDER BY d.created_at DESC";
$stmt_donations = $conn->prepare($sql_donations);
$stmt_donations->bind_param("i", $user_id);
$stmt_donations->execute();
$result_donations = $stmt_donations->get_result();
while($row = $result_donations->fetch_assoc()) { $donations[] = $row; }

// Get Private Notes
$notes = [];
$sql_notes = "SELECT un.note, un.created_at, a.full_name AS admin_name FROM user_notes un JOIN admins a ON un.admin_id = a.id WHERE un.user_id = ? ORDER BY un.created_at DESC";
$stmt_notes = $conn->prepare($sql_notes);
$stmt_notes->bind_param("i", $user_id);
$stmt_notes->execute();
$result_notes = $stmt_notes->get_result();
while($row = $result_notes->fetch_assoc()) { $notes[] = $row; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details: <?php echo htmlspecialchars($user['full_name']); ?></title>
    <style>
    /* --- Your Existing Styles (formatted for readability) --- */
    body { 
        font-family: Arial, sans-serif; 
        margin: 20px; 
        background-color: #f9f9f9; 
    }
    .container { 
        max-width: 900px; 
        margin: auto; 
        background-color: #fff; 
        padding: 25px; 
        border-radius: 8px; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
    }
    h1, h2 { 
        color: #333; 
        border-bottom: 2px solid #007bff; 
        padding-bottom: 5px; 
    }
    h1 { 
        text-align: center; 
    }
    .info-grid { 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 20px; 
        margin-bottom: 20px; 
    }
    .info-box { 
        background-color: #f4f4f4; 
        padding: 15px; 
        border-radius: 5px; 
    }
    .info-box strong { 
        display: inline-block; 
        min-width: 150px; 
        color: #555; 
    }
    ul { 
        list-style-type: none; 
        padding-left: 0; 
    }
    li { 
        background-color: #fdfdfd; 
        border: 1px solid #eee; 
        padding: 10px; 
        margin-bottom: 8px; 
        border-radius: 4px; 
    }
    .note-item { 
        border-left: 4px solid #ffc107; 
    }
    textarea {
        width:100%;
        padding:10px;
        min-height:80px;
        border-radius:4px;
        border:1px solid #ddd;
    }
    button {
        padding:10px 15px;
        background-color:#28a745;
        color:white;
        border:none;
        border-radius:4px;
    }

    /* --- NEW Back Button Style (Add this part) --- */
    .back-button {
        display: inline-block;
        padding: 10px 15px;
        margin-bottom: 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
</style>
</head>
<body>
    <div class="container">
        <a href="manage_users.php" class="back-button">&larr; Back to All Users</a>
        <h1><?php echo htmlspecialchars($user['full_name']); ?></h1>

        <div class="info-grid">
            <div class="info-box">
                <h2>Contact Details (Status: <?php echo $user['status']; ?>)</h2>
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact_number'] ?: 'N/A'); ?></p>
            </div>
            <div class="info-box">
                <h2>Activity Summary</h2>
                <p><strong>Total Donation:</strong> $<?php echo number_format($user['total_donation'], 2); ?></p>
                <p><strong>Event Sign-ups:</strong> <?php echo $user['total_attended_events']; ?></p>
                <p><strong>Last Item Purchased:</strong> <?php echo htmlspecialchars($user['last_purchased_item'] ?: 'N/A'); ?></p>
            </div>
        </div>

        <h2>Private Notes</h2>
        <div class="notes-section">
            <form method="post">
                <textarea name="note" placeholder="Add a new note about this user..."></textarea>
                <button type="submit" style="margin-top:10px;">Add Note</button>
            </form>
            <ul style="margin-top:20px;">
                <?php if (empty($notes)): ?>
                    <li>No notes for this user.</li>
                <?php else: foreach ($notes as $note): ?>
                    <li class="note-item">
                        <p><?php echo nl2br(htmlspecialchars($note['note'])); ?></p>
                        <small>By <?php echo htmlspecialchars($note['admin_name']); ?> on <?php echo date("M j, Y, g:i a", strtotime($note['created_at'])); ?></small>
                    </li>
                <?php endforeach; endif; ?>
            </ul>
        </div>
        
        <h2>Donation History</h2>
        <ul>
            <?php if (empty($donations)): ?><li>No donation history.</li><?php else: foreach ($donations as $donation): ?>
            <li style="display:flex; justify-content: space-between;"><span><strong>$<?php echo number_format($donation['amount'], 2); ?></strong> to "<?php echo htmlspecialchars($donation['name']); ?>"</span><em><?php echo date("F j, Y", strtotime($donation['created_at'])); ?></em></li>
            <?php endforeach; endif; ?>
        </ul>
    </div>
</body>
</html>