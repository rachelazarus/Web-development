<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Register Form</title>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $fullname = $_POST["Fullname"];
            $dateOfBirth = $_POST["dateOfBirth"];
            $email = $_POST["email"];
            $contact = $_POST["contact"];
            $password = $_POST["password"];
            $confpassword = $_POST["confpassword"];

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $error = array();

            // Validation checks
            if (empty($fullname) || empty($dateOfBirth) || empty($contact) || empty($password) || empty($confpassword)) {
                array_push($error, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($error, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($error, "Password must be at least 8 characters long");
            }
            if ($password !== $confpassword) {
                array_push($error, "Passwords do not match");
            }

            require_once("./database.php");
            $sql = "SELECT * FROM patients WHERE email = '$email'";
           $result = mysqli_query($conn,$sql);
            
           $rawCount = mysqli_num_rows($result);

           if($rawCount){
            array_push($error, "Email already exist");
           }

            // Validate date of birth (should not be in the future)
            if ($dateOfBirth > date("Y")) {
                array_push($error, "Invalid date of birth");
            }

            // Display errors
            if (count($error) > 0) {
                foreach ($error as $err) {
                    echo "<div class='alert alert-danger'>$err</div>";
                }
            } else {
               

                // Call the function to insert data
                if (insertPatient($fullname, $dateOfBirth, $email, $contact,$password_hash)) {
                    echo "<div class='alert alert-success'>Registration successful!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Registration failed!</div>";
                }
            }
        }
        ?>

        <form action="./register.php" method="post">
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
        </form>
    </div>
</body>

</html>
