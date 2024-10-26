<?php

include '../DBconnect.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM doctors WHERE Fullname = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){

        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['username'] = $username;
            header("Location: ../Homapage/DoctorHomepage.html");
            exit;
        } else {
            echo "<script>alert('Incorrect password.'); window.history.back();</script>";
            exit;
        }

    }else{
        echo "<script>alert('Doctor not found.'); window.history.back();</script>";
        exit;
    }

    mysqli_stmt_close($stmt);

}

mysqli_close($conn);