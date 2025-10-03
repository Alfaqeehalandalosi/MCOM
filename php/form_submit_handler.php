<?php
// Only process if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db_connect.php';

    // Get the form's unique slug and the submitted field data
    $form_slug = $_POST['form_slug'] ?? 'unknown_form';
    $fields_data = $_POST['fields'] ?? [];

    // --- Create a clean, human-readable version of the submission ---
    // First, get the text labels for each field ID from the database
    $stmt_labels = $conn->prepare("SELECT ff.id, ff.field_label FROM form_fields ff JOIN forms f ON ff.form_id = f.id WHERE f.form_slug = ?");
    $stmt_labels->bind_param("s", $form_slug);
    $stmt_labels->execute();
    $labels_result = $stmt_labels->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt_labels->close();
    
    // Create a simple lookup array: [field_id => field_label]
    $field_labels_map = array_column($labels_result, 'field_label', 'id');

    $submission_data = [];
    foreach ($fields_data as $field_id => $value) {
        // Find the label for the current field ID
        $label = $field_labels_map[$field_id] ?? 'Unknown Field';
        
        // If the value is an array (from checkboxes), convert it to a simple string
        $processed_value = is_array($value) ? implode(', ', $value) : $value;
        
        // Add the clean data to our submission array
        $submission_data[$label] = $processed_value;
    }

    // Encode the clean, readable array into JSON format for storage
    $json_data = json_encode($submission_data, JSON_PRETTY_PRINT);

    // --- Save the submission to the database ---
    $stmt = $conn->prepare("INSERT INTO form_submissions (form_slug, submission_data) VALUES (?, ?)");
    $stmt->bind_param("ss", $form_slug, $json_data);
    
    if ($stmt->execute()) {
        // Success! Redirect to the 'Thank You' page.
        header("Location: form_success.php");
    } else {
        // Handle a potential database error
        die("There was an error saving your submission. Please try again.");
    }

    $stmt->close();
    $conn->close();
    exit();

} else {
    // If someone tries to access this page directly, just send them to the homepage
    header("Location: dashboard.php");
    exit();
}
?>