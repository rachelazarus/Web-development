
<?php
session_start(); 
include '../DBconnect.php';
$patients_query = "SELECT * FROM patients";
$patients_result = mysqli_query($conn, $patients_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recordStyle.css">
    <title>Records</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
   
</head>

<body>
    
  <header>
    <nav>
        <ul>
            <div class="left-links">
                <li><a href="..\Homepage\DoctorHomepage.php">Home</a></li>
                <li><a href="#">Record</a></li>
                <li><a href="..\Appointment\appointment.html">Appointment</a></li>
            </div>
        </ul>
    </nav>
  </header>

  <form action="#" method="GET" class="search-form" onsubmit="return false;">
    <input type="text" id="search-box" placeholder="Search for a patient" oninput="filterTable()">
    <button type="button" onclick="filterTable()">Search</button>
</form>

   <!-- Patient Records Section -->
   <section class="patient-section">
   <div class="tableoverflow">
    <table id="patients-table" class="table">
        <thead>
            <tr>
                <th>Patient</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while($patient = mysqli_fetch_assoc($patients_result)): ?>
            <tr>
                <td class="patient-info">
                    <img src="../images/<?php echo htmlspecialchars($patient['Profile_picture_path']); ?>" alt="Profile Picture" class="profile-pic">
                    <span class="patient-name"><?php echo htmlspecialchars($patient['Fullname']); ?></span>
                </td>
                <td class="view-btn-cell">
                    <button class="view-btn" onclick="location.href='viewRecord.php?patient_id=<?php echo $patient['Patient_id']; ?>'" title="View Patient">
    <i class="ri-eye-line view-icon"></i>
</button>

                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
 

    </section>
    <script>
// JavaScript for dynamic search functionality
function filterTable() {
    const searchInput = document.getElementById("search-box").value.toLowerCase();
    const table = document.getElementById("patients-table");
    const rows = table.getElementsByTagName("tr");

    // Loop through table rows and display/hide based on search input
    for (let i = 1; i < rows.length; i++) {
        const nameCell = rows[i].querySelector(".patient-info .patient-name");
        if (nameCell) {
            const nameText = nameCell.textContent.toLowerCase();
            if (nameText.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}
</script>
</body>
</html>