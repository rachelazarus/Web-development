<?php
session_start(); // Start the session at the beginning of the file
require_once("./database.php");

function generatePatientId() {
    return "PAT" . strval(rand(1000, 9999));
}

if (isset($_POST["submit"])) {
    $errors = [];

    // Gather form data
    $fullname = $_POST["Fullname"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $password = $_POST["password"];
    $confpassword = $_POST["confpassword"];

    $patientId = generatePatientId();
    $file_name = $_FILES['profilePicture']['name'];
    $tempname = $_FILES['profilePicture']['tmp_name'];
    $folder = "../patientProfilepictures/" . $file_name;

    // Validation checks
    if (empty($file_name) || empty($fullname) || empty($age) || empty($contact) || empty($password) || empty($confpassword)) {
        $errors[] = "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if ($password !== $confpassword) {
        $errors[] = "Passwords do not match.";
    }

    $sql = "SELECT * FROM patients WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "Email already exists.";
    }
    $stmt->close();

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        if (move_uploaded_file($tempname, $folder)) {
            $stmt = $conn->prepare("INSERT INTO patients (Patient_id, Profile_picture_path, Fullname, Age, Gender, Email, Contact_number, EncryptedPassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("ssssssss", $patientId, $folder, $fullname, $age, $gender, $email, $contact, $password);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Registration successful!</div>";

                // Set session variables
                $_SESSION['Patient_id'] = $patientId;
                $_SESSION['email'] = $email;
                $_SESSION['Fullname'] = $fullname;
                $_SESSION['Contact_number'] = $contact;
                $_SESSION['Profile_picture_path'] = $folder;

                // Redirect to the patient view page
                header("Location: ../patientView/Patientview.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Registration failed: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Failed to upload profile picture.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../Patient/favicon/medical-check.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <title>Register Form</title>
</head>
<body>
    <div class="container">
        <!-- Registration Form -->
        <form action="./register.php" method="post" enctype="multipart/form-data">
            <div class="input-groupReg">
                <label for="profilePicture">Profile Picture</label>
                <input type="file" name="profilePicture" id="profilePicture" required />
            </div>

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" name="Fullname" id="fullname" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" name="age" id="age" placeholder="Enter age"  required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" class="form-control" name="gender" id="gender" placeholder="Gender" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" name="contact" id="contact" placeholder="123-456-7890" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="*****">
            </div>
            <div class="form-group">
                <label for="confpassword">Confirm Password</label>
                <input type="password" class="form-control" name="confpassword" id="confpassword" placeholder="*****">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
            <div class="form-btn">
                <a href="../login/Patient.php" id="btn" class="btn btn-primary">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
