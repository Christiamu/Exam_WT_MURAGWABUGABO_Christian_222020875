<?php
include('db_connection.php');

// Check if Note ID is set
if(isset($_REQUEST['note_id'])) {
    $note_id = $_REQUEST['note_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM notes WHERE note_id=?");
    $stmt->bind_param("i", $note_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="note_id" value="<?php echo $note_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Note ID is not set.";
}

$connection->close();
?>
