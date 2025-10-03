<?php
/**
 * =====================================================
 * USER FUNCTIONS "TOOLBOX"
 * =====================================================
 * This file contains all reusable functions for
 * interacting with the 'users' table.
 * It does not produce any HTML output.
 */

require_once 'db_connect.php'; // We include the database connection here

/**
 * Finds a user by email, or creates a new one if not found.
 * Also handles the "remember me" cookie logic.
 * This single function replaces the duplicated code in all your public forms.
 *
 * @param mysqli $conn The database connection object.
 * @param array $post_data The $_POST data from the form.
 * @return int The ID of the found or newly created user.
 */
function findOrCreateUser($conn, $full_name, $email, $contact_number = null) {
    // Sanitize and trim the input
    $email = trim($email);
    $full_name = trim($full_name);
    $contact_number = !empty(trim($contact_number)) ? trim($contact_number) : null;

    // Step 1: Find user by email
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User already exists, return their ID
        $user_id = $result->fetch_assoc()['id'];
        $stmt->close();
        return $user_id;
    } else {
        // Step 2: User does not exist, create a new one
        $stmt_insert = $conn->prepare("INSERT INTO users (full_name, email, contact_number) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sss", $full_name, $email, $contact_number);
        $stmt_insert->execute();
        $user_id = $stmt_insert->insert_id;
        $stmt_insert->close();
        return $user_id;
    }
}

/**
 * Gets a list of all users with filtering, searching, and pagination.
 *
 * @param mysqli $conn The database connection object.
 * @param array $options An array containing search, status, limit, and offset.
 * @return array An array containing the list of users and the total number of pages.
 */
function getAllUsersWithPagination(mysqli $conn, array $options): array
{
    $search = $options['search'] ?? '';
    $status = $options['status'] ?? 'Active';
    $limit = $options['limit'] ?? 15;
    $offset = $options['offset'] ?? 0;

    $params = [];
    $types = '';

    // Base queries
    $sql_count = "SELECT COUNT(id) FROM users WHERE 1=1";
    $sql_data = "SELECT id, full_name, email, status, total_donation FROM users WHERE 1=1";

    // Add search filter
    if (!empty($search)) {
        $sql_count .= " AND (full_name LIKE ? OR email LIKE ?)";
        $sql_data .= " AND (full_name LIKE ? OR email LIKE ?)";
        $search_param = "%{$search}%";
        array_push($params, $search_param, $search_param);
        $types .= 'ss';
    }

    // Add status filter
    if ($status !== 'All') {
        $sql_count .= " AND status = ?";
        $sql_data .= " AND status = ?";
        $params[] = $status;
        $types .= 's';
    }
    
    // Get total count for pagination
    $stmt_count = $conn->prepare($sql_count);
    if (!empty($types)) {
        $stmt_count->bind_param($types, ...$params);
    }
    $stmt_count->execute();
    $total_results = $stmt_count->get_result()->fetch_row()[0];
    
    // Add sorting and limits for data query
    $sql_data .= " ORDER BY full_name ASC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= 'ii';
    
    // Get the actual user data
    $stmt_data = $conn->prepare($sql_data);
    $stmt_data->bind_param($types, ...$params);
    $stmt_data->execute();
    $users = $stmt_data->get_result()->fetch_all(MYSQLI_ASSOC);

    return [
        'users' => $users,
        'total_pages' => ceil($total_results / $limit)
    ];
}
function getUserByToken($conn, $token) {
    if (empty($token)) {
        return [];
    }
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE persistent_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }
    
    $stmt->close();
    return []; // Return an empty array if no user is found with that token
}