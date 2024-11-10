<?php
session_start(); 
include '../DBconnect.php';

$patient_id = $_GET['patient_id'];
$patient_query = "SELECT * FROM patients WHERE Patient_id = '$patient_id'";
$patient_result = mysqli_query($conn, $patient_query);
$patient = mysqli_fetch_assoc($patient_result);

$records_query = "
    SELECT patient_record_entries.*, doctors.Fullname AS DoctorName 
    FROM patient_record_entries 
    LEFT JOIN doctors ON patient_record_entries.Doctors_id = doctors.Doctors_id 
    WHERE patient_record_entries.Patient_id = '$patient_id' 
    ORDER BY Date_of_entry DESC
";
$records_result = mysqli_query($conn, $records_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewRecord.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <title>View Patient Record</title>
</head>
<body>
    <main>
        <!-- Patient Info -->
        <section class="profile">
            <div class="profile-pic">
                <img src="../images/<?php echo htmlspecialchars($patient['Profile_picture_path']); ?>" alt="Profile Picture">
            </div>
            <h2><?php echo htmlspecialchars($patient['Fullname']); ?></h2>
            <p>Age: <?php echo $patient['Age']; ?></p>
            <p>Contact: <?php echo $patient['Contact_number']; ?></p>
            <p>Email: <?php echo $patient['Email']; ?></p>
        </section>
        

        <!-- Records List and Search -->
        <section class="records">
        <a href="SearchPage.php" class="back-button">← Back</a>
            <form action="#" method="GET" class="search-form" onsubmit="return false;">
                <input type="text" id="search-box" placeholder="Search for an entry" oninput="filterTable()">
                <button type="button" onclick="filterTable()">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <button class="button add-record-entry" onclick="openAddRecordModal()">
                <i class="fas fa-plus"></i> Add Record Entry
                      </button>

            <h1>Previous record entries</h1>
            <table id="records-table" class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Diagnosis</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($record = mysqli_fetch_assoc($records_result)): ?>
                    <tr>
                        <td><?php echo $record['Date_of_entry']; ?></td>
                        <td class="record-info">
                            <span class="diagnoses"><?php echo htmlspecialchars($record['Diagnoses']); ?></span>
                        </td>
                        <td class="view-btn-cell">
                    <button class="view-btn" onclick="viewRecordDetails('<?php echo htmlspecialchars(json_encode($record), ENT_QUOTES, 'UTF-8'); ?>')"title="View Patient">
                  <i class="ri-eye-line view-icon"></i>
                  </button>
                    </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Modal for displaying record details -->
        <div id="recordModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="recordDetails"></div>
            </div>
        </div>
        <div id="addRecordModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeAddRecordModal()">&times;</span>
                <h3>Add New Record Entry</h3>
                <form id="addRecordForm" action="addRecordToDB.php" method="POST">
                    <input type="hidden" name="doctor_id" value="<?php echo $_SESSION['doctor_id']; ?>">
                    <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                    <label for="temperature">Temperature:</label>
                    <input type="number" name="temperature" step="0.1" required>
                    <label for="weight">Weight:</label>
                    <input type="number" name="weight" step="0.1" required>
                    <label for="sickness_description">Sickness Description:</label>
                    <textarea name="sickness_description" required></textarea>
                    <label for="diagnosis">Diagnosis:</label>
                    <textarea name="diagnosis" required></textarea>
                    <label for="prescription">Prescription:</label>
                    <textarea name="prescription"></textarea>
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
        </div>

    </main>

    <script>
       function viewRecordDetails(record) {
    const data = JSON.parse(record);
    const modalContent = `
        <h3>Record Details</h3>
        <p><strong>Date:</strong> ${data.Date_of_entry}</p>
        <p><strong>Diagnosis:</strong> ${data.Diagnoses}</p>
        <p><strong>Doctor:</strong> ${data.DoctorName || "Not Available"}</p>
        <p><strong>Prescriptions:</strong> ${data.Prescriptions}</p>
        <p><strong>Temperature:</strong> ${data.Temperature} Degrees Celsius </p>
        <p><strong>Weight:</strong> ${data.Weight}Kg</p>
        <p><strong>Sickness description:</strong><br>${data.Sickness_description}</p>
    `;
    document.getElementById("recordDetails").innerHTML = modalContent;
    document.getElementById("recordModal").style.display = "flex";  // Centered modal
}


        function closeModal() {
            document.getElementById("recordModal").style.display = "none";
        }

        // JavaScript for dynamic search functionality
        function filterTable() {
            const searchInput = document.getElementById("search-box").value.toLowerCase();
            const table = document.getElementById("records-table");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                const nameCell = rows[i].querySelector(".record-info .diagnoses");
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
        function openAddRecordModal() {
    document.getElementById("addRecordModal").style.display = "block";
}

function closeAddRecordModal() {
    document.getElementById("addRecordModal").style.display = "none";
}
function openAddRecordModal() {
    document.getElementById("addRecordModal").style.display = "flex";  // or "block"
}

function closeAddRecordModal() {
    document.getElementById("addRecordModal").style.display = "none";
}

function goBack() {
    window.history.back();
}


    </script>
</body>
</html>
