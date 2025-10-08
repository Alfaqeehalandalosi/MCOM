<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$user_id = $_GET['user_id'] ?? 0;
if (!$user_id) { die("Invalid user ID."); }

// Handle submission of a new note
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['note'])) {
    header('Content-Type: application/json');
    $note = $_POST['note'];
    $admin_id = $_SESSION['admin_id'];
    $stmt = $conn->prepare("INSERT INTO user_notes (user_id, admin_id, note) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $admin_id, $note);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Note added.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Could not add note.']);
    }
    exit;
}

// Get User Info, Donations, and Notes
$user_info = $conn->prepare("SELECT * FROM users WHERE id = ?");
$user_info->bind_param("i", $user_id);
$user_info->execute();
$user = $user_info->get_result()->fetch_assoc();
if (!$user) { die("User not found."); }

$donations = $conn->query("SELECT d.amount, d.created_at, c.name FROM donations d JOIN donation_campaigns c ON d.campaign_id = c.id WHERE d.user_id = $user_id ORDER BY d.created_at DESC")->fetch_all(MYSQLI_ASSOC);
$notes = $conn->query("SELECT un.note, un.created_at, a.full_name AS admin_name FROM user_notes un JOIN admins a ON un.admin_id = a.id WHERE un.user_id = $user_id ORDER BY un.created_at DESC")->fetch_all(MYSQLI_ASSOC);
?>

<div class="card full-width">
    <div class="toolbar">
        <a href="manage_users.php" class="action-button ajax-link">&larr; Back to All Users</a>
    </div>

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

    <div class="details-section">
        <h2>Private Notes</h2>
        <form id="addNoteForm" method="post" action="details.php?user_id=<?php echo $user_id; ?>" class="note-form">
            <div class="form-group">
                <textarea name="note" placeholder="Add a new note about this user..."></textarea>
            </div>
            <button type="submit" class="action-button">Add Note</button>
        </form>
        <div id="form-message" style="margin-top: 15px;"></div>
        <ul class="note-list">
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
    
    <div class="details-section">
        <h2>Donation History</h2>
        <ul>
            <?php if (empty($donations)): ?><li>No donation history.</li><?php else: foreach ($donations as $donation): ?>
            <li class="donation-item">
                <span><strong>$<?php echo number_format($donation['amount'], 2); ?></strong> to "<?php echo htmlspecialchars($donation['name']); ?>"</span>
                <em><?php echo date("F j, Y", strtotime($donation['created_at'])); ?></em>
            </li>
            <?php endforeach; endif; ?>
        </ul>
    </div>
</div>