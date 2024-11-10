<?php
include '../DBconnect.php';

session_start(); // Start the session

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Fetch all columns for the doctor based on provided username and password
    $sql = "SELECT * FROM doctors WHERE Fullname='$username' AND Password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Store all doctor information in session variables for use across pages
        $_SESSION['doctor_id'] = $row['Doctors_id'];
        $_SESSION['doctor_name'] = $row['Fullname'];
        $_SESSION['profile_image'] = $row['Profile_picture_path'];
        $_SESSION['age'] = $row['Age'];
        $_SESSION['specialization'] = $row['Specialization'];
        $_SESSION['contact_number'] = $row['Contact_number'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['hire_date'] = $row['hire_date'];
        $_SESSION['availability'] = $row['Availability'];
        $_SESSION['number_of_patient_records'] = $row['Number_of_patient_record_entries'];
        $_SESSION['description'] = $row['Description'];

        // Redirect to the doctor's homepage
        header("Location: ../Homepage/DoctorHomepage.php");
        exit;
    } else {
        echo "<script>alert('Incorrect username or password'); window.history.back();</script>";
        exit;
    }
}

mysqli_close($conn);
?>
