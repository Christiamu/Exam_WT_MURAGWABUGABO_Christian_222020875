<?php
include('db_connection.php');

// Check if file ID is set
if(isset($_REQUEST['file_id'])) {
    $file_id = $_REQUEST['file_id'];
    
    $stmt = $connection->prepare("SELECT * FROM session_files WHERE file_id=?");
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $session_id = $row['session_id'];
        $user_id = $row['user_id'];
        $therapist_id = $row['therapist_id'];
        $file_name = $row['file_name'];
        $file_url = $row['file_url'];
        $timestamp = $row['timestamp'];
    } else {
        echo "File not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in session_files Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update session_files form -->
    <h2><u>Update Form for Session Files</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="session_id">Session ID:</label>
        <input type="number" name="session_id" value="<?php echo isset($session_id) ? $session_id : ''; ?>">
        <br><br>

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>

        <label for="therapist_id">Therapist ID:</label>
        <input type="number" name="therapist_id" value="<?php echo isset($therapist_id) ? $therapist_id : ''; ?>">
        <br><br>

        <label for="file_name">File Name:</label>
        <input type="text" name="file_name" value="<?php echo isset($file_name) ? $file_name : ''; ?>">
        <br><br>

        <label for="file_url">File URL:</label>
        <input type="text" name="file_url" value="<?php echo isset($file_url) ? $file_url : ''; ?>">
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
    $user_id = $_POST['user_id'];
    $therapist_id = $_POST['therapist_id'];
    $file_name = $_POST['file_name'];
    $file_url = $_POST['file_url'];
    $timestamp = $_POST['timestamp'];
    
    // Update the file in the database
    $stmt = $connection->prepare("UPDATE session_files SET session_id=?, user_id=?, therapist_id=?, file_name=?, file_url=?, timestamp=? WHERE file_id=?");
    $stmt->bind_param("iiissii", $session_id, $user_id, $therapist_id, $file_name, $file_url, $timestamp, $file_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: session_files.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
