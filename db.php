<?php
// Database configuration
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "blood_bank"; // Correct database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    error_log("Connection failed: " . mysqli_connect_error()); // Log the error
    die("Unable to connect to the database. Please try again later."); // Generic error message
}

// Set character set to UTF-8
if (!mysqli_set_charset($conn, "utf8")) {
    error_log("Error loading character set utf8: " . mysqli_error($conn)); // Log charset error
}

// Connection successful (remove this in production)
// echo "Connected successfully!";
?>
