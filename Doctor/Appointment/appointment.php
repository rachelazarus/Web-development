<?php 
// Start the session and fetch the doctor ID
session_start();

// Ensure doctorId is set and sanitize it
$doctorId = isset($_SESSION['doctor_id']) ? $_SESSION['doctor_id'] : '';

// Only proceed if doctorId is valid
if (!empty($doctorId)) {
    // Connect to the database
    include '../DBconnect.php';

    // Get the current date
    $currentYear = date("Y");
    $currentMonth = date("m");
    $currentDay = date("d");

    // Query for today's appointments for the logged-in doctor
    $todayAppointmentsQuery = "SELECT a.*, p.Fullname AS patient_name, d.Fullname AS doctor_name 
                               FROM Apointments a
                               JOIN Patients p ON a.patient_id = p.Patient_id
                               JOIN Doctors d ON a.doctor_id = d.Doctors_id
                               WHERE a.doctor_id = '$doctorId' AND Year = $currentYear AND Month = $currentMonth AND Day = $currentDay";

    // Query for other appointments for the logged-in doctor
    $otherAppointmentsQuery = "SELECT a.*, p.Fullname AS patient_name, d.Fullname AS doctor_name 
                               FROM Apointments a
                               JOIN Patients p ON a.patient_id = p.Patient_id
                               JOIN Doctors d ON a.doctor_id = d.Doctors_id
                               WHERE a.doctor_id = '$doctorId' AND NOT (Year = $currentYear AND Month = $currentMonth AND Day = $currentDay)";

    $todayAppointments = $conn->query($todayAppointmentsQuery);
    $otherAppointments = $conn->query($otherAppointmentsQuery);

    $conn->close();
} else {
    echo "Invalid doctor ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="appointStyle.css">
    <title>Appointments</title>
</head>
<body>
    <!-- Back Button -->
<a href="../Homepage/DoctorHomepage.php" class="back-button">← Back</a>

    
<div class="container">
   
    <!-- Today's Appointments Section -->
    <div class="appointments-section">
        <h2>Appointments for Today</h2>
        
        <table>
            <tr>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php if ($todayAppointments->num_rows > 0): ?>
                <?php while ($row = $todayAppointments->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['patient_name']; ?></td>
                        <td><?php echo $row['doctor_name']; ?></td>
                        <td><?php echo "{$row['Day']}-{$row['Month']}-{$row['Year']}"; ?></td>
                        <td><?php echo $row['TimeSlot']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No appointments for today.</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <!-- Search and Filter for Other Appointments -->
    <div class="appointments-filter">
        <form action="#" method="GET" class="search-form" onsubmit="return false;">
            <input type="text" id="search-box" placeholder="Search by patient name" oninput="filterTable()">
            <button type="button" onclick="filterTable()">
                <i class="fas fa-search"></i>
            </button>
        </form>
        
        <form action="#" method="GET" class="filter-form" onsubmit="return false;">
            <label for="date-filter">Filter by Date:</label>
            <input type="date" id="date-filter" onchange="filterByDate()">
        </form>
    </div>

    <!-- Other Appointments Section -->
    <div class="appointments-section">
        <h2>Other Appointments</h2>
        
        <table id="appointments-table">
            <tr>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php if ($otherAppointments->num_rows > 0): ?>
                <?php while ($row = $otherAppointments->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['patient_name']; ?></td>
                        <td><?php echo $row['doctor_name']; ?></td>
                        <td><?php echo "{$row['Day']}-{$row['Month']}-{$row['Year']}"; ?></td>
                        <td><?php echo $row['TimeSlot']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No other appointments found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<script>
// Filter the "Other Appointments" table based on patient name
function filterTable() {
    let searchInput = document.getElementById("search-box").value.toLowerCase();
    let table = document.getElementById("appointments-table");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header
        let cells = rows[i].getElementsByTagName("td");
        let patientName = cells[0].textContent.toLowerCase(); // Patient Name column

        if (patientName.includes(searchInput)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

// Filter the "Other Appointments" table by date
function filterByDate() {
    let dateInput = document.getElementById("date-filter").value;
    let table = document.getElementById("appointments-table");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header
        let cells = rows[i].getElementsByTagName("td");
        let appointmentDate = `${cells[2].textContent.trim()}`; // Date column

        if (appointmentDate.includes(dateInput)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}
</script>
</body>
</html>
