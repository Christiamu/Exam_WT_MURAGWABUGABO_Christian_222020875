<?php
include('db_connection.php');

// Check if payment ID is set
if(isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE payment_id=?");
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $client_id = $row['client_id'];
        $therapist_id = $row['therapist_id'];
        $session_id = $row['session_id'];
        $amount = $row['amount'];
        $payment_date = $row['payment_date'];
        $payment_method = $row['payment_method'];
    } else {
        echo "Payment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in payments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update payments form -->
    <h2><u>Update Form for Payments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="client_id">Client ID:</label>
        <input type="number" name="client_id" value="<?php echo isset($client_id) ? $client_id : ''; ?>">
        <br><br>

        <label for="therapist_id">Therapist ID:</label>
        <input type="number" name="therapist_id" value="<?php echo isset($therapist_id) ? $therapist_id : ''; ?>">
        <br><br>

        <label for="session_id">Session ID:</label>
        <input type="number" name="session_id" value="<?php echo isset($session_id) ? $session_id : ''; ?>">
        <br><br>

        <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>">
        <br><br>

        <label for="payment_date">Payment Date:</label>
        <input type="text" name="payment_date" value="<?php echo isset($payment_date) ? $payment_date : ''; ?>">
        <br><br>

        <label for="payment_method">Payment Method:</label>
        <input type="text" name="payment_method" value="<?php echo isset($payment_method) ? $payment_method : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $client_id = $_POST['client_id'];
    $therapist_id = $_POST['therapist_id'];
    $session_id = $_POST['session_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    $payment_method = $_POST['payment_method'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payments SET client_id=?, therapist_id=?, session_id=?, amount=?, payment_date=?, payment_method=? WHERE payment_id=?");
    $stmt->bind_param("iiidssi", $client_id, $therapist_id, $session_id, $amount, $payment_date, $payment_method, $payment_id);
    $stmt->execute();
    
    // Redirect to view page
    header('Location: payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
