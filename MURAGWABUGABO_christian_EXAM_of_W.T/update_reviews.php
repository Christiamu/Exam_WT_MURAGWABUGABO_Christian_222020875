<?php
include('db_connection.php');

// Check if review ID is set
if(isset($_REQUEST['review_id'])) {
    $review_id = $_REQUEST['review_id'];
    
    $stmt = $connection->prepare("SELECT * FROM reviews WHERE review_id=?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $session_id = $row['session_id'];
        $therapist_id = $row['therapist_id'];
        $client_id = $row['client_id'];
        $rating = $row['rating'];
        $review_text = $row['review_text'];
        $review_date = $row['review_date'];
    } else {
        echo "Review not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in reviews Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update reviews form -->
    <h2><u>Update Form for Reviews</u></h2>
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

        <label for="rating">Rating:</label>
        <input type="number" name="rating" value="<?php echo isset($rating) ? $rating : ''; ?>">
        <br><br>

        <label for="review_text">Review Text:</label>
        <input type="text" name="review_text" value="<?php echo isset($review_text) ? $review_text : ''; ?>">
        <br><br>

        <label for="review_date">Review Date:</label>
        <input type="text" name="review_date" value="<?php echo isset($review_date) ? $review_date : ''; ?>">
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
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];
    $review_date = $_POST['review_date'];
    
    // Update the review in the database
    $stmt = $connection->prepare("UPDATE reviews SET session_id=?, therapist_id=?, client_id=?, rating=?, review_text=?, review_date=? WHERE review_id=?");
    $stmt->bind_param("iiiissi", $session_id, $therapist_id, $client_id, $rating, $review_text, $review_date, $review_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: reviews.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
