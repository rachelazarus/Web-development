<?php
include 'connect.php';
if (isset($_POST['register'])) {
    $doctorId = "Doc" . substr(md5(rand()), 0, 6); // Random Doctor ID
    $profilePicture = $_FILES['profilePicture']['name'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $specialization = $_POST['specialization'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $availability = $_POST['availability'];
    $numRecords = $_POST['numRecords'];
    $description = $_POST['description'];
    $hireDate = date("Y-m-d H:i:s"); // Current timestamp

    // Move profile picture to 'images' folder
    $targetDir = "images/";
    $targetFile = $targetDir . basename($profilePicture);
    if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFile)) {
        $sql = "INSERT INTO Doctors (Doctors_id, Profile_picture_path, Fullname, Age, Specialization, 
                Contact_number, email, hire_date, password, Availability, Number_of_patient_record_entries, Description)
                VALUES ('$doctorId', '$profilePicture', '$fullname', '$age', '$specialization', 
                '$contactNumber', '$email', '$hireDate', '$password', '$availability', '$numRecords', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "Doctor registered successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload profile picture.";
    }
}
?>
