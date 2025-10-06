<?php
// Secure this page
require_once 'admin_check.php';
// Connect to the database
require_once '../db_connect.php';

// NEW: A more advanced query to get campaign details and their donation stats
$campaigns = [];
$sql = "SELECT 
            c.id, 
            c.name, 
            c.status, 
            c.goal_amount,
            COUNT(DISTINCT d.user_id) AS total_donors,
            SUM(d.amount) AS total_amount
        FROM donation_campaigns c
        LEFT JOIN donations d ON c.id = d.campaign_id
        GROUP BY c.id, c.name, c.status, c.goal_amount
        ORDER BY c.name ASC";

$result = $conn->query($sql);
if ($result) {
    $campaigns = $result->fetch_all(MYSQLI_ASSOC);
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Campaigns</title>
    <style>
         body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { max-width: 1200px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        nav { background-color: #333; padding: 10px; text-align: center; margin-bottom: 20px; }
        nav a { color: white; padding: 10px 15px; text-decoration: none; }
        nav a:hover { background-color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        .add-button { display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>

        <h1>Manage Donation Campaigns</h1>
        <a href="campaign_form.php" class="add-button">Add New Campaign</a>

        <table>
            <thead>
                <tr>
                    <th>Campaign Name</th>
                    <th>Status</th>
                    <th>Goal Amount</th>
                    <th>Donations Received</th>
                    <th>Unique Donors</th>
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
                        <a href="campaign_form.php?id=<?php echo htmlspecialchars($campaign['id']); ?>">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>