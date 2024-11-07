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
        <?php
        if (isset($_POST["submit"])) {
            // Gather form data
            $fullname = $_POST["Fullname"];
            $dateOfBirth = $_POST["dateOfBirth"];
            $email = $_POST["email"];
            $contact = $_POST["contact"];
            $password = $_POST["password"];
            $confpassword = $_POST["confpassword"];

            // Hash password for security
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $errors = [];

            // File upload settings
            $file_name = $_FILES['profilePicture']['name'];
            $tempname = $_FILES['profilePicture']['tmp_name']; // Corrected to directly access tmp_name
            $folder = '../patientProfilepictures/' . $file_name;
            

            // Validation checks
            if (empty($file_name) || empty($fullname) || empty($dateOfBirth) || empty($contact) || empty($password) || empty($confpassword)) {
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

            require_once("./database.php");

            // Prepare the SQL statement
$sql = "SELECT * FROM patients WHERE Contact_number = ?";
$stmt = $conn->prepare($sql);

// Check if the statement prepared correctly
if ($stmt === false) {
    die("MySQL prepare statement error: " . $conn->error); // Display error if the prepare statement failed
}

$stmt->bind_param("s", $contact); // Bind the contact number as a string parameter

// Execute the statement
$stmt->execute();
$result = $stmt->get_result(); // Get the result set

// Check if any rows were returned, indicating the contact exists
if ($result->num_rows > 0) {
    $errors[] = "Contact already exists.";
}

// Check for existing email
$sql = "SELECT * FROM patients WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $errors[] = "Email already exists.";
}
$stmt->close();

            // Validate date of birth
            if ($dateOfBirth > date("Y")) {
                $errors[] = "Invalid date of birth.";
            }

            // Display errors
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($tempname, $folder)) {
                    // Prepare the SQL statement
                    $stmt = $conn->prepare("INSERT INTO patients (Profile_picture_path, Fullname, dateOfBirth, email, Contact_number, EncryptedPassword) VALUES (?, ?, ?, ?, ?, ?)");
                    
                    // Check if prepare() succeeded
                    if ($stmt === false) {
                        die("Prepare failed: " . $conn->error);
                    }
            
                    // Bind parameters and execute the statement
                    $stmt->bind_param("ssssss", $folder, $fullname, $dateOfBirth, $email, $contact, $password_hash);
            
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Registration successful!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Registration failed: " . $stmt->error . "</div>";
                    }
                    
                    // Close the statement
                    $stmt->close();
                } else {
                    echo "<div class='alert alert-danger'>Failed to upload profile picture.</div>";
                }
            }
                
            }
        
        ?>

        <!-- Form HTML with enctype for file upload -->
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
                <label for="dateOfBirth">Date of Birth (Year)</label>
                <input type="number" class="form-control" name="dateOfBirth" id="dateOfBirth" placeholder="Enter birth year" min="1900" max="<?php echo date('Y'); ?>" required>
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