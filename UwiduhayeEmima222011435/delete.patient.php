<?php
include('connection.php');

// Check if patient_id is set
if(isset($_REQUEST['patient_id'])) {
    $pid = $_REQUEST['patient_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM patient WHERE patient_id=?");
    $stmt->bind_param("i", $pid);
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
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<a href=' patient.php'>CONFIRM</a";
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
    echo "patient_id is not set.";
}

$connection->close();
?>