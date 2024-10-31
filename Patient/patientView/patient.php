<?php include 'DB_connectPatient.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients List</title>
</head>
<body>
    <h1>Patients</h1>

    <?php
    // Query to select patient data
    $sql = "SELECT Fullname, Age, Email, Contact_number FROM patients";
    $result = $conn->query($sql);

    // Check if any patients exist and display them
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p>Name: " . htmlspecialchars($row["Fullname"]) . "</p>";
            echo "<p>Age: " . htmlspecialchars($row["Age"]) . "</p>";
            echo "<p>Email: " . htmlspecialchars($row["Email"]) . "</p>";
            echo "<p>Contact: " . htmlspecialchars($row["Contact_number"]) . "</p>";
            echo "</div><hr>";
        }
    } else {
        echo "No patients found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
