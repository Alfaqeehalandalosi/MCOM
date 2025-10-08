<?php
require_once 'admin_check.php';
require_once '../db_connect.php';

header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
$form_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($form_id > 0 && $action == 'delete') {
    
    // First, get the form_slug before we delete the form
    $stmt_slug = $conn->prepare("SELECT form_slug FROM forms WHERE id = ?");
    $stmt_slug->bind_param("i", $form_id);
    $stmt_slug->execute();
    $result = $stmt_slug->get_result();
    $form = $result->fetch_assoc();
    $form_slug = $form['form_slug'] ?? null;
    $stmt_slug->close();

    if ($form_slug) {
        // Use a transaction to ensure all parts are deleted or none are
        $conn->begin_transaction();
        try {
            // 1. Delete all fields associated with the form
            $stmt_fields = $conn->prepare("DELETE FROM form_fields WHERE form_id = ?");
            $stmt_fields->bind_param("i", $form_id);
            $stmt_fields->execute();
            $stmt_fields->close();

            // 2. Delete all submissions associated with the form
            $stmt_subs = $conn->prepare("DELETE FROM form_submissions WHERE form_slug = ?");
            $stmt_subs->bind_param("s", $form_slug);
            $stmt_subs->execute();
            $stmt_subs->close();

            // 3. Delete the main form record
            $stmt_form = $conn->prepare("DELETE FROM forms WHERE id = ?");
            $stmt_form->bind_param("i", $form_id);
            $stmt_form->execute();
            $stmt_form->close();
            
            // If all queries were successful, commit the changes
            $conn->commit();
            echo json_encode(['status' => 'success', 'message' => 'Form and all its data deleted successfully.']);

        } catch (mysqli_sql_exception $exception) {
            $conn->rollback(); // Revert changes if any query failed
            echo json_encode(['status' => 'error', 'message' => 'Error deleting form data.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Form not found.']);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action or form ID.']);
}

$conn->close();
exit();