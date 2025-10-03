<?php
require_once 'db_connect.php';
require_once 'user_functions.php';

// --- Logic for the main page list ---
$forms_list = $conn->query("SELECT id, form_slug, title, description FROM forms WHERE status = 'Active' ORDER BY title ASC")->fetch_all(MYSQLI_ASSOC);

// --- Logic for the Popup Modal ---
$show_modal = false;
$modal_form = null;
$modal_fields = [];
$user_details = [];

// Check if the URL is asking to show a specific form
if (isset($_GET['show_slug']) && !empty($_GET['show_slug'])) {
    $slug_to_show = trim($_GET['show_slug']);
    
    // Get form details for the modal
    $stmt_form = $conn->prepare("SELECT * FROM forms WHERE form_slug = ? AND status = 'Active'");
    $stmt_form->bind_param("s", $slug_to_show);
    $stmt_form->execute();
    $modal_form = $stmt_form->get_result()->fetch_assoc();
    $stmt_form->close();

    if ($modal_form) {
        $show_modal = true; // Flag to tell the page to open the modal

        // Get all fields for this form
        $stmt_fields = $conn->prepare("SELECT * FROM form_fields WHERE form_id = ? ORDER BY display_order ASC");
        $stmt_fields->bind_param("i", $modal_form['id']);
        $stmt_fields->execute();
        $modal_fields = $stmt_fields->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt_fields->close();

        // Get user info to pre-populate the form
        if (isset($_COOKIE['mcom_user_token'])) {
            $token = $_COOKIE['mcom_user_token'];
            $user_details = getUserByToken($conn, $token);
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forms - Manifestation City Outreach</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Open+Sans:wght@400;700&family=Playfair+Display:wght@900&display=swap" rel="stylesheet">
    <style>
        /* All previous styles for the list page are the same... */
        :root { --primary-dark: #000000; --accent-teal: #47ab9d; /* ...etc */ }
        body, html { margin: 0; padding: 0; font-family: 'Lato', sans-serif; background-color: #f8f9fa; }
        .container { width: 90%; max-width: 900px; margin: 0 auto; }
        main { padding-top: 120px; padding-bottom: 60px; }
        .page-title { font-family: 'Playfair Display', serif; font-size: 2.5em; text-align: center; }
        .form-list-container { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        .form-list-item { display: flex; align-items: center; padding: 20px 25px; border-bottom: 1px solid #e0e0e0; text-decoration: none; color: inherit; }
        .form-list-item:hover { background-color: #f9f9f9; }
        .form-content { flex-grow: 1; }
        .form-title { font-size: 1.2em; font-weight: 700; }

        /* --- NEW: CSS FOR THE MODAL --- */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.6); z-index: 2000;
            display: none; align-items: center; justify-content: center;
        }
        .modal-content {
            background-color: #fff; padding: 40px; border-radius: 8px;
            width: 90%; max-width: 600px; position: relative;
        }
        .modal-close-btn {
            position: absolute; top: 15px; right: 15px; font-size: 1.5em;
            cursor: pointer; border: none; background: none; color: #aaa;
        }
        .modal-content h2 { font-family: 'Playfair Display', serif; font-size: 2.2em; text-align: center; margin-top: 0; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 700; }
        input[type="text"], input[type="email"], input[type="tel"], input[type="date"], select, textarea { width:100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .submit-btn { width: 100%; padding: 15px; background-color: var(--accent-teal); color: #fff; border: none; border-radius: 5px; font-size: 1.2em; cursor: pointer; }
        .options-group label { font-weight: normal; }
        .options-group input { margin-right: 10px; }
    </style>
</head>
<body>
    <header class="site-header"></header>

    <main>
        <div class="container">
            <h2 class="page-title">Available Forms</h2>
            <div class="form-list-container">
                <?php foreach ($forms_list as $form): ?>
                    <a href="?show_slug=<?php echo htmlspecialchars($form['form_slug']); ?>" class="form-list-item">
                        <div class="form-content">
                            <h3 class="form-title"><?php echo htmlspecialchars($form['title']); ?></h3>
                            <p><?php echo htmlspecialchars($form['description']); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <?php if ($show_modal): ?>
    <div class="modal-overlay" id="registration-modal">
        <div class="modal-content">
            <button class="modal-close-btn" id="modal-close-btn">&times;</button>
            <h2><?php echo htmlspecialchars($modal_form['title']); ?></h2>
            <p><?php echo htmlspecialchars($modal_form['description']); ?></p>

            <form action="form_submit_handler.php" method="post">
                <input type="hidden" name="form_slug" value="<?php echo htmlspecialchars($modal_form['form_slug']); ?>">
                <?php foreach ($modal_fields as $field): ?>
                    <div class="form-group">
                        <label><?php echo htmlspecialchars($field['field_label']); if ($field['is_required']) echo '<span style="color:red;">*</span>'; ?></label>
                        <?php // This is the same rendering logic from view_form.php
                            $field_name = "fields[" . $field['id'] . "]";
                            $required_attr = $field['is_required'] ? 'required' : '';
                            switch ($field['field_type']) {
                                case 'text': case 'email': case 'tel': case 'date':
                                    echo "<input type='{$field['field_type']}' name='{$field_name}' {$required_attr}>";
                                    break;
                                case 'textarea':
                                    echo "<textarea name='{$field_name}' {$required_attr}></textarea>";
                                    break;
                                case 'select':
                                    $options = explode(',', $field['field_options']);
                                    echo "<select name='{$field_name}' {$required_attr}><option value=''>-- Select --</option>";
                                    foreach ($options as $opt) echo "<option value='".trim($opt)."'>".trim($opt)."</option>";
                                    echo "</select>";
                                    break;
                                // Add cases for radio and checkbox here if needed, same as view_form.php
                            }
                        ?>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <footer class="site-footer"></footer>

    <script>
        <?php if ($show_modal): ?>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('registration-modal');
            const closeBtn = document.getElementById('modal-close-btn');
            function showModal() { modal.style.display = 'flex'; }
            function hideModal() { modal.style.display = 'none'; }
            showModal();
            closeBtn.addEventListener('click', hideModal);
            modal.addEventListener('click', function(e) { if (e.target === modal) hideModal(); });
        });
        <?php endif; ?>
    </script>
</body>
</html>