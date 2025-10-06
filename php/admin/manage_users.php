<?php
require_once '../user_functions.php'; // Include the new toolbox
require_once 'admin_check.php';       // Your admin security check

// --- SIMPLIFIED LOGIC USING OUR NEW FUNCTION ---
$search = $_GET['search'] ?? '';
$status_filter = $_GET['status'] ?? 'Active';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15;
$offset = ($page - 1) * $limit;

// All the complex query building is now in one function call
$data = getAllUsersWithPagination($conn, [
    'search' => $search,
    'status' => $status_filter,
    'limit'  => $limit,
    'offset' => $offset
]);

$users = $data['users'];
$total_pages = $data['total_pages'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <style>
        /* Your CSS styles remain the same */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { max-width: 1200px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .search-filter form { display: flex; gap: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        .pagination { margin-top: 20px; text-align: center; }
        .pagination a { margin: 0 5px; text-decoration: none; padding: 5px 10px; border: 1px solid #ddd; }
        .pagination a.active { background-color: #007bff; color: white; }
        .action-button { display: inline-block; padding: 10px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
<div class="admin-container">
    <?php include 'admin_nav.php'; ?>
    <h1>Manage Users</h1>

    <div class="toolbar">
        <div class="search-filter">
            <form method="get">
                <input type="text" name="search" placeholder="Search by name or email..." value="<?php echo htmlspecialchars($search); ?>">
                <select name="status" onchange="this.form.submit()">
                    <option value="Active" <?php if ($status_filter == 'Active') echo 'selected'; ?>>Active</option>
                    <option value="Inactive" <?php if ($status_filter == 'Inactive') echo 'selected'; ?>>Inactive</option>
                    <option value="All" <?php if ($status_filter == 'All') echo 'selected'; ?>>All</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>
        <a href="add_user.php" class="action-button">Add New User</a>
    </div>

    <table>
        <thead><tr><th>Name</th><th>Email</th><th>Total Donations</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>$<?php echo number_format($user['total_donation'], 2); ?></td>
                <td><?php echo htmlspecialchars($user['status']); ?></td>
                <td>
                    <a href="details.php?user_id=<?php echo $user['id']; ?>">Details</a> |
                    <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a> |
                    <?php if ($user['status'] == 'Active'): ?>
                        <a href="user_action.php?action=deactivate&id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?')">Deactivate</a>
                    <?php else: ?>
                        <a href="user_action.php?action=activate&id=<?php echo $user['id']; ?>">Activate</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&status=<?php echo urlencode($status_filter); ?>" class="<?php if ($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</div>
</body>
</html>