<?php

include '../DBconnect.php';

$weight = $_POST['weight'];
$age = $_POST['age'];
$date = $_POST['date'];
$sickness_description = $_POST['sickness_description'];
$diagnosis = $_POST['diagnosis'];
$prescription = $_POST['prescription'];

$stmt = $conn->prepare("INSERT INTO patient_records_entries (weight, age, date, sickness_description, diagnosis, prescription) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissss", $weight, $age, $date, $sickness_description, $diagnosis, $prescription); // Adjust types as needed

// Execute the statement
if ($stmt->execute()) {
    echo "Record added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connections
$stmt->close();
$conn->close();
?>