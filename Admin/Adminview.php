<?php
session_start();
include("C:/xampp/htdocs/Doctor/DBconnect.php");


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
$data = json_decode(file_get_contents("php://input"));


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

// Fetch all doctors
$doctors_query = "
    SELECT * FROM doctors";
$doctors_result = mysqli_query($conn, $doctors_query);


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
            <input class ="date-filter-input" type="date" id="date-filter-input" placeholder="date" title="Choose filter date">
            
        </div>
      </div>
            <div class="tableoverflow">
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
                        <div class="deletediv">
                          <button class="delete-btn" data-id="<?php echo $appointment['Apointment_ID']; ?>" data-type="appointment" title="Delete Appointment">
                            <i class="ri-delete-bin-line delete"></i>
                          </button>
                          </div>
                </td>

                
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
         </table>
         </div>

     </div>
    </div>
        
        <!-- Doctors View -->
        <div class="main--content" id="doctors-view" style="display: none;">
        <div class="table-controls">
        <div class="search">
            <input type="text" id="doctor-search" placeholder="Search doctors...">
            <button><i class="ri-search-2-line"></i></button>
        </div>
        <div class="add-doctor">
           <a href="AddDoctorPage.php"><button class="add-doctor-btn"><i class="ri-add-line add "></i> Add Doctor</button></a> 
        </div>
  <div class="tableoverflow">
        <table id="doctors-table" class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Specialization</th>
                <th>Contact</th>
                <th>Availability</th>
                <th></th>
                <th></th>
               
            </tr>
        </thead>
        <tbody>
            <?php while($doctor = mysqli_fetch_assoc($doctors_result)): ?>
            <tr>

                <td><?php echo $doctor['Fullname']; ?></td>
                <td><?php echo $doctor['Specialization']; ?></td>
                <td><?php echo $doctor['Contact_number']; ?></td>
                <td><?php echo $doctor['Availability'] ? 'Available' : 'Unavailable'; ?></td>
                <td class="deleteth">
                  
                     <div class="deletediv">
                          <button class="delete-btn" data-id="<?php echo $doctor['Doctors_id']; ?>" data-type="doctor" title="Delete Doctor">
                            <i class="ri-delete-bin-line delete"></i>
                          </button>
                    
                </td>
                <td >
                </div >
                    <div class = "viewdiv">
                  <button class="view-btn" onclick='openDoctorModal(<?php echo json_encode($doctor); ?>)'  data-id="<?php echo $doctor['Doctors_id']; ?>" title="View Doctor">
                        <i class="ri-eye-line view"></i>
                    </button>
                     </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>

    </div>


        </div>

        
    </div>
<!-- Pateints-View-->
<div class="main--content" id="patients-view" style="display: none;">
           
            <div class="search">
            <input type="text" id="patient-search" placeholder="Search patients...">
            <button><i class="ri-search-2-line"></i></button>
        </div>
        <div class="add-patient">
           <a href="AddPatientPage.php"><button class="add-patient-btn"><i class="ri-add-line add "></i> Add Patient</button></a> 
        </div>
        </div>
      
        <div class="main--content" id="support-view" style="display: none;">
            <h2>Support</h2>

            <div class="tableoverflow">
        <table id="patients-table" class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                
                <th></th>
                <th></th>
               
            </tr>
        </thead>
        <tbody>
            <?php while($patient = mysqli_fetch_assoc($patient_result)): ?>
            <tr>

                <td><?php echo $patient['Fullname']; ?></td>
                <td><?php echo $patient['Email']; ?></td>
                <td><?php echo $patient['Contact_number']; ?></td>
                
                <td class="deleteth">
                  
                     <div class="deletediv">
                     <button class="view-btn" onclick='openPatientModal(<?php echo json_encode($patient); ?>)'  data-id="<?php echo $patient['Patients_id']; ?>" title="View Patient">
                            <i class="ri-delete-bin-line delete"></i>
                          </button>
                    
                </td>
                <td >
                </div >
                    <div class = "viewdiv">
                        <i class="ri-eye-line view"></i>
                    </button>
                     </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>

    </div>


        </div>
        </div>
           
        
                
    <!-- Modal Structure for Viewing Doctor Information -->
<div id="doctorModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Doctor's Information</h2>
        <form   id="doctorForm"  enctype="multipart/form-data">
        <div class="input-groupReg">
           <label for="upload-pic"> Profile Picture</label>
           <div class="profile-pic-container">
                <img id="profilePicture" src="" alt="Doctor Image" onclick="document.getElementById('upload-pic').click()" />
           <input type="file" id="upload-pic" name="profile_picture" accept="image/*" style="display: none;" />
                     </div>
            <div class="input-groupReg">
            <label for="fullname">Fullname:</label>
            <input type="text" id="fullname" name="fullname">
            </div> 
            <div class="input-groupReg">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age">
            </div>
            <div class="input-groupReg">
            <label for="specialization">Specialization:</label>
            <input type="text" id="specialization" name="specialization">
            </div>
            <div class="input-groupReg">
            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number">
            </div>
            <div class="input-groupReg">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            </div>
            <div class="input-groupReg">
            <label for="hire_date">Hire Date:</label>
            <input type="date" id="hire_date" name="hire_date">
            </div>
            <div class="input-groupReg">
            <label for="availability">Availability:</label>
            <select id="availability" name="availability">
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
            </select>
            </div>
            <div class="input-groupReg">
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
            </div>
            <div class="input-groupReg">
            <input type="hidden" id="doctor_id" name="doctor_id">
            <button  class= "btn"type="button" id="saveChanges">Save Changes</button>
            </div>
        </form>
    </div>
</div>
</section>


    <script src="Admin.js"></script>



 <!-- Modal Structure for Viewing Patient Information -->
 <div id="PatientModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Patient's Information</h2>
        <form   id="patientForm"  enctype="multipart/form-data">
        <div class="input-groupReg">
           <label for="upload-pic"> Profile Picture</label>
           <div class="profile-pic-container">
                <img id="profilePicture" src="" alt="Patient Image" onclick="document.getElementById('upload-pic').click()" />
           <input type="file" id="upload-pic" name="profile_picture" accept="image/*" style="display: none;" />
                     </div>
            <div class="input-groupReg">
            <label for="fullname">Fullname:</label>
            <input type="text" id="fullname" name="fullname">
            </div> 
           
        
            <div class="input-groupReg">
            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number">
            </div>
            <div class="input-groupReg">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            </div>
            <div class="input-groupReg">
            <label for="hire_date">Password</label>
            <input type="date" id="hire_date" name="hire_date">
            </div>
          
            <div class="input-groupReg">
            <input type="hidden" id="patient_id" name="patient_id">
            <button  class= "btn"type="button" id="saveChanges">Save Changes</button>
            </div>
        </form>
    </div>
</div>
</section>


    <script src="Admin.js"></script>

</body>
</html>