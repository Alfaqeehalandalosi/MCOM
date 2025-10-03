<?php

if (!$_POST) exit();

// Email format verification function
function isEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Database connection
$host = "localhost"; // Change if needed
$user = "root"; // Your DB username
$pass = ""; // Your DB password
$dbname = "manifestation";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<div class='alert alert-error'>Database connection failed: " . $conn->connect_error . "</div>");
}

// Collect and sanitize POST data
$name     = trim($_POST['name']);
$email    = trim($_POST['email']);
$phone    = trim($_POST['phone']);
$comments = trim($_POST['comments']);

// Basic validations
if ($name == '') {
    echo '<div class="alert alert-error">You must enter your name.</div>';
    exit();
}
if ($email == '') {
    echo '<div class="alert alert-error">You must enter your email address.</div>';
    exit();
}
if (!isEmail($email)) {
    echo '<div class="alert alert-error">You must enter a valid email address.</div>';
    exit();
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, comments) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $comments);

if ($stmt->execute()) {
    echo "<div class='alert alert-success'>";
    echo "<h3>Data Submitted Successfully.</h3><br>";
    echo "<p>Thank you <strong>$name</strong>, your message has been saved.</p>";
    echo "</div>";
} else {
    echo "<div class='alert alert-error'>ERROR: Could not save your data.</div>";
}

$stmt->close();
$conn->close();
