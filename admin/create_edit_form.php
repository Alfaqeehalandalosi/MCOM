<?php
// Error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'admin_check.php';
require_once '../db_connect.php';

// --- INITIALIZE VARIABLES ---
$form_data = ['id' => null, 'title' => '', 'form_slug' => '', 'status' => 'Active', 'event_id' => null];
$form_fields = [];
$page_title = 'Create New Form';
$is_edit_mode = false;

// --- HANDLE EDIT MODE ---
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $is_edit_mode = true;
    $form_id = (int)$_GET['id'];
    $page_title = 'Edit Form';

    $stmt = $conn->prepare("SELECT * FROM forms WHERE id = ?");
    $stmt->bind_param("i", $form_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $form_data = $result->fetch_assoc();
    } else {
        die("Form not found.");
    }
    $stmt->close();
    
    $stmt_fields = $conn->prepare("SELECT * FROM form_fields WHERE form_id = ? ORDER BY display_order ASC");
    $stmt_fields->bind_param("i", $form_id);
    $stmt_fields->execute();
    $form_fields = $stmt_fields->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_fields->close();
}

// --- SMARTER QUERY TO FETCH ONLY AVAILABLE EVENTS ---
$sql_events = "SELECT id, title FROM events WHERE id NOT IN (SELECT event_id FROM forms WHERE event_id IS NOT NULL)";
if ($is_edit_mode && $form_data['event_id']) {
    $sql_events .= " OR id = " . (int)$form_data['event_id'];
}
$sql_events .= " ORDER BY event_date DESC";
$events_list = $conn->query($sql_events)->fetch_all(MYSQLI_ASSOC);

