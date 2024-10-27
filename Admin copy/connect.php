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

?>