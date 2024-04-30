<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "emima";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if appointment_id is set
if(isset($_REQUEST['appointment_id'])) {
    $appid = $_REQUEST['appointment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM appointment WHERE appointment_id=?");
    $stmt->bind_param("i", $appid);
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
         echo "Record deleted successfully.<a href=' appointment.php'>CONFIRM</a";
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
    echo "appointment_id is not set.";
}

$connection->close();
?>
