<?php
// --- This is the entire PHP block from your original file ---
ini_set('display_errors', 1); error_reporting(E_ALL);
require_once 'admin_check.php'; require_once '../db_connect.php';
$form_data = ['id' => null, 'title' => '', 'form_slug' => '', 'status' => 'Active', 'event_id' => null];
$form_fields = []; $page_title = 'Create New Form'; $is_edit_mode = false;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $is_edit_mode = true; $form_id = (int)$_GET['id']; $page_title = 'Edit Form';
    $stmt = $conn->prepare("SELECT * FROM forms WHERE id = ?"); $stmt->bind_param("i", $form_id); $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) { $form_data = $result->fetch_assoc(); } else { die("Form not found."); }
    $stmt->close();
    $stmt_fields = $conn->prepare("SELECT * FROM form_fields WHERE form_id = ? ORDER BY display_order ASC");
    $stmt_fields->bind_param("i", $form_id); $stmt_fields->execute();
    $form_fields = $stmt_fields->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_fields->close();
}
$sql_events = "SELECT id, title FROM events WHERE id NOT IN (SELECT event_id FROM forms WHERE event_id IS NOT NULL)";
if ($is_edit_mode && $form_data['event_id']) { $sql_events .= " OR id = " . (int)$form_data['event_id']; }
$sql_events .= " ORDER BY event_date DESC";
$events_list = $conn->query($sql_events)->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- POST handler now redirects back to the main admin panel ---
    $form_id = $_POST['form_id'] ? (int)$_POST['form_id'] : null;
    $title = trim($_POST['title']); $form_slug = trim($_POST['form_slug']);
    $status = $_POST['status']; $event_id = !empty($_POST['event_id']) ? (int)$_POST['event_id'] : null;
    $conn->begin_transaction();
    try {
        if ($is_edit_mode && $form_id) {
            $stmt = $conn->prepare("UPDATE forms SET title = ?, form_slug = ?, status = ?, event_id = ? WHERE id = ?");
            $stmt->bind_param("sssii", $title, $form_slug, $status, $event_id, $form_id); $stmt->execute(); $stmt->close();
            $stmt_delete = $conn->prepare("DELETE FROM form_fields WHERE form_id = ?"); $stmt_delete->bind_param("i", $form_id); $stmt_delete->execute(); $stmt_delete->close();
        } else {
            $stmt = $conn->prepare("INSERT INTO forms (title, form_slug, status, event_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $title, $form_slug, $status, $event_id); $stmt->execute();
            $form_id = $stmt->insert_id; $stmt->close();
        }
        if (isset($_POST['field_label'])) {
            $stmt_insert_field = $conn->prepare("INSERT INTO form_fields (form_id, field_label, field_type, field_options, is_required, display_order) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($_POST['field_label'] as $index => $label) {
                if (!empty(trim($label))) {
                    $type = $_POST['field_type'][$index]; $options = $_POST['field_options'][$index];
                    $required = isset($_POST['is_required'][$index]) ? 1 : 0; $order = $index + 1;
                    $stmt_insert_field->bind_param("isssii", $form_id, $label, $type, $options, $required, $order);
                    $stmt_insert_field->execute();
                }
            }
            $stmt_insert_field->close();
        }
        $conn->commit();
        header("Location: admin_panel.php?load=manage_forms.php");
        exit;
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        die("Error: " . $exception->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="css/admin_style.css"> 
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>
<body style="background-color: #f8f9fa;">

    <div class="card form-container" style="max-width: 900px; margin: 30px auto;">
        <a href="admin_panel.php?load=manage_forms.php" class="action-button" style="margin-bottom: 20px;">&larr; Back to Forms List</a>
        
        <h1><?php echo $page_title; ?></h1>
        
        <form id="formBuilder" method="post" action="create_edit_form.php?id=<?php echo $form_data['id'] ?? ''; ?>">
            <input type="hidden" name="form_id" value="<?php echo htmlspecialchars($form_data['id'] ?? ''); ?>">
            
            <div class="form-section">
                <h2>Form Details</h2>
                <div class="form-group">
                    <label for="event_id">Associated Event (Optional)</label>
                    <select id="event_id" name="event_id">
                        <option value="" data-title="">-- None --</option>
                        <?php foreach ($events_list as $event): ?>
                            <option value="<?php echo $event['id']; ?>" data-title="<?php echo htmlspecialchars($event['title']); ?>" <?php if (($form_data['event_id'] ?? null) == $event['id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($event['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Form Title</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($form_data['title'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="form_slug">Form Slug (Unique ID)</label>
                        <input type="text" id="form_slug" name="form_slug" value="<?php echo htmlspecialchars($form_data['form_slug'] ?? ''); ?>" required placeholder="e.g., connect-card">
                    </div>
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
                        <button type="button" class="remove-field-btn">&times;</button>
                        <div class="form-group">
                            <label>Label</label>
                            <input type="text" name="field_label[]" value="<?php echo htmlspecialchars($field['field_label']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="field_type[]" class="field-type-select">
                                <option value="text" <?php if($field['field_type'] == 'text') echo 'selected'; ?>>Text</option>
                                <option value="email" <?php if($field['field_type'] == 'email') echo 'selected'; ?>>Email</option>
                                <option value="tel" <?php if($field['field_type'] == 'tel') echo 'selected'; ?>>Phone</option>
                                <option value="date" <?php if($field['field_type'] == 'date') echo 'selected'; ?>>Date</option>
                                <option value="textarea" <?php if($field['field_type'] == 'textarea') echo 'selected'; ?>>Text Area</option>
                                <option value="select" <?php if($field['field_type'] == 'select') echo 'selected'; ?>>Dropdown</option>
                                <option value="checkbox" <?php if($field['field_type'] == 'checkbox') echo 'selected'; ?>>Checkboxes</option>
                                <option value="radio" <?php if($field['field_type'] == 'radio') echo 'selected'; ?>>Radio Buttons</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="is_required[<?php echo $index; ?>]" value="1" <?php if ($field['is_required']) echo 'checked'; ?>> Required</label>
                        </div>
                        <div class="form-group options-container" style="<?php if(!in_array($field['field_type'], ['select','checkbox','radio'])) echo 'display:none;'; ?>">
                            <label>Options</label>
                            <div class="tag-input-container">
                                <input type="text" class="tag-input" placeholder="Type an option and press Enter">
                                <input type="hidden" class="hidden-options-input" name="field_options[]" value="<?php echo htmlspecialchars($field['field_options']); ?>">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
                <button type="button" class="action-button add-field-btn" id="add-field-btn">+ Add New Field</button>
            </div>
            <button type="submit" class="action-button" style="font-size: 16px; width: 100%;">Save Form</button>
        </form>
    </div>

    <template id="field-template">
        <div class="field-block">
            <div class="field-block-header"><strong>Text</strong> (Drag to reorder)</div>
            <button type="button" class="remove-field-btn">&times;</button>
            <div class="form-group">
                <label>Label</label>
                <input type="text" name="field_label[]" required>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select name="field_type[]" class="field-type-select">
                    <option value="text" selected>Text</option>
                    <option value="email">Email</option>
                    <option value="tel">Phone</option>
                    <option value="date">Date</option>
                    <option value="textarea">Text Area</option>
                    <option value="select">Dropdown</option>
                    <option value="checkbox">Checkboxes</option>
                    <option value="radio">Radio Buttons</option>
                </select>
            </div>
            <div class="form-group">
                <label><input type="checkbox" class="is-required-checkbox" value="1"> Required</label>
            </div>
            <div class="form-group options-container" style="display:none;">
                <label>Options</label>
                <div class="tag-input-container">
                    <input type="text" class="tag-input" placeholder="Type an option and press Enter">
                    <input type="hidden" class="hidden-options-input" name="field_options[]" value="">
                </div>
            </div>
        </div>
    </template>
    
    <script>
    // THE $(function() { ... }); WRAPPER HAS BEEN REMOVED TO MAKE EXECUTION MORE DIRECT

    $(document).on('change', '#event_id', function() {
        const selectedOption = $(this).find('option:selected');
        const eventTitle = selectedOption.data('title');
        const formTitleInput = $('#title');
        const formSlugInput = $('#form_slug');

        if (eventTitle) {
            formTitleInput.val(eventTitle); 
            const slug = eventTitle.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
            formSlugInput.val(slug);
        } else {
            formTitleInput.val('');
            formSlugInput.val('');
        }
    });

    // The rest of the jQuery logic for the builder
    function createTag(text, container) { const tag = $('<span class="tag"></span>').text(text); const removeBtn = $('<span class="tag-remove-btn">&times;</span>'); tag.append(removeBtn); container.before(tag); }
    function updateHiddenInput(container) { const tags = container.parent().find('.tag'); const hiddenInput = container.parent().find('.hidden-options-input'); const tagValues = $.map(tags, (tag) => $(tag).clone().children().remove().end().text().trim()); hiddenInput.val(tagValues.join(',')); }
    $('.tag-input-container').each(function() { const container = $(this); const hiddenInput = container.find('.hidden-options-input'); const initialValues = hiddenInput.val().split(',').filter(val => val.trim() !== ''); initialValues.forEach(val => createTag(val.trim(), container.find('.tag-input'))); });
    $(document).on('keydown', '.tag-input', function(e) { if (e.key === 'Enter') { e.preventDefault(); const input = $(this); const value = input.val().trim(); if (value) { createTag(value, input); updateHiddenInput(input.parent()); input.val(''); } } });
    $(document).on('click', '.tag-remove-btn', function() { const tag = $(this).parent(); const container = tag.parent(); tag.remove(); updateHiddenInput(container); });
    let fieldIndex = <?php echo count($form_fields); ?>; const fieldsContainer = $('#fields-container');
    function toggleOptions(selectElement) { const $fieldBlock = $(selectElement).closest('.field-block'); const $optionsContainer = $fieldBlock.find('.options-container'); const showOptions = ['select', 'checkbox', 'radio'].includes($(selectElement).val()); $optionsContainer.toggle(showOptions); $fieldBlock.find('.field-block-header strong').text($(selectElement).find('option:selected').text()); }
    $('#add-field-btn').on('click', function() { const template = $('#field-template')[0]; const clone = template.content.cloneNode(true); const $clone = $(clone); $clone.find('.is-required-checkbox').attr('name', `is_required[${fieldIndex}]`).removeClass('is-required-checkbox'); fieldsContainer.append($clone); fieldIndex++; });
    fieldsContainer.on('click', '.remove-field-btn', function() { $(this).closest('.field-block').remove(); });
    fieldsContainer.on('change', '.field-type-select', function() { toggleOptions(this); });
    fieldsContainer.sortable({ handle: ".field-block-header", placeholder: "field-placeholder", forcePlaceholderSize: true });
    </script>
</body>
</html>