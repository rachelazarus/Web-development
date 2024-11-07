<?php 
$host="localhost";
$user="root";
$db="Electronic_Health_Information_System";
$pass = "";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo "failed to connect DB".conn->connect_err;
}
?>