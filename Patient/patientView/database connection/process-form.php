<?php
if (isset($_POST["submit"])) {
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $contact = $_POST["contact_number"];
    $appointment = $_POST["appointment_date"];
    $timeslot = $_POST["timeslot"];
    $symptoms = $_POST["symptoms"];

    // Hash email and contact after validation
    $email_hash = password_hash($email, PASSWORD_DEFAULT);
    $contact_hash = password_hash($contact, PASSWORD_DEFAULT);

    // Array to hold errors
    $errors = array();

    // Validate form fields
    if (empty($fullname) || empty($age) || empty($email) || empty($gender) || ($contact) || empty($appointment) || empty($timeslot) || empty($symptoms)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }

    // Database connection details
    $host = "localhost";
    $dbname = "electronic_health_information_system";
    $username = "root";
    $password = "";

    // Establish connection
    $conn = mysqli_connect($host, $username, $password, $dbname);

   $sql ="INSERT INTO appointments (fullname, age, email, gender, ContactNumber, AppointmentDate, timeslot, symptoms)
   VALUES(?, ?, ?, ?, ?, ?, ?,?)";

   $stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
die(mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt, 
    "ssssssss",
    $fullname,
    $age,
    $email_hash,
    $gender,
    $contact_hash,
    $appointment,
    $timeslot,
    $symptoms
);

mysqli_stmt_execute($stmt);

echo "RECORD SAVED";
}
?>
