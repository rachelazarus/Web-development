<?php
include '../DBconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $temperature = $_POST['temperature'];
    $weight = $_POST['weight'];
    $sickness_description = $_POST['sickness_description'];
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription'];

    $sql = "INSERT INTO patient_record_entries 
            (Temperature, Weight, Sickness_description, Diagnoses, Prescriptions, Patient_id, Doctors_id)
            VALUES ('$temperature', '$weight', '$sickness_description', '$diagnosis', '$prescription', '$patient_id', '$doctor_id')";


echo"<script>alert('Record added successfully'); window.history.back();</script>";
    if (mysqli_query($conn, $sql)) {
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: viewRecord.php?patient_id=$patient_id");
}
?>
