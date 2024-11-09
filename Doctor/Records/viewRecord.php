<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Record</title>
    <link rel="stylesheet" href="viewRecord.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <header>
        
        <nav>
            <div class="nav-links">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Records</a></li>
                    <li><a href="#">Appointments</a></li>
                </ul>
            </div>
           
        </nav>

    </header>

    <main>
        <section class="profile">
            <div class="profile-pic">
                <img src="../Appointment/pexels-dziana-hasanbekava-7275385.jpg" alt="profile Picture">
            </div>

            <div class="profile-info">
                <h2>Maria Johnnes</h2>
                <p><i class="fas fa-phone"></i> +264 81 426 1432</p>
                <p><i class="fas fa-envelope"></i> mariajohnes@gmail.com</p>
            </div>
        </section>

        <section class="records">

            <div class="record-item">
                <label>Weight:</label>
                <p>65 Kg</p>
            </div>

            <div class="record-item">
                <label>Age:</label>
                <p>29</p>
            </div>

            <div class="record-item">
                <label>Sickness Description:</label>
                <p>Persistent headache and nausea, possibly due to migraine.</p>
                <p>Allergic reaction to pollen, causing skin rashes.</p>
            </div>

            <div class="record-item">
                <label>Prescription:</label>
                <p>Paracetamol 500mg, twice daily; Antihistamine for allergies.</p>
            </div>

            <div class="record-item">
                <label>Diagnosis Date:</label>
                <p>October 20, 2024</p>
            </div>

            <div class="record-item">
                <label>Doctor Name:</label>
                <p>Dr. Michael Smith</p>
            </div>

            <div class="record-controls">
                <button>Previous</button>
                <button>Next</button>
                <button onclick="location.href='addRecord.html'">Add</button>
            </div>

        </section>
    </main>

</body>

</html>