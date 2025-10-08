<?php
require_once 'admin_check.php';
require_once '../db_connect.php'; // ADD THIS LINE

// --- REAL DATA FETCHING (Corrected Version) ---

// Query 1: Get total donation revenue
$sql_revenue = "SELECT SUM(amount) as total_revenue FROM donations";
$result_revenue = $conn->query($sql_revenue);
$revenue_data = $result_revenue->fetch_assoc();
$total_donation_revenue = $revenue_data['total_revenue'] ?? 0;

// Query 2: Get new users from the last 30 days
$sql_users = "SELECT COUNT(id) as new_users FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
$result_users = $conn->query($sql_users);
$users_data = $result_users->fetch_assoc();
$new_users_count = $users_data['new_users'] ?? 0;

// Query 3: Get event signups from the last 30 days
$sql_events = "SELECT COUNT(id) as signups FROM event_attendees WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
$result_events = $conn->query($sql_events);
$events_data = $result_events->fetch_assoc();
$monthly_event_signups = $events_data['signups'] ?? 0;


// Query 4: Get the 5 most recent activities (donations)
$recent_activities = [];
$sql_activity = "
    SELECT d.amount, d.created_at, u.full_name, dc.name as campaign_name 
    FROM donations d 
    JOIN users u ON d.user_id = u.id 
    JOIN donation_campaigns dc ON d.campaign_id = dc.id 
    ORDER BY d.created_at DESC 
    LIMIT 5";
$result_activity = $conn->query($sql_activity);
if ($result_activity) {
    while($row = $result_activity->fetch_assoc()) {
        $recent_activities[] = $row;
    }
}
?>

<header class="main-header">
    <h1>Welcome Back, <?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?>!</h1>
    <p>Here's what's happening with your ministry today.</p>
</header>

<div class="stat-cards-grid">
    <div class="card">
        <h3>Total Donation Revenue</h3>
        <p class="stat-value">$<?php echo number_format($total_donation_revenue, 2); ?></p>
        <p class="stat-change positive">+14.9%</p>
    </div>
    <div class="card">
        <h3>New Users (30 Days)</h3>
        <p class="stat-value"><?php echo $new_users_count; ?></p>
        <p class="stat-change negative">-8.6%</p>
    </div>
    <div class="card">
        <h3>Event Signups (30 Days)</h3>
        <p class="stat-value"><?php echo $monthly_event_signups; ?></p>
        <p class="stat-change positive">+20.1%</p>
    </div>
</div>

<div class="card full-width">
    <h3>Recent Activity</h3>
    <table>
        <thead>
            <tr>
                <th>Details</th>
                <th>User</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($recent_activities)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No recent activity found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($recent_activities as $activity): ?>
                <tr>
                    <td>Donation to "<?php echo htmlspecialchars($activity['campaign_name']); ?>"</td>
                    <td><?php echo htmlspecialchars($activity['full_name']); ?></td>
                    <td><strong>$<?php echo number_format($activity['amount'], 2); ?></strong></td>
                    <td><?php echo date("M j, Y, g:i a", strtotime($activity['created_at'])); ?></td>
                    <td><span class="status shipped">Completed</span></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>