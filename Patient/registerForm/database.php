<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "electronic_Health_Information_System";

// Establish the database connection
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function insertPatient($profile, $fullname, $dateOfBirth, $email, $contact, $password) {
    global $conn;

    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO patients (Profile_picture_path, Fullname, DateOfBirth, Email, Contact_number, EncryptedPassword) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        // If prepare fails, output an error message
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("ssssss", $profile, $fullname, $dateOfBirth, $email, $contact, $password);

    if ($stmt->execute()) {
        // Successful insertion
        return true;
    } else {
        // Log error if execution fails
        echo "Error executing statement: " . $stmt->error;
        return false;
    }

    // Close the statement to free resources
    $stmt->close();
}
?>
