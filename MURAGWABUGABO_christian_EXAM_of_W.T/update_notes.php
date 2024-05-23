<?php
include('db_connection.php');

// Check if Note ID is set
if(isset($_REQUEST['note_id'])) {
    $note_id = $_REQUEST['note_id'];
    
    $stmt = $connection->prepare("SELECT * FROM notes WHERE note_id=?");
    $stmt->bind_param("i", $note_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $session_id = $row['session_id'];
        $therapist_id = $row['therapist_id'];
        $client_id = $row['client_id'];
        $note_body = $row['note_body'];
        $timestamp = $row['timestamp'];
    } else {
        echo "Note not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in notes Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update notes form -->
    <h2><u>Update Form for Notes</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="session_id">Session ID:</label>
        <input type="number" name="session_id" value="<?php echo isset($session_id) ? $session_id : ''; ?>">
        <br><br>

        <label for="therapist_id">Therapist ID:</label>
        <input type="number" name="therapist_id" value="<?php echo isset($therapist_id) ? $therapist_id : ''; ?>">
        <br><br>

        <label for="client_id">Client ID:</label>
        <input type="number" name="client_id" value="<?php echo isset($client_id) ? $client_id : ''; ?>">
        <br><br>

        <label for="note_body">Note Body:</label>
        <input type="text" name="note_body" value="<?php echo isset($note_body) ? $note_body : ''; ?>">
        <br><br>

        <label for="timestamp">Timestamp:</label>
        <input type="text" name="timestamp" value="<?php echo isset($timestamp) ? $timestamp : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $session_id = $_POST['session_id'];
    $therapist_id = $_POST['therapist_id'];
    $client_id = $_POST['client_id'];
    $note_body = $_POST['note_body'];
    $timestamp = $_POST['timestamp'];
    
    // Update the note in the database
    $stmt = $connection->prepare("UPDATE notes SET session_id=?, therapist_id=?, client_id=?, note_body=?, timestamp=? WHERE note_id=?");
    $stmt->bind_param("iiissi", $session_id, $therapist_id, $client_id, $note_body, $timestamp, $note_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: notes.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
