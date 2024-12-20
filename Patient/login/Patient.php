<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../favicon/medical-check.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/c1df782baf.js"></script>
  <link rel="stylesheet" href="./Patient.css">
  <title>Hostpital management system</title>
</head>

<body>
  <header>
    <div class="logo">
      <img src="../images/logo2.png" alt="Hostpital logo" />
    </div>

    <nav class="navbar">
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#About">About</a></li>
        <li><a href="#Contact">Contact</a></li>
      </ul>
    </nav>

    <div class="right-icons">
      <div id="menu-bars" class="fas fa-bars"></div>
      <div class="btn" id="#">Login</div>
    </div>
  </header>

  <main>

    <div class="main-home">
      <div class="home">
        <h1>Welocme to our E-health system</h1>
        <h3>We take care of our Patient</h3>
        <p class="intro"> <br> <strong>CareFlow</strong> <br> is an innovative healthcare management system that
          streamlines patient <br> care and optimizes healthcare operations.
          By integrating key <br> components like scheduling, electronic health records (EHR), <br> and billing, it
          offers a seamless experience for both healthcare providers and patients. <br>
          CareFlow enhances communication among medical staff, reduces administrative <br> workloads, and ensures
          greater accuracy of patient information.
          Its <br> goal is to create a more efficient healthcare environment, improving <br> patient outcomes and
          satisfaction.
          As technology advances, systems like <strong>CareFlow</strong> <br> represent the future of healthcare, where
          data-driven solutions enable personalized, <br> effective care.
        </p>

      </div>
    </div>

  

    <section class="login">

    
      <div class="login-container">
        <h1>Login</h1>
        <br>
        <?php
session_start(); // Start the session

if (isset($_POST['login'])) {
    $email = $_POST["Email"];
    $password = $_POST["password"];

    require_once "database.php";

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Patients WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        
        // Compare plain text passwords directly
        if ($password === $patient["EncryptedPassword"]) {
            // Store user details in session variables
            $_SESSION['Patient_id'] = $patient['Patient_id'];
            $_SESSION['email'] = $patient['Email'];
            $_SESSION['Fullname'] = $patient['Fullname'];
            $_SESSION['Contact_number'] = $patient['Contact_number'];
            $_SESSION['Profile_picture_path'] = $patient['Profile_picture_path'];

            // Redirect to profile view page
            header("Location: ../patientView/Patientview.php");
            exit();
        } else {
            echo "<div class='alert-danger'>Incorrect password</div>";
        }
    } else {
        echo "<div class='alert-danger'>Email does not exist</div>";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>



        <div class="input-group">
          <form action="./Patient.php" method="post">
            <label for="email">Email</label>
            <input type="text" id="email" name="Email" required placeholder="example@gmail.com">

            <label for="password"> password</label>
            <input type="password" name="password" id="EncryptedPassword" required placeholder="********">
        </div>
        <a href="../login/forgotPassword.php">Forgot password</a>
        <button class="login-btn" value="Login" name="login" type="submit">Login</button>

        <a href="../registerForm/register.php" class=>Register</a>
        </form>
      </div>
    </section>
  </main>

  <script src="./Patient.js"></script>
</body>

</html>