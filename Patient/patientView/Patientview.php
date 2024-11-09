<?php
session_start();
if (!isset($_SESSION['Patient_id'])) {
    header("Location: ../login/Patient.php");
    exit();
}

// Retrieve user details from session
$Fullname = $_SESSION['Fullname'];
$Profile_picture_path = $_SESSION['Profile_picture_path'];
$email = $_SESSION['email'];
$contactNumber = $_SESSION['Contact_number'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c1df782baf.js"></script>
    <link rel="icon" href="../favicon/medical-check.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <title>Patient View</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../images/logo2.png" alt="Hospital logo" />
        </div>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="../login/Patient.php">Home</a></li>
                <li><a href="#About">About</a></li>
                <li><a href="#Contact">Contact</a></li>
            </ul>
        </nav>
        <!-- <div id="menu-bars" class="fas fa-bars"></div>
        <div class="profile_picture">
        <img src="<?php echo htmlspecialchars('../patientProfilepictures/' . basename($Profile_picture_path)); ?>" alt="User Profile">

        </div> -->
    </header>

    <main>
        <div class="Profile-container">
            <div class="profile-picture">
            <img src="<?php echo htmlspecialchars('../patientProfilepictures/' . basename($Profile_picture_path)); ?>" alt="User Profile">

            </div>

            <div>
                <div class="contact-container">
                    <p><img src="../favicon/email.png" alt="Email Icon"> Email: <?php echo htmlspecialchars($email); ?></p>
                    <p><img src="../favicon/telephone (1).png" alt="Phone Icon"> Phone Number: <?php echo htmlspecialchars($contactNumber); ?></p>
                </div>
                <div class="choose">
                    <button type="submit" class="getRecord" onclick="window.location.href='./getRecords.php'">Get Records</button>
                    
                    <button type="submit" class="Appointment" onclick="window.location.href='./appointment.php'">Make Appointment</button>
                    
                </div>
                <h1 class="username">Hello <?php echo htmlspecialchars($Fullname); ?>! <br> Ready for your next <br> appointment?</h1>
                
            </div>
        </div>
        
        <hr>
   
        <div class="about-us-section">
    <h2>About Us</h2>
    <p><strong>Welcome to CareFlow!</strong></p>
    <p>
        We’re glad to have you on board. CareFlow was founded in 2021 with a clear vision:
        to make healthcare more accessible, less complicated, and centered around you. We understand that managing
        appointments, accessing records, and keeping track of your health can be overwhelming—so we created CareFlow
        to put everything you need in one place.
    </p>
    
    <div class="mission-section">
        <h3>Our Mission</h3>
        <p>
            At CareFlow, our mission is to empower patients like you by putting control over your healthcare journey back
            in your hands. With CareFlow, you can:
        </p>
        <ul>
            <li><strong>Easily book appointments</strong> with your healthcare provider, avoiding long wait times and unnecessary delays.</li>
            <li><strong>Access your health records</strong> at any time, keeping critical information at your fingertips.</li>
            <li><strong>Receive personalized reminders and updates</strong> to help you stay informed and on top of your healthcare needs.</li>
        </ul>
    </div>

    <div class="why-choose-section">
        <h3>Why Choose CareFlow?</h3>
        <p>
            Because we know you deserve a seamless healthcare experience. CareFlow is designed to make your journey
            smoother, so you can focus on what really matters—your health and well-being.
        </p>
    </div>

    <p>Thank you for being a part of the CareFlow community. We’re here to support you every step of the way on your healthcare journey!</p>
</div>

        </div>
    </main>
    <script src="./script.js"></script>
</body>
</html>
