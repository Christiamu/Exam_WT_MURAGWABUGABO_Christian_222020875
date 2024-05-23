<?php
include('db_connection.php');

// Check if profile ID is set
if(isset($_REQUEST['profile_id'])) {
    $profile_id = $_REQUEST['profile_id'];
    
    $stmt = $connection->prepare("SELECT * FROM profile WHERE profile_id=?");
    $stmt->bind_param("i", $profile_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $name = $row['name'];
        $gender = $row['gender'];
        $date_of_birth = $row['date_of_birth'];
        $address = $row['address'];
    } else {
        echo "Profile not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in profile Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update profile form -->
    <h2><u>Update Form for Profile</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        <br><br>

        <label for="gender">Gender:</label>
        <input type="text" name="gender" value="<?php echo isset($gender) ? $gender : ''; ?>">
        <br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="text" name="date_of_birth" value="<?php echo isset($date_of_birth) ? $date_of_birth : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    
    // Update the profile in the database
    $stmt = $connection->prepare("UPDATE profile SET user_id=?, name=?, gender=?, date_of_birth=?, address=? WHERE profile_id=?");
    $stmt->bind_param("issisi", $user_id, $name, $gender, $date_of_birth, $address, $profile_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: profile.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
