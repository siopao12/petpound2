<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Corrected variable name
$password = "";
$dbname = "petpound";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
