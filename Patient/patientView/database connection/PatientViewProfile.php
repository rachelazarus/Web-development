<?php
$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "electronic_Health_Information_System";

// Establish database connection
$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

// Check if the connection failed
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function retrieveProfile($conn, $fullname) {
    // Prepare the SQL query to get the profile image path
    $sql = "SELECT profile_image FROM profiles WHERE fullname = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters to the SQL query
    mysqli_stmt_bind_param($stmt, "s", $fullname);
    mysqli_stmt_execute($stmt);

    // Bind result variables
    mysqli_stmt_bind_result($stmt, $profileImagePath);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Display the profile picture or a default if not available
    if ($profileImagePath) {
        echo '<img src="' . htmlspecialchars($profileImagePath) . '" alt="Profile Picture" />';
    } else {
        echo '<img src="../images/default_profile.png" alt="Default Profile Picture" />';
    }
}
?>
