<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

$campaign = [];
$page_title = "Add New Campaign";
$is_editing = false;

if (isset($_GET['id'])) {
    $is_editing = true;
    $page_title = "Edit Campaign";
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM donation_campaigns WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $campaign = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>

<div class="card form-container">
    <h1><?php echo $page_title; ?></h1>

    <form id="campaignForm" action="process_campaign.php" method="post">
        <?php if ($is_editing): ?>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($campaign['id']); ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="campaign_id_field">Campaign ID (slug)</label>
            <input type="text" id="campaign_id_field" name="campaign_id_field" value="<?php echo htmlspecialchars($campaign['id'] ?? ''); ?>" <?php echo $is_editing ? 'readonly' : 'required'; ?> placeholder="e.g., building-fund-2025">
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
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($campaign['start_date'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($campaign['end_date'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="goal_amount">Goal Amount</label>
            <input type="number" step="0.01" id="goal_amount" name="goal_amount" value="<?php echo htmlspecialchars($campaign['goal_amount'] ?? '0.00'); ?>" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="action-button"><?php echo $is_editing ? 'Update' : 'Create'; ?> Campaign</button>
            <a href="campaigns.php" class="ajax-link btn-secondary">Cancel</a>
            
            <?php if ($is_editing): ?>
                <a href="campaign_action.php?action=cancel&id=<?php echo htmlspecialchars($campaign['id']); ?>" 
                   class="ajax-link btn-danger" 
                   data-confirm="Are you sure you want to cancel this campaign?"
                   data-reload="campaigns.php">
                   Cancel Campaign
                </a>
            <?php endif; ?>
        </div>
    </form>
    <div id="form-message" style="margin-top: 20px;"></div>
</div>