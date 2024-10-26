<?php 

$severName = "localhost";
$username = "root";
$password = "";
$dbname = "Electronic_Health_Information_System";

$conn = new MySQLi($severName, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

?>