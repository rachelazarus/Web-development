<?php 
session_start();
include("connect.php")
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
        <!-- Header content here -->
    </section>
    <section class="main">
        <div class="sidebar">
            <!-- Sidebar content here -->
        </div>
        <div class="main--content">
            <!-- Other main content here -->

            <div class="recent--patients">
                <div class="title">
                    <h2 class="section--title">Recent Patients</h2>
                    <button class="add"><i class="ri-add-line"></i>Add Doctor</button>
                </div>
                <div class="search-bar">
                    <input type="text" id="patientSearch" placeholder="Search Patients...">
                    <button onclick="searchPatients()"><i class="ri-search-2-line"></i></button>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date in</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Status</th>
                                <th>Settings</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody id="patientsTable">
                            <tr>
                                <td>Cameron Williamson</td>
                                <td>30/07/2022</td>
                                <td>Male</td>
                                <td>61kg</td>
                                <td class="pending">Pending</td>
                                <td><span><i class="ri-edit-line edit"></i><i class="ri-delete-bin-line delete"></i></span></td>
                                <td><button class="view-btn">View</button></td>
                            </tr>
                            <tr>
                                <td>George Washington</td>
                                <td>30/07/2022</td>
                                <td>Male</td>
                                <td>54kg</td>
                                <td class="confirmed">Confirmed</td>
                                <td><span><i class="ri-edit-line edit"></i><i class="ri-delete-bin-line delete"></i></span></td>
                                <td><button class="view-btn">View</button></td>
                            </tr>
                            <!-- Repeat for other rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/main.js"></script>
</body>

</html>
