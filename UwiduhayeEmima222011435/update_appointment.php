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

// Check if appointment_Id is set
if(isset($_REQUEST['appointment_id'])) {
    $appid = $_REQUEST['appointment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM appointment WHERE appointment_id=?");
    $stmt->bind_param("s", $appid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['appointment_id'];
        $y = $row['appointmentdate'];
        $z = $row['status_'];
        $k = $row['reason'];
        $w = $row['patient_id'];
        $h = $row['doctor_id'];
       
       
    } else {
        echo "appointment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update appointment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update appointment form -->
    <h2><u>Update Form of appointment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

         <label for="name">Date:</label>
        <input type="text" name="date" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>


         <label for="reason">Reason:</label>
        <input type="text" name="reason" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="pid">patient_id:</label>
        <input type="text" name="pid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <label for="did">doctor_id:</label>
        <input type="text" name="did" value="<?php echo isset($h) ? $h : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $appointmentdate = $_POST['date'];
    $status_= $_POST['status'];
    $reason = $_POST['reason'];
    $patient_id= $_POST['pid'];
    $doctor_id= $_POST['did'];
    
    
    // Update the  appointment in the database
    $stmt = $connection->prepare("UPDATE appointment SET appointmentdate=?, status_=?, reason=?, patient_id=?, doctor_id=? WHERE appointment_id=?");
    $stmt->bind_param("sssssi", $appointmentdate, $status_, $reason, $patient_id, $doctor_id, $appid);
    $stmt->execute();
    
    // Redirect to appointment.php
    header('Location: appointment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
