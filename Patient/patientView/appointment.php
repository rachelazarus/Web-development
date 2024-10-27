<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make an Appointment</title>
    <link rel="stylesheet" href="appointment.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="../images/logo2.png" alt="Hospital Logo">
        </div>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="../login/Patient.php">Home</a></li>
                <li><a href="#About">About</a></li>
                <li><a href="#Contact">Contact</a></li>
            </ul>
        </nav>
        <div class="back">
            <a href="./Patientview.php"></a>

        </div>
    </header>

    <!-- <br> <br> <br> <br> -->
    <main>
        <h1 class="topic">MAKE AN APPOINTMENT</h1>

        <form action="./process-form.php" method="POST">
            <!-- Full Name -->
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>

            <!-- Age -->
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" required>
                    <option value="0" disabled selected>Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Contact Number -->
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" required>
            </div>

            <!-- Date of Appointment -->
            <div class="form-group">
                <label for="appointment_date">Date of Appointment:</label>
                <input type="date" id="appointment_date" name="appointment_date" required>
            </div>

            <!-- Time Slot -->
            <div class="form-group">
                <label for="timeslot">Time Slot:</label>
                <input type="time" id="timeslot" name="timeslot" required>
            </div>
            <br>
            <!-- Symptoms -->
            <div class="form-group">
                <label for="symptoms" class="symptoms">Symptoms:</label>
                <textarea id="symptoms" name="symptoms" rows="4" placeholder="Describe your symptoms in detail..." required></textarea>
            </div>

            <!-- Buttons -->
            <div class="form-group">
                <button type="submit"  name="submit" >Make Appointment</button>
            </div>
            <button type="button" class="back-button" onclick="history.back()">Back</button>
        </form>

    </main>
</body>

</html>