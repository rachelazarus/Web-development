<?php
session_start(); // Start the session

$doctorName = isset($_SESSION['doctor_name']) ? $_SESSION['doctor_name'] : 'Doctor';
$profileImage = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'default.png';
$imagePath = "../images/" . $profileImage;
?>

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
        
        <div class="right-link">
            <li><a href="..\login\login.php" class="logout">Log Out</a></li>
        </div>
    </ul>
</nav>

<section class="welcome-section">
<img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Doctor's Profile Picture" class="doctor-img">
    <h1 id="welcome-Doc">Welcome Dr. <?php echo htmlspecialchars($doctorName); ?></h1>
    <div class="button-group">
        <a href="..\Records\SearchPage.php" class="button">Patients</a>
        <a href="..\Appointment\appointment.php" class="button">Appointments</a>
    </div>
</section>

<script type="text/javascript" src="Doctor.js"></script>
</body>
</html>
