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

<?php
include('connection.php');

// Check if medical_id is set
if(isset($_REQUEST['medical_id'])) {
    $mid = $_REQUEST['medical_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM medical_clinic WHERE medical_id=?");
    $stmt->bind_param("i", $mid);
     if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if ($stmt->execute()) {
      echo "Record deleted successfully.<a href='Medical.php'>CONFIRM</a";  
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
    }
    $stmt->close();
} else {
    echo "Medical ID is not set.";
}

$connection->close();
?>

<!-- Form to trigger delete -->
<form method="post" onsubmit="return confirmDelete();">
    <input type="hidden" name="medical_id" value="<?php echo $mid; ?>">
    <input type="submit" value="Delete">
</form>

</body>
</html>
