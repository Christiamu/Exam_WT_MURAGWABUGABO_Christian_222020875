<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {

 include('db_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'appointments' => "SELECT appointment_id FROM appointments WHERE appointment_id LIKE '%$searchTerm%'",
        'clients' => "SELECT client_id FROM clients WHERE client_id LIKE '%$searchTerm%'",
        'notes' => "SELECT note_id FROM notes WHERE note_id LIKE '%$searchTerm%'",
        'payments' => "SELECT payment_id FROM payments WHERE payment_id LIKE '%$searchTerm%'",
        'profile' => "SELECT name FROM profile WHERE name LIKE '%$searchTerm%'",
        'reviews' => "SELECT review_id FROM reviews WHERE review_id LIKE '%$searchTerm%'",
        'session_files' => "SELECT file_name FROM session_files WHERE file_name LIKE '%$searchTerm%'",
        'sessions' => "SELECT session_id FROM sessions WHERE session_id LIKE '%$searchTerm%'",
        'therapist_schedule' => "SELECT session_id FROM therapist_schedule WHERE session_id LIKE '%$searchTerm%'",
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



