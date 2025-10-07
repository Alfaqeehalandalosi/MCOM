<?php
require_once 'admin_check.php';
require_once '../db_connect.php'; 

// --- PHP logic to fetch users remains the same ---
$search = $_GET['search'] ?? '';
$status_filter = $_GET['status'] ?? 'Active'; // Default filter
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15; 
$offset = ($page - 1) * $limit;

$sql_base = " FROM users WHERE (full_name LIKE ? OR email LIKE ?) ";
$params = ['%'.$search.'%', '%'.$search.'%'];
$types = "ss";

if ($status_filter !== 'All') {
    $sql_base .= " AND status = ? ";
    $params[] = $status_filter;
    $types .= "s";
}

$stmt_count = $conn->prepare("SELECT COUNT(id) as total " . $sql_base);
$stmt_count->bind_param($types, ...$params);
$stmt_count->execute();
$total_users = $stmt_count->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_users / $limit);

$sql_users = "SELECT id, full_name, email, total_donation, status " . $sql_base . " ORDER BY full_name LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;
$types .= "ii";

$stmt_users = $conn->prepare($sql_users);
$stmt_users->bind_param($types, ...$params);
$stmt_users->execute();
$users = $stmt_users->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<div class="card full-width">
    <h1>Manage Users</h1>

    <div class="toolbar">
        <a href="add_user.php" class="action-button ajax-link">Add New User</a>
        
        <div class="filter-links">
            <a href="manage_users.php?status=All" class="ajax-link <?php if ($status_filter == 'All') echo 'active'; ?>">All</a>
            <a href="manage_users.php?status=Active" class="ajax-link <?php if ($status_filter == 'Active') echo 'active'; ?>">Active</a>
            <a href="manage_users.php?status=Inactive" class="ajax-link <?php if ($status_filter == 'Inactive') echo 'active'; ?>">Inactive</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Total Donations</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr><td colspan="5" style="text-align:center;">No users found for this filter.</td></tr>
            <?php else: foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>$<?php echo number_format($user['total_donation'], 2); ?></td>
                    <td><?php echo htmlspecialchars($user['status']); ?></td>
                    <td>
                        <a href="details.php?user_id=<?php echo $user['id']; ?>" class="table-action-btn view ajax-link">View</a>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="table-action-btn edit ajax-link">Edit</a>

                        <?php if ($user['status'] == 'Active'): ?>
                            <a href="user_action.php?action=deactivate&id=<?php echo $user['id']; ?>" 
                               class="table-action-btn deactivate ajax-link" 
                               data-confirm="Are you sure you want to deactivate this user?"
                               data-reload="manage_users.php?status=<?php echo $status_filter; ?>&page=<?php echo $page; ?>">Deactivate</a>
                        <?php else: ?>
                            <a href="user_action.php?action=activate&id=<?php echo $user['id']; ?>" 
                               class="table-action-btn activate ajax-link" 
                               data-confirm="Are you sure you want to activate this user?"
                               data-reload="manage_users.php?status=<?php echo $status_filter; ?>&page=<?php echo $page; ?>">Activate</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>

    <div class="pagination">
        </div>
</div>