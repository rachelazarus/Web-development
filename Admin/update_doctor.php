<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateDoctor') {
    $doctor_id = $_POST['doctor_id'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $specialization = $_POST['specialization'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $hire_date = $_POST['hire_date'];
    $availability = $_POST['availability'];
    $description = $_POST['description'];

    $profile_picture_path = null;

    // Handle image file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "images/";
        $profile_picture_path = basename($_FILES['profile_picture']['name']);
        $target_file = $target_dir . $profile_picture_path;

        // Move the uploaded file to the images directory
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            echo json_encode(["message" => "Error uploading profile picture."]);
            exit;
        }
    }

    // Update query with or without profile picture
    if ($profile_picture_path) {
        $sql = "UPDATE doctors SET Fullname='$fullname', Age='$age', Specialization='$specialization', 
                Contact_number='$contact_number', email='$email', hire_date='$hire_date', 
                Availability='$availability', Description='$description', Profile_picture_path='$profile_picture_path'
                WHERE Doctors_id='$doctor_id'";
    } else {
        $sql = "UPDATE doctors SET Fullname='$fullname', Age='$age', Specialization='$specialization', 
                Contact_number='$contact_number', email='$email', hire_date='$hire_date', 
                Availability='$availability', Description='$description'
                WHERE Doctors_id='$doctor_id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["message" => "Doctor's information updated successfully."]);
    } else {
        echo json_encode(["message" => "Error updating record: " . mysqli_error($conn)]);
    }
}

?>
