<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recordStyle.css">
    <title>Records</title>
</head>

<body>
    
  <header>
    <nav>
        <ul>
            <div class="left-links">
                <li><a href="..\Homepage\DoctorHomepage.html">Home</a></li>
                <li><a href="#">Record</a></li>
                <li><a href="..\Appointment\appointment.html">Appointment</a></li>
            </div>
        </ul>
    </nav>
  </header>

  <form action="Searchrecord.php" method="GET" class="search-form">
    <input type="text" id="search-box" name="search-box" placeholder="Search for a patient" required>
    <button type="submit">Search</button>
</form>

   <!-- Patient Records Section -->
   <section class="patient-section">

    <!-- example Patient -->
    <div class="patient-card">
        <div class="patient-name">Maria Johnnes</div>
        <div class="action-buttons">
            <button class="view-button">View</button>
        </div>
    </div>

     <!-- Second Patient (Initial Data) -->
     <div class="patient-card" data-name="Patient Name">
        <div class="patient-name">Patient Name</div>
        <div class="action-buttons">
            <button class="view-button">View</button>
        </div>
    </div>

    </section>

</body>
</html>