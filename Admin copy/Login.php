<?php
include'connect.php';
$error_message = '';
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    // $password=md5($password) ;
    
    $sql="SELECT * FROM Admins WHERE username='$username' and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
     session_start();
     $row=$result->fetch_assoc();
     $_SESSION['username']=$row['username']; 
     header("Location: Adminview.php");
     exit();
    }
    else{
        echo "Incorrect username or password";
    }
 
 }
?>