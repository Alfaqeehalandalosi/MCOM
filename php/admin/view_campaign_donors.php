<?php
require_once 'admin_check.php';
require_once '../db_connect.php'; 

$campaign_id = $_GET['id'] ?? '';
if (!$campaign_id) {
    die("No campaign specified.");
}

// Get the campaign's name for the page title
$stmt_title = $conn->prepare("SELECT name FROM donation_campaigns WHERE id = ?");
$stmt_title->bind_param("s", $campaign_id);
$stmt_title->execute();
$campaign_title = $stmt_title->get_result()->fetch_assoc()['name'];
$stmt_title->close();

// --- NEW SQL QUERY ---
// This query gets the full details for every user who donated to this specific campaign.
$sql = "SELECT 
            u.id, 
            u.full_name, 
            u.email, 
            u.contact_number,
            u.total_donation,
            (SELECT COUNT(id) FROM donations WHERE user_id = u.id) as donation_count
        FROM users u
        WHERE u.id IN (SELECT DISTINCT user_id FROM donations WHERE campaign_id = ?)
        ORDER BY u.full_name ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $campaign_id);
$stmt->execute();
$donors = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<div class="card full-width">
    <a href="campaigns.php" class="action-button ajax-link" style="margin-bottom: 20px;">&larr; Back to Campaigns</a>
    <h1>Donors for "<?php echo htmlspecialchars($campaign_title); ?>"</h1>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th># of Donations</th>
                <th>Total Donated (All Time)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($donors)): ?>
                <tr><td colspan="6" style="text-align:center;">No donations have been made to this campaign yet.</td></tr>
            <?php else: foreach ($donors as $donor): ?>
                <tr>
                    <td><?php echo htmlspecialchars($donor['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($donor['email']); ?></td>
                    <td><?php echo htmlspecialchars($donor['contact_number'] ?? 'N/A'); ?></td>
                    <td><?php echo $donor['donation_count']; ?></td>
                    <td><strong>$<?php echo number_format($donor['total_donation'], 2); ?></strong></td>
                    <td>
                        <a href="details.php?user_id=<?php echo $donor['id']; ?>" class="table-action-btn view ajax-link">View User</a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>