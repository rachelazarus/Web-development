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
    <div id="menu-bars" class="fas fa-bars"></div>
    <div class="profile_picture">
      <img src="../images/user (1).png" alt="User Profile">
    </div>
  </header>

  <main>
    <div class="Profile-container">
      <div class="profile-picture">
        <img src="../images/pexels-laker-5792641.jpg" alt="Profile picture">
      </div>

      <div>
        <div class="contact-container">
          <p><img src="../favicon/email.png" alt="Email Icon"> Email: </p>
          <p><img src="../favicon/telephone (1).png" alt="Phone Icon"> Phone Number: </p>
        </div>
        <div class="choose">
          <button type="submit" class="getRecord">Get Records</button>
          <button type="submit" class="Appointment" onclick="window.location.href='./appointment.php'">Make Appointment</button>
        </div>
      </div>

      
    </div>
    <hr><div class="about-us-container">
        <div class="about-us">
          <h1>About us</h1>
          <p>Founded in 2021, CareFlow began as a simple idea: healthcare shouldn't <br> 
          feel more complicated than it already is. The concept came to life when our team,<br> 
          after missing yet another doctor’s  call-back, thought, <br> 
          "What if we could manage everything ourselves, <br> 
          without the wait?" And just like that, CareFlow was born!
<br> <br>
            Today, CareFlow helps patients manage appointments, access records, <br> 
            and stay on top of health updates—all in one place. <br> 
            It’s designed to make healthcare as easy as scrolling, <br>
            minus the endless waiting.</p>
        </div>
     
      </div>
  </main>
  <script src="./script.js"></script>
</body>

</html>