<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

// Check if a form slug is provided in the URL
if (!isset($_GET['form']) || empty($_GET['form'])) {
    die("No form specified.");
}
$form_slug = $_GET['form'];

// --- NEW: PHP block to handle deletion ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete_submissions') {
    if (!empty($_POST['submission_ids'])) {
        // Sanitize the input to ensure we only have integer IDs
        $ids_to_delete = array_map('intval', $_POST['submission_ids']);
        
        // Create placeholders for the IN clause (e.g., ?,?,?)
        $placeholders = implode(',', array_fill(0, count($ids_to_delete), '?'));
        
        $stmt = $conn->prepare("DELETE FROM form_submissions WHERE id IN ($placeholders)");
        
        // Dynamically bind parameters
        $stmt->bind_param(str_repeat('i', count($ids_to_delete)), ...$ids_to_delete);
        
        $stmt->execute();
        $stmt->close();
        
        // Redirect to the same page to prevent form resubmission
        header('Location: ' . $_SERVER['PHP_SELF'] . '?form=' . urlencode($form_slug));
        exit();
    }
}
// --- End of deletion block ---


// 1. Get the form details (ID and Title) using the slug
$stmt_form = $conn->prepare("SELECT id, title FROM forms WHERE form_slug = ?");
$stmt_form->bind_param("s", $form_slug);
$stmt_form->execute();
$form = $stmt_form->get_result()->fetch_assoc();
$stmt_form->close();

if (!$form) {
    die("Form not found.");
}
$form_id = $form['id'];
$form_title = $form['title'];

// 2. Get all submissions for this form
$submissions = [];
// --- MODIFIED: Added 'id' to the SELECT query ---
$stmt_submissions = $conn->prepare("SELECT id, submission_data, submitted_at FROM form_submissions WHERE form_slug = ? ORDER BY submitted_at DESC");
$stmt_submissions->bind_param("s", $form_slug);
$stmt_submissions->execute();
$result = $stmt_submissions->get_result();
while ($row = $result->fetch_assoc()) {
    $submissions[] = $row;
}
$stmt_submissions->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submissions for <?php echo htmlspecialchars($form_title); ?></title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <style>
        .submission-card { background-color: #fff; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .submission-header { padding: 10px 15px; background-color: #f7f7f7; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; }
        .submission-body { padding: 15px; }
        .submission-body table { width: 100%; border-collapse: collapse; }
        .submission-body th, .submission-body td { text-align: left; padding: 8px; border-bottom: 1px solid #eee; }
        .submission-body th { width: 30%; font-weight: bold; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #007bff; text-decoration: none; }
        .bulk-actions { background-color: #f9f9f9; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; display: flex; align-items: center; gap: 20px; }
        .delete-btn { background-color: #dc3545; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .delete-btn:hover { background-color: #c82333; }
        .submission-select input { width: 18px; height: 18px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        <div class="main-content">
            <a href="manage_forms.php" class="back-link">&larr; Back to All Forms</a>
            <h1>Submissions for "<?php echo htmlspecialchars($form_title); ?>"</h1>

            <?php if (empty($submissions)): ?>
                <p>There are no submissions for this form yet.</p>
            <?php else: ?>
                <form method="post" onsubmit="return confirm('Are you sure you want to delete the selected submissions?');">
                    <div class="bulk-actions">
                        <button type="submit" name="action" value="delete_submissions" class="delete-btn">Delete Selected</button>
                        <label style="font-weight: bold; cursor: pointer;">
                            <input type="checkbox" id="select-all"> Select All
                        </label>
                    </div>

                    <?php foreach ($submissions as $submission): ?>
                        <div class="submission-card">
                            <div class="submission-header">
                                <div><strong>Submitted On:</strong> <?php echo date("F j, Y, g:i a", strtotime($submission['submitted_at'])); ?></div>
                                <div class="submission-select">
                                    <input type="checkbox" name="submission_ids[]" value="<?php echo $submission['id']; ?>" class="submission-checkbox">
                                </div>
                            </div>
                            <div class="submission-body">
                                <table>
                                    <?php
                                    $data = json_decode($submission['submission_data'], true);
                                    if (is_array($data)) {
                                        foreach ($data as $key => $value) {
                                            $field_name = ucwords(str_replace('_', ' ', htmlspecialchars($key)));
                                            $field_value = htmlspecialchars($value);
                                            echo "<tr><th>{$field_name}</th><td>{$field_value}</td></tr>";
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form> <?php endif; ?>
        </div>
    </div>

    <script>
        document.getElementById('select-all').addEventListener('click', function(event) {
            const checkboxes = document.querySelectorAll('.submission-checkbox');
            for (const checkbox of checkboxes) {
                checkbox.checked = event.target.checked;
            }
        });
    </script>
</body>
</html>