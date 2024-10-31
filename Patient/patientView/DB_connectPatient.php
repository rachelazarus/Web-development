<?php
$servername = "localhost"; // or your server name
$username = "your_username"; // your MySQL username
$password = "your_password"; // your MySQL password
$dbname = "electronic_health_information_system"; // your database name

// Create connection
$conn = new mysqli('localhost', 'root', '', 'electronic_health_information_system');


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