// --- HANDLE FORM SUBMISSION (CREATE OR UPDATE) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_id = $_POST['form_id'] ? (int)$_POST['form_id'] : null;
    $title = trim($_POST['title']);
    $form_slug = trim($_POST['form_slug']);
    $status = $_POST['status'];
    $event_id = !empty($_POST['event_id']) ? (int)$_POST['event_id'] : null;

    $conn->begin_transaction();
    try {
        if ($is_edit_mode && $form_id) {
            $stmt = $conn->prepare("UPDATE forms SET title = ?, form_slug = ?, status = ?, event_id = ? WHERE id = ?");
            $stmt->bind_param("sssii", $title, $form_slug, $status, $event_id, $form_id);
            $stmt->execute();
            $stmt->close();
            $stmt_delete = $conn->prepare("DELETE FROM form_fields WHERE form_id = ?");
            $stmt_delete->bind_param("i", $form_id);
            $stmt_delete->execute();
            $stmt_delete->close();
        } else {
            $stmt = $conn->prepare("INSERT INTO forms (title, form_slug, status, event_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $title, $form_slug, $status, $event_id);
            $stmt->execute();
            $form_id = $stmt->insert_id;
            $stmt->close();
        }
        if (isset($_POST['field_label'])) {
            $stmt_insert_field = $conn->prepare("INSERT INTO form_fields (form_id, field_label, field_type, field_options, is_required, display_order) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($_POST['field_label'] as $index => $label) {
                if (!empty(trim($label))) {
                    $type = $_POST['field_type'][$index];
                    $options = $_POST['field_options'][$index];
                    $required = isset($_POST['is_required'][$index]) ? 1 : 0;
                    $order = $index + 1;
                    $stmt_insert_field->bind_param("isssii", $form_id, $label, $type, $options, $required, $order);
                    $stmt_insert_field->execute();
                }
            }
            $stmt_insert_field->close();
        }
        $conn->commit();
        header("Location: manage_forms.php?status=success");
        exit;
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        header("Location: manage_forms.php?status=error&msg=" . urlencode($exception->getMessage()));
        exit;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; }
        .admin-container { max-width: 900px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2 { color: #333; }
        .form-section { border: 1px solid #ddd; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], select, textarea { width:100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .save-btn { display: inline-block; padding: 12px 25px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; border: none; font-size: 16px; cursor: pointer; }
        #fields-container { border: 1px solid #ddd; border-radius: 5px; min-height: 100px; padding: 10px; }
        .field-block { background-color: #f9f9f9; border: 1px solid #ccc; border-radius: 4px; padding: 15px; margin-bottom: 10px; position: relative; }
        .field-block-header { cursor: move; padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #eee; }
        .field-row { display: flex; gap: 15px; align-items: flex-end; margin-bottom: 10px; }
        .field-row > div { flex-grow: 1; }
        .remove-field-btn { position: absolute; top: 10px; right: 10px; background: #dc3545; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer; font-weight: bold; }
        .add-field-btn { margin-top: 10px; padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px; }
        .field-placeholder { background: #eef7ff; border: 2px dashed #007bff; height: 100px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'admin_nav.php'; ?>
        <h1><?php echo $page_title; ?></h1>
        <form method="post">
            <input type="hidden" name="form_id" value="<?php echo htmlspecialchars($form_data['id'] ?? ''); ?>">
            <div class="form-section">
                <h2>Form Details</h2>
                <div class="form-group">
                    <label for="event_id">Associated Event (Optional)</label>
                    <select id="event_id" name="event_id" onchange="updateFormTitle(this)">
                        <option value="" data-title="">-- None --</option>
                        <?php foreach ($events_list as $event): ?>
                            <option value="<?php echo $event['id']; ?>" 
                                    data-title="<?php echo htmlspecialchars($event['title']); ?>"
                                    <?php if (($form_data['event_id'] ?? null) == $event['id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($event['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Form Title</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($form_data['title'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="form_slug">Form Slug (Unique Identifier)</label>
                    <input type="text" id="form_slug" name="form_slug" value="<?php echo htmlspecialchars($form_data['form_slug'] ?? ''); ?>" required placeholder="e.g., connect-card">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="Active" <?php if (($form_data['status'] ?? 'Active') == 'Active') echo 'selected'; ?>>Active</option>
                        <option value="Inactive" <?php if (($form_data['status'] ?? '') == 'Inactive') echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="form-section">
                <h2>Form Fields</h2>
                <div id="fields-container">
                    <?php if (!empty($form_fields)): foreach ($form_fields as $index => $field): ?>
                        <div class="field-block">
                            <div class="field-block-header"><strong><?php echo htmlspecialchars(ucfirst($field['field_type'])); ?></strong> (Drag to reorder)</div>
                            <button type="button" class="remove-field-btn">×</button>
                            <div class="field-row">
                                <div><label>Label</label><input type="text" name="field_label[]" value="<?php echo htmlspecialchars($field['field_label']); ?>" required></div>
                                <div><label>Type</label>
                                    <select name="field_type[]" class="field-type-select">
                                        <option value="text" <?php if($field['field_type'] == 'text') echo 'selected'; ?>>Text</option>
                                        <option value="email" <?php if($field['field_type'] == 'email') echo 'selected'; ?>>Email</option>
                                        <option value="tel" <?php if($field['field_type'] == 'tel') echo 'selected'; ?>>Phone</option>
                                        <option value="date" <?php if($field['field_type'] == 'date') echo 'selected'; ?>>Date</option>
                                        <option value="textarea" <?php if($field['field_type'] == 'textarea') echo 'selected'; ?>>Text Area</option>
                                        <option value="select" <?php if($field['field_type'] == 'select') echo 'selected'; ?>>Dropdown Select</option>
                                        <option value="checkbox" <?php if($field['field_type'] == 'checkbox') echo 'selected'; ?>>Checkboxes</option>
                                        <option value="radio" <?php if($field['field_type'] == 'radio') echo 'selected'; ?>>Radio Buttons</option>
                                    </select>
                                </div>
                                <div><label style="visibility:hidden;">Required</label><label><input type="checkbox" name="is_required[<?php echo $index; ?>]" value="1" <?php if ($field['is_required']) echo 'checked'; ?>> Required</label></div>
                            </div>
                            <div class="field-row options-container" style="<?php if(!in_array($field['field_type'], ['select','checkbox','radio'])) echo 'display:none;'; ?>">
                                <div style="width:100%"><label>Options (comma-separated)</label><textarea name="field_options[]"><?php echo htmlspecialchars($field['field_options']); ?></textarea></div>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>
                </div>
                <button type="button" class="add-field-btn" id="add-field-btn">+ Add New Field</button>
            </div>
            <button type="submit" class="save-btn">Save Form</button>
        </form>
    </div>

    <template id="field-template">
        <div class="field-block">
            <div class="field-block-header"><strong>Text</strong> (Drag to reorder)</div>
            <button type="button" class="remove-field-btn">×</button>
            <div class="field-row">
                <div><label>Label</label><input type="text" name="field_label[]" required></div>
                <div><label>Type</label>
                    <select name="field_type[]" class="field-type-select">
                        <option value="text" selected>Text</option><option value="email">Email</option><option value="tel">Phone</option><option value="date">Date</option><option value="textarea">Text Area</option><option value="select">Dropdown Select</option><option value="checkbox">Checkboxes</option><option value="radio">Radio Buttons</option>
                    </select>
                </div>
                <div><label style="visibility:hidden;">Required</label><label><input type="checkbox" class="is-required-checkbox" value="1"> Required</label></div>
            </div>
            <div class="field-row options-container" style="display:none;">
                <div style="width:100%"><label>Options (comma-separated)</label><textarea name="field_options[]"></textarea></div>
            </div>
        </div>
    </template>

    <script>
    function updateFormTitle(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const eventTitle = selectedOption.dataset.title;
        const formTitleInput = document.getElementById('title');
        const formSlugInput = document.getElementById('form_slug');
        if (eventTitle) {
            formTitleInput.value = eventTitle + " Registration";
            formSlugInput.value = eventTitle.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '') + "-registration";
        } else {
            formTitleInput.value = '';
            formSlugInput.value = '';
        }
    }

    // Use jQuery's document ready function for all event listeners
    $(function() {
        let fieldIndex = <?php echo count($form_fields); ?>;
        const fieldsContainer = $('#fields-container');

        // Function to toggle the options text area
        function toggleOptions(selectElement) {
            const $fieldBlock = $(selectElement).closest('.field-block');
            const $optionsContainer = $fieldBlock.find('.options-container');
            const showOptions = ['select', 'checkbox', 'radio'].includes($(selectElement).val());
            $optionsContainer.toggle(showOptions);
            $fieldBlock.find('.field-block-header strong').text($(selectElement).find('option:selected').text());
        }

        // Attach event listener for adding a new field
        $('#add-field-btn').on('click', function() {
            const template = $('#field-template')[0];
            const clone = template.content.cloneNode(true);
            const $clone = $(clone);

            // Uniquely name the 'is_required' checkbox for this new field
            $clone.find('.is-required-checkbox').attr('name', `is_required[${fieldIndex}]`).removeClass('is-required-checkbox');
            
            fieldsContainer.append($clone);
            fieldIndex++;
        });

        // Use event delegation for dynamically added elements
        fieldsContainer.on('click', '.remove-field-btn', function() {
            $(this).closest('.field-block').remove();
        });

        fieldsContainer.on('change', '.field-type-select', function() {
            toggleOptions(this);
        });

        // Initialize drag-and-drop
        fieldsContainer.sortable({
            handle: ".field-block-header",
            placeholder: "field-placeholder",
            forcePlaceholderSize: true
        });
    });
    </script>
</body>
</html>