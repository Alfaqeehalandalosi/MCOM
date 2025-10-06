<?php
// Secure this page
require_once 'admin_check.php';
// Connect to the database
require_once '../db_connect.php';

$campaign = [];
$page_title = "Add New Campaign";
$form_action = "process_campaign.php";

// Check if an ID is in the URL (this means we are editing)
if (isset($_GET['id'])) {
    $page_title = "Edit Campaign";
    $campaign_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM donation_campaigns WHERE id = ?");
    $stmt->bind_param("s", $campaign_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $campaign = $result->fetch_assoc();
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-container { max-width: 800px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="date"], input[type="number"], textarea, select {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;
        }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1><?php echo $page_title; ?></h1>
        <form action="<?php echo $form_action; ?>" method="post">
            
            <?php if (!empty($campaign['id'])): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($campaign['id']); ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="id-field">Campaign ID (Cannot be changed after creation)</label>
                <input type="text" id="id-field" name="campaign_id_field" value="<?php echo htmlspecialchars($campaign['id'] ?? ''); ?>" <?php echo !empty($campaign['id']) ? 'readonly' : 'required'; ?>>
            </div>

            <div class="form-group">
                <label for="name">Campaign Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($campaign['name'] ?? ''); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($campaign['description'] ?? ''); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="goal_amount">Goal Amount</label>
                <input type="number" id="goal_amount" name="goal_amount" step="0.01" value="<?php echo htmlspecialchars($campaign['goal_amount'] ?? '0.00'); ?>">
            </div>
            
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Upcoming" <?php echo (isset($campaign['status']) && $campaign['status'] == 'Upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                    <option value="Active" <?php echo (isset($campaign['status']) && $campaign['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                    <option value="Completed" <?php echo (isset($campaign['status']) && $campaign['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                    <option value="Cancelled" <?php echo (isset($campaign['status']) && $campaign['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            
            <button type="submit"><?php echo !empty($campaign['id']) ? 'Update' : 'Create'; ?> Campaign</button>
        </form>
    </div>
</body>
</html>