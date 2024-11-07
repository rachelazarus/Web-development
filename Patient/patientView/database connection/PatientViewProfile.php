<?php 
$host="localhost";
$user="root";
$db="Electronic_Health_Information_System";
$pass = "";
$conn=new mysqli($host,$user,$pass,$db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

function retrieveProfile($email) {
    global $conn;

    // Prepare the SQL statement with a placeholder for the email
    $stmt = $conn->prepare("SELECT Profile_picture_path, Email, Contact_number FROM patients WHERE Email = ?");
    
    if ($stmt) {
        // Bind the email parameter to the placeholder
        $stmt->bind_param("s", $email);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result and fetch data as an associative array
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Returns the row as an associative array
        } else {
            return null; // No results found for the specified email
        }
    } else {
        return false; // If the statement could not be prepared
    }
}


?>