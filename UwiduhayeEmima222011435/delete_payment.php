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

// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $paid = $_REQUEST['payment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM payment WHERE payment_id=?");
    $stmt->bind_param("i", $paid);
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully. <a href='payment.php'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
    }
    $stmt->close();
} else {
    echo "Payment ID is not set.";
}

$connection->close();
?>

<!-- Form to trigger delete -->
<form method="post" onsubmit="return confirmDelete();">
    <input type="hidden" name="payment_id" value="<?php echo $paid; ?>">
    <input type="submit" value="Delete">
</form>

</body>
</html>
