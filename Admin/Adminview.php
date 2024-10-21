<?php
session_start();
include("connect.php");

// Fetch total number of doctors
$doctor_query = "SELECT COUNT(*) AS total_doctors FROM doctors"; // Assuming your doctors table is named 'doctors'
$doctor_result = mysqli_query($conn, $doctor_query);
$doctor_data = mysqli_fetch_assoc($doctor_result);
$total_doctors = $doctor_data['total_doctors'];

// Fetch total number of patients
$patient_query = "SELECT COUNT(*) AS total_patients FROM patients"; // Assuming your patients table is named 'patients'
$patient_result = mysqli_query($conn, $patient_query);
$patient_data = mysqli_fetch_assoc($patient_result);
$total_patients = $patient_data['total_patients'];

$Appointments_query = "SELECT COUNT(*) AS total_appointments FROM apointments"; // Assuming your patients table is named 'patients'
$appointment_result = mysqli_query($conn, $Appointments_query);
$appointment_data = mysqli_fetch_assoc($appointment_result);
$total_appointments = $appointment_data['total_appointments'];
$available_doctors_query = "SELECT Doctors_id, Profile_picture_path, Fullname, Availability FROM doctors WHERE Availability = 1"; 
$available_doctors_result = mysqli_query($conn, $available_doctors_query);

// Fetch today's date
$today_year = date("Y");
$today_month = date("m");
$today_day = date("d");

// Query to fetch today's appointments
$today_appointments_query = "
    SELECT p.Fullname AS patient_name, d.Fullname AS doctor_name, a.TimeSlot 
    FROM apointments a 
    JOIN patients p ON a.patient_id = p.Patient_id 
    JOIN doctors d ON a.doctor_id = d.Doctors_id 
    WHERE a.Year = '$today_year' AND a.Month = '$today_month' AND a.Day = '$today_day'
";

$today_appointments_result = mysqli_query($conn, $today_appointments_query);



// Fetch all appointments
$appointmentsall_query = "
    SELECT a.Apointment_ID, a.Year, a.Month, a.Day, a.TimeSlot, p.Fullname AS patient_name, d.Fullname AS doctor_name 
    FROM apointments a 
    JOIN patients p ON a.patient_id = p.Patient_id 
    JOIN doctors d ON a.doctor_id = d.Doctors_id";
