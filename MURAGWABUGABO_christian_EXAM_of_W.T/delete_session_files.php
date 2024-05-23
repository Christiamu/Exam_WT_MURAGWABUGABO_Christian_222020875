<?php
include('db_connection.php');

// Check if File ID is set
if(isset($_REQUEST['file_id'])) {
    $file_id = $_REQUEST['file_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM session_files WHERE file_id=?");
    $stmt->bind_param("i", $file_id);
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
        <input type="hidden" name="file_id" value="<?php echo $file_id; ?>">
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
    echo "File ID is not set.";
}

$connection->close();
?>
