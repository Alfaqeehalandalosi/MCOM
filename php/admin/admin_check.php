<?php
// This file acts as a security guard for all pages in the admin folder.

session_start();

// If the 'admin_loggedin' session variable does not exist or is not true...
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    //...redirect the user to the login page and stop the script.
    // We use '../login.php' because we need to go up one directory from /admin/ to the root.
    header('location: ../login.php');
    exit;
}
?>