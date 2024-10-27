<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "electronic_Health_Information_System";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function insertPatient($fullname, $dateOfBirth, $email, $contact, $password) {
    global $conn;

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO patients (Fullname, DateOfBirth, Email, Contact_number, EncryptedPassword) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("sssss", $fullname, $dateOfBirth, $email, $contact, $password);
        return $stmt->execute();  // Returns true on success
    } else {
        return false; // If the statement could not be prepared
    }
}
?>
