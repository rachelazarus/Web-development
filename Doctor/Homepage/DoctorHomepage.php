<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../Patient/favicon/medical-check.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>

<nav>
    <ul>
        <div class="left-links">
            <li><a href="#">Home</a></li>
            <li><a href="..\Records\SearchPage.php">Record</a></li>
            <li><a href="..\Appointment\searchApp.php">Appointment</a></li>
        </div>
        <div class="right-link">
            <li><a href="..\login\login.php" class="logout">Log Out</a></li>
        </div>
    </ul>
</nav>

<section class="welcome-section">
        <img src="pexels-shkrabaanthony-5215024.jpg" alt="Doctor" class="doctor-img">
        <h1 id="welcome-Doc">Welcome Dr.</h1>
        <div class="button-group">
            <a href="..\Records\SearchPage.php" class="button">Records</a>
            <a href="..\Appointment\searchApp.php" class="button">Appointments</a>
        </div>
    </section>
    <script type="text/javascript" src="Doctor.js"></script>

    <script>

        const doctorName = "<?php echo isset($_SESSION['doctor_name']) ? $_SESSION['doctor_name'] : 'Doctor'; ?>";
        displayDoctorName(doctorName);

    </script>

</body>

</html>