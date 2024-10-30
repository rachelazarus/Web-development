<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['id'];
    $item_type = $_POST['type'];

    // Define the SQL query based on type
    if ($item_type === 'appointment') {
        $delete_query = "DELETE FROM apointments WHERE Apointment_ID = ?";
    } elseif ($item_type === 'doctor') {
        $delete_query = "DELETE FROM doctors WHERE Doctors_id = ?";
    } else {
        echo "Invalid item type";
        exit;
    }

    // Prepare and execute the statement
    $stmt = $conn->prepare($delete_query);
    if ($stmt) {
        $stmt->bind_param("i", $item_id);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