$appointments_result = mysqli_query($conn, $appointmentsall_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['id'];

    $delete_query = "DELETE FROM apointments WHERE Apointment_ID = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminView</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="Admin.css" />
</head>

<body>
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line icon icon-0 menu"></i>
            <h2>EHIS</h2>
        </div>
    </section>
    
    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href="#" data-view="dashboard" class="menu-link active">
                        <span class="icon icon-1"><i class="ri-layout-grid-line"></i></span>
                        <span class="sidebar--item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-view="appointments" class="menu-link">
                        <span class="icon icon-2"><i class="ri-calendar-2-line"></i></span>
                        <span class="sidebar--item">Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-view="doctors" class="menu-link">
                        <span class="icon icon-3"><i class="ri-user-2-line"></i></span>
                        <span class="sidebar--item" style="white-space: nowrap;">Doctors</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-view="patients" class="menu-link">
                        <span class="icon icon-4"><i class="ri-user-line"></i></span>
                        <span class="sidebar--item">Patients</span>
                    </a>
                </li>
                <li>
                    <a href="#" data-view="support" class="menu-link">
                        <span class="icon icon-6"><i class="ri-customer-service-line"></i></span>
                        <span class="sidebar--item">Support</span>
                    </a>
                </li>
            </ul>
            <ul class="sidebar--bottom-items">
                <li>
                    <a href="#">
                        <span class="icon icon-7"><i class="ri-settings-3-line"></i></span>
                        <span class="sidebar--item">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="Main menu.html">
                        <span class="icon icon-8"><i class="ri-logout-box-r-line"></i></span>
                        <span class="sidebar--item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Dashboard View -->
        <div class="main--content" id="dashboard-view">
            <div class="overview">
                <div class="cards">
                    <div class="card card-1">
                        <div class="card--data">
                            <div class="card--content">
                                <h2 class="card--title">Total Doctors</h2>
                            </div>
                            <i class="ri-user-2-line card--icon--lg"></i>
                        </div>
                        <h1><?php echo $total_doctors; ?></h1>
                    </div>
                    <div class="card card-2">
                        <div class="card--data">
                            <div class="card--content">
                                <h2 class="card--title">Total Patients</h2>
                            </div>
                            <i class="ri-user-line card--icon--lg"></i>
                        </div>
                        <h1><?php echo $total_patients; ?></h1>
                    </div>
                    <div class="card card-3">
                        <div class="card--data">
                            <div class="card--content">
                                <h2 class="card--title">Total Appointments</h2>
                            </div>
                            <i class="ri-calendar-2-line card--icon--lg"></i>
                        </div>
                        <h1><?php echo $total_appointments; ?></h1>
                    </div>
                </div>
            </div>
            
            <div class="doctors">
                <div class="title">
                    <h2 class="section--title">Available Doctors</h2>
                </div>
                <div class="doctors--cards">
                    <?php while($doctor = mysqli_fetch_assoc($available_doctors_result)): ?>
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="images/<?php echo $doctor['Profile_picture_path']; ?>" alt="Doctor Image">
                            </div>
                        </div>
                        <p class="doctorname">Dr. <?php echo $doctor['Fullname']; ?></p>
                    </a>
                    <?php endwhile; ?>
                </div>
            </div>

            <div class="todaysAppointments">
                <div class="title">
                    <h2 class="section--title">Today's Appointments</h2>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Timeslot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($today_appointments_result) > 0): ?>
                            <?php while($appointment = mysqli_fetch_assoc($today_appointments_result)): ?>
                            <tr>
                                <td><?php echo $appointment['patient_name']; ?></td>
                                <td><?php echo $appointment['doctor_name']; ?></td>
                                <td><?php echo $appointment['TimeSlot']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="3">No appointments for today.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Appointments View -->
        <div class="main--content" id="appointments-view" style="display: none;">
        <h2 class="A-title">Appointments</h2>
        <div class="table-controls">
        <div class="search">
            <input type="text" id="appointment-search" placeholder="Search appointments...">
            <button><i class="ri-search-2-line"></i></button>
        </div>
         
        <div class="date-filter">
        <h5>Filter by date</h5>
            <input type="date" id="date-filter-input" placeholder="date">
            
        </div>
    </div>
            
        <table id="appointments-table">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while($appointment = mysqli_fetch_assoc($appointments_result)): ?>
            <tr>
                <td><?php echo $appointment['patient_name']; ?></td>
                <td><?php echo $appointment['doctor_name']; ?></td>
                <td><?php echo $appointment['Year'] . '-' . $appointment['Month'] . '-' . $appointment['Day']; ?></td>
                <td><?php echo $appointment['TimeSlot']; ?></td>
                <td>
                    
                    <button class="delete-btn" data-id="<?php echo $appointment['Apointment_ID']; ?>">Delete</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


</div>
        </div>
        
        <!-- Doctors View -->
        <div class="main--content" id="doctors-view" style="display: none;">
        <div class="search">
                <input type="text" placeholder="Search do">
                <button><i class="ri-search-2-line"></i></button>
            </div>
            <h2>Doctors</h2>
            <p>Details about doctors.</p>
        </div>

        <!-- Doctors View -->
        <div class="main--content" id="patients-view" style="display: none;">
            <h2>Doctors</h2>
            <p>Details about doctors.</p>
        </div>
        <!-- Doctors View -->
        <div class="main--content" id="support-view" style="display: none;">
            <h2>Support</h2>
           
        </div>
    </section>

    <script src="Admin.js"></script>
</body>
</html>
