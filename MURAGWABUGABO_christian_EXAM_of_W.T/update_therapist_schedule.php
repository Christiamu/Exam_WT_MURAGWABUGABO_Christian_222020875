<?php
include('db_connection.php');

// Check if session ID is set
if(isset($_REQUEST['session_id'])) {
    $session_id = $_REQUEST['session_id'];
    
    $stmt = $connection->prepare("SELECT * FROM therapist_schedule WHERE session_id=?");
    $stmt->bind_param("i", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $therapist_id = $row['therapist_id'];
        $client_id = $row['client_id'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $session_type = $row['session_type'];
    } else {
        echo "Session not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in therapist_schedule Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update therapist_schedule form -->
    <h2><u>Update Form for Therapist Schedule</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="therapist_id">Therapist ID:</label>
        <input type="number" name="therapist_id" value="<?php echo isset($therapist_id) ? $therapist_id : ''; ?>">
        <br><br>

        <label for="client_id">Client ID:</label>
        <input type="number" name="client_id" value="<?php echo isset($client_id) ? $client_id : ''; ?>">
        <br><br>

        <label for="start_time">Start Time:</label>
        <input type="text" name="start_time" value="<?php echo isset($start_time) ? $start_time : ''; ?>">
        <br><br>

        <label for="end_time">End Time:</label>
        <input type="text" name="end_time" value="<?php echo isset($end_time) ? $end_time : ''; ?>">
        <br><br>

        <label for="session_type">Session Type:</label>
        <input type="text" name="session_type" value="<?php echo isset($session_type) ? $session_type : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $therapist_id = $_POST['therapist_id'];
    $client_id = $_POST['client_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $session_type = $_POST['session_type'];
    
    // Update the session in the database
    $stmt = $connection->prepare("UPDATE therapist_schedule SET therapist_id=?, client_id=?, start_time=?, end_time=?, session_type=? WHERE session_id=?");
    $stmt->bind_param("iisssi", $therapist_id, $client_id, $start_time, $end_time, $session_type, $session_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: therapist_schedule.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
