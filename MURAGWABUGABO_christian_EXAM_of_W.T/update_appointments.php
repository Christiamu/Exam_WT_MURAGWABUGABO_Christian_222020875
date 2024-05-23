<?php
include('db_connection.php');

// Check if Appointment ID is set
if(isset($_REQUEST['appointment_id'])) {
    $appointment_id = $_REQUEST['appointment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM appointments WHERE appointment_id=?");
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $therapist_id = $row['therapist_id'];
        $client_id = $row['client_id'];
        $appointment_time = $row['appointment_time'];
        $status = $row['status'];
    } else {
        echo "Appointment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Appointments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update appointments form -->
    <h2><u>Update Form for Appointments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="therapist_id">Therapist ID:</label>
        <input type="number" name="therapist_id" value="<?php echo isset($therapist_id) ? $therapist_id : ''; ?>">
        <br><br>

        <label for="client_id">Client ID:</label>
        <input type="number" name="client_id" value="<?php echo isset($client_id) ? $client_id : ''; ?>">
        <br><br>

        <label for="appointment_time">Appointment Time:</label>
        <input type="text" name="appointment_time" value="<?php echo isset($appointment_time) ? $appointment_time : ''; ?>">
        <br><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
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
    $appointment_time = $_POST['appointment_time'];
    $status = $_POST['status'];
    
    // Update the appointment in the database
    $stmt = $connection->prepare("UPDATE appointments SET therapist_id=?, client_id=?, appointment_time=?, status=? WHERE appointment_id=?");
    $stmt->bind_param("iissi", $therapist_id, $client_id, $appointment_time, $status, $appointment_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: appointments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?> 
