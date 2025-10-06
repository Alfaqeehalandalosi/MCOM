<?php
// Secure this page
require_once 'admin_check.php';
// Connect to the database
require_once '../db_connect.php'; // Note: ../ goes up one directory

// --- Fetch Overall Statistics for the top cards ---

// 1. Get total number of users
$total_users = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];

// 2. Get the grand total of all donations
$total_donations = $conn->query("SELECT SUM(amount) as total FROM donations")->fetch_assoc()['total'];

// 3. Get number of active campaigns
$active_campaigns = $conn->query("SELECT COUNT(*) as count FROM donation_campaigns WHERE status = 'Active'")->fetch_assoc()['count'];


// --- NEW: Fetch detailed stats for each campaign ---
$campaign_stats = [];
$sql = "SELECT 
            c.name AS campaign_name,
            COUNT(DISTINCT d.user_id) AS total_donors,
            SUM(d.amount) AS total_amount
        FROM donation_campaigns c
        LEFT JOIN donations d ON c.id = d.campaign_id
        GROUP BY c.id, c.name
        ORDER BY c.name ASC";

$result = $conn->query($sql);
if ($result) {
    $campaign_stats = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        /* Basic styles for the admin panel */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { max-width: 1000px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; text-align: center; }
        .stat-card { background-color: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .stat-card h3 { margin-top: 0; }
        .stat-card p { font-size: 2em; font-weight: bold; margin-bottom: 0; color: #007bff; }
        nav { background-color: #333; padding: 10px; text-align: center; margin-bottom: 20px; }
        nav a { color: white; padding: 10px 15px; text-decoration: none; }
        nav a:hover { background-color: #555; }
        h1, h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        
        <h1>Admin Dashboard</h1>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
            <div class="stat-card">
                <h3>Grand Total Donations</h3>
                <p>$<?php echo number_format($total_donations ?? 0, 2); ?></p>
            </div>
            <div class="stat-card">
                <h3>Active Campaigns</h3>
                <p><?php echo $active_campaigns; ?></p>
            </div>
        </div>

        <hr style="margin: 30px 0;">

        <h2>Campaign Donation Summary</h2>
        <table>
            <thead>
                <tr>
                    <th>Campaign Name</th>
                    <th>Total Unique Donors</th>
                    <th>Total Donations Received</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($campaign_stats)): ?>
                    <?php foreach ($campaign_stats as $stat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($stat['campaign_name']); ?></td>
                        <td><?php echo $stat['total_donors']; ?></td>
                        <td>$<?php echo number_format($stat['total_amount'] ?? 0, 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align:center;">No donation data available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>