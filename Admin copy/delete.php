<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['id'];

    $delete_query = "DELETE FROM apointments WHERE Apointment_ID = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
