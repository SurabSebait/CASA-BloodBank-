<?php
// Database configuration
$servername = "localhost:3306";
$username = "root";
$password = "Nisha@12345";
$database = "BloodBank";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, set the character set to utf8
$conn->set_charset("utf8");
?>
