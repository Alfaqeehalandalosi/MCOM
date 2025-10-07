<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$sql = "SELECT 
            c.id, c.name, c.status, c.goal_amount,
            COUNT(DISTINCT d.user_id) AS total_donors,
            SUM(d.amount) AS total_amount
        FROM donation_campaigns c
        LEFT JOIN donations d ON c.id = d.campaign_id
        GROUP BY c.id, c.name, c.status, c.goal_amount
        ORDER BY c.name ASC";

$campaigns = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<div class="card full-width">
    <h1>Manage Donation Campaigns</h1>
    <a href="campaign_form.php" class="action-button ajax-link">Add New Campaign</a>

    <table>
        <thead>
            <tr>
                <th>Campaign Name</th>
                <th>Status</th>
                <th>Goal Amount</th>
                <th>Donations Received</th>
                <th>total Donors</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($campaigns as $campaign): ?>
            <tr>
                <td><?php echo htmlspecialchars($campaign['name']); ?></td>
                <td><?php echo htmlspecialchars($campaign['status']); ?></td>
                <td>$<?php echo number_format($campaign['goal_amount'], 2); ?></td>
                <td>$<?php echo number_format($campaign['total_amount'] ?? 0, 2); ?></td>
                <td><?php echo $campaign['total_donors']; ?></td>
                <td>
                    <a href="view_campaign_donors.php?id=<?php echo htmlspecialchars($campaign['id']); ?>" class="table-action-btn view ajax-link">View Donors</a>
                    <a href="campaign_form.php?id=<?php echo htmlspecialchars($campaign['id']); ?>" class="table-action-btn edit ajax-link">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>