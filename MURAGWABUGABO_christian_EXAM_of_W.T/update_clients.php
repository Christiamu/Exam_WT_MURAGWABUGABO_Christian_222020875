<?php
include('db_connection.php');

// Check if Client ID is set
if(isset($_REQUEST['client_id'])) {
    $client_id = $_REQUEST['client_id'];
    
    $stmt = $connection->prepare("SELECT * FROM clients WHERE client_id=?");
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
    } else {
        echo "Client not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Clients Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update clients form -->
    <h2><u>Update Form for Clients</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['user_id'];
    
    // Update the client in the database
    $stmt = $connection->prepare("UPDATE clients SET user_id=? WHERE client_id=?");
    $stmt->bind_param("ii", $user_id, $client_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: clients.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?> 
