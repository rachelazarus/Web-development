<?php

include '../DBconnect.php';

// Check if the search term is set and not empty
if (isset($_GET['search-box']) && !empty(trim($_GET['search-box']))) {
    $searchTerm = trim($_GET['search-box']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT Patient_id, Fullname FROM patients WHERE Fullname LIKE ?");
    $searchParam = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchParam);

    // Execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $patients = []; 

        // Fetch the results
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $patients[] = $row; 
            }
        }

        // Output the patients as JSON
        if (empty($patients)) {
            echo json_encode(['error' => 'No patients found.']);
        } else {
            echo json_encode(['patients' => $patients]);
        }
    } else {
        // Error in executing query
        http_response_code(500);
        echo json_encode(['error' => 'Query execution failed.']);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['error' => 'Please enter a search term.']);
}

// Close the database connection
$conn->close();

