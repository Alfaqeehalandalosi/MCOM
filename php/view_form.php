<?php
require_once 'db_connect.php';
require_once 'user_functions.php';

// --- 1. GET FORM INFO FROM URL ---
if (!isset($_GET['slug'])) {
    die("Form not specified.");
}
$form_slug = trim($_GET['slug']);

// --- 2. FETCH FORM AND ITS FIELDS FROM DATABASE ---
$stmt_form = $conn->prepare("SELECT * FROM forms WHERE form_slug = ? AND status = 'Active'");
$stmt_form->bind_param("s", $form_slug);
$stmt_form->execute();
$form = $stmt_form->get_result()->fetch_assoc();
$stmt_form->close();

if (!$form) {
    http_response_code(404);
    die("This form could not be found or is currently inactive.");
}

$stmt_fields = $conn->prepare("SELECT * FROM form_fields WHERE form_id = ? ORDER BY display_order ASC");
$stmt_fields->bind_param("i", $form['id']);
$stmt_fields->execute();
$fields = $stmt_fields->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_fields->close();

$user_details = [];
if (isset($_COOKIE['mcom_user_token'])) {
    $token = $_COOKIE['mcom_user_token'];
    $user_details = getUserByToken($conn, $token);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($form['title']); ?> - Manifestation City Outreach</title>
    <style>
        /* All CSS is the same as before */
        :root {
            --primary-dark: #000000; --accent-teal: #47ab9d; --accent-teal-hover: #348b7f;
            --text-light: #ffffff; --text-dark: #272722; --text-muted: #999999;
            --bg-light: #f8f9fa; --border-color: #e0e-0e0;
        }
        body, html { margin: 0; padding: 0; font-family: 'Lato', sans-serif; background-color: var(--bg-light); color: var(--text-dark); }
        .container { width: 90%; max-width: 800px; margin: 0 auto; }
        .form-container { background-color: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 40px; }
        h2 { font-family: 'Playfair Display', serif; font-size: 2.2em; text-align: center; margin-top: 0; margin-bottom: 10px; }
        .form-description { text-align: center; color: var(--text-muted); margin-bottom: 30px; font-size: 1.1em; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 700; }
        input[type="text"], input[type="email"], input[type="tel"], input[type="date"], select, textarea { width:100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 1em; font-family: 'Open Sans', sans-serif; box-sizing: border-box; }
        .submit-btn { width: 100%; padding: 15px; background-color: var(--accent-teal); color: var(--text-light); border: none; border-radius: 5px; font-size: 1.2em; font-weight: 700; cursor: pointer; margin-top: 30px; }
        .options-group label { font-weight: normal; margin-bottom: 10px; }
        .options-group input { margin-right: 10px; }
    </style>
</head>
<body>
    <header class="site-header">
        </header>
    <main>
        <div class="container">
            <div class="form-container">
                <h2><?php echo htmlspecialchars($form['title']); ?></h2>
                <?php if ($form['description']): ?>
                    <p class="form-description"><?php echo htmlspecialchars($form['description']); ?></p>
                <?php endif; ?>

                <form action="form_submit_handler.php" method="post">
                    <input type="hidden" name="form_slug" value="<?php echo htmlspecialchars($form['form_slug']); ?>">
                    
                    <?php foreach ($fields as $field): ?>
                        <div class="form-group">
                            <label for="field_<?php echo $field['id']; ?>">
                                <?php echo htmlspecialchars($field['field_label']); ?>
                                <?php if ($field['is_required']) echo '<span style="color:red;">*</span>'; ?>
                            </label>

                            <?php 
                            $field_name = "fields[" . $field['id'] . "]";
                            $required_attr = $field['is_required'] ? 'required' : '';
                            
                            switch ($field['field_type']) {
                                case 'text': case 'email': case 'tel': case 'date':
                                    echo "<input type='{$field['field_type']}' name='{$field_name}' id='field_{$field['id']}' {$required_attr}>";
                                    break;

                                case 'textarea':
                                    echo "<textarea name='{$field_name}' id='field_{$field['id']}' {$required_attr}></textarea>";
                                    break;

                                case 'select':
                                    $options = explode(',', $field['field_options']);
                                    echo "<select name='{$field_name}' id='field_{$field['id']}' {$required_attr}>";
                                    echo "<option value=''>-- Please Select --</option>";
                                    foreach ($options as $option) {
                                        $opt = trim($option);
                                        echo "<option value='{$opt}'>" . htmlspecialchars($opt) . "</option>";
                                    }
                                    echo "</select>";
                                    break;

                                case 'radio':
                                    $options = explode(',', $field['field_options']);
                                    echo "<div class='options-group'>";
                                    $is_first = true; // Flag for the first radio button
                                    foreach ($options as $option) {
                                        $opt = trim($option);
                                        // **FIX:** Apply 'required' only to the first radio button in a group
                                        $radio_required = ($is_first && $field['is_required']) ? 'required' : '';
                                        echo "<div><label><input type='radio' name='{$field_name}' value='{$opt}' {$radio_required}> " . htmlspecialchars($opt) . "</label></div>";
                                        $is_first = false;
                                    }
                                    echo "</div>";
                                    break;

                                case 'checkbox':
                                    $options = explode(',', $field['field_options']);
                                    // **FIX:** Add a wrapper div to handle checkbox group validation
                                    echo "<div class='options-group' " . ($field['is_required'] ? "data-required='true'" : "") . ">";
                                    foreach ($options as $option) {
                                        $opt = trim($option);
                                        echo "<div><label><input type='checkbox' name='{$field_name}[]' value='{$opt}'> " . htmlspecialchars($opt) . "</label></div>";
                                    }
                                    echo "</div>";
                                    break;
                            }
                            ?>
                        </div>
                    <?php endforeach; ?>
                    
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="site-footer">
        </footer>

    <script>
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            const requiredCheckboxGroups = document.querySelectorAll('.options-group[data-required="true"]');
            
            requiredCheckboxGroups.forEach(group => {
                const checkboxes = group.querySelectorAll('input[type="checkbox"]');
                let isChecked = false;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        isChecked = true;
                    }
                });

                if (!isChecked) {
                    event.preventDefault(); // Stop form submission
                    alert('Please select at least one option for the required checkbox group.');
                    // Optional: Scroll to the group or highlight it
                    group.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    group.style.border = '2px solid red';
                    group.style.padding = '10px';
                    group.style.borderRadius = '5px';
                } else {
                    // Reset styles if it's valid
                    group.style.border = 'none';
                    group.style.padding = '0';
                }
            });
        });
    </script>
</body>
</html>