<?php
/*
=====================================================
 DATABASE CONNECTION FILE
=====================================================
Update these variables with your database details.
*/

$servername = "localhost";        // Usually "localhost"
$username = "root";               // Your database username (e.g., "root")
$password = "";                   // Your database password
$dbname = "mcom";   // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4 for full emoji/character support
$conn->set_charset("utf8mb4");

?>