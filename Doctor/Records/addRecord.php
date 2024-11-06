<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addRecord.css">
    <title>Add Record</title>
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

    <div class="container">
        <form action="addRecordtoDB.php" method="post" class="combined-form">
            <div class="left-section">
                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" placeholder="Enter weight" required>

                <label for="age">Age:</label>
                <input type="text" id="age" name="age" placeholder="Enter age" required>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>

            <div class="right-container">
                <label for="sickness-description">Sickness description:</label>
                <textarea id="sickness-description" name="sickness_description" rows="4" placeholder="Describe sickness" required></textarea>

                <label for="diagnosis">Diagnosis:</label>
                <textarea id="diagnosis" name="diagnosis" rows="4" placeholder="Enter diagnosis" required></textarea>

                <label for="prescription">Prescription:</label>
                <textarea id="prescription" name="prescription" rows="4" placeholder="Enter prescription" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>

  
    </div>

</body>
</html>
