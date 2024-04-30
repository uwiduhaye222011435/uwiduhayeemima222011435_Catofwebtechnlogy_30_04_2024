<?php
include('connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'Appointment' => "SELECT reason FROM appointment WHERE reason LIKE '%$searchTerm%'",
        'Doctor' => "SELECT DoctorName FROM doctor WHERE DoctorName LIKE '%$searchTerm%'",
        'Patient' => "SELECT patientname FROM patient WHERE patientname LIKE '%$searchTerm%'",
        'payment' => "SELECT paymentstatus FROM payment WHERE  paymentstatusLIKE '%$searchTerm%'",
        'Insurance' => "SELECT insurance_name FROM insurance WHERE insurance_name LIKE '%$searchTerm%'",
        'prescription' => "SELECT medication_name FROM prescription WHERE medication_name LIKE '%$searchTerm%'",
        'medical_clinic' => "SELECT medical_clinicname FROM  medical_clinic WHERE medical_clinicname LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
