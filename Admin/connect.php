<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "electronic_Health_Information_System";  // Make sure this matches your actual DB name

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully"; // You can remove this after confirming the connection
}
?>
