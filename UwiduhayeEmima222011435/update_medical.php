<?php
include('connection.php');

// Check if medical_Id is set
if(isset($_REQUEST['medical_id'])) {
    $mid = $_REQUEST['medical_id'];
    
    $stmt = $connection->prepare("SELECT * FROM medical_clinic WHERE medical_id=?");
    $stmt->bind_param("s", $mid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['medical_id'];
        $y = $row['medical_clinicname'];
        $z = $row['date_'];
        $k = $row['patient_id'];
    } else {
        echo "Medical clinic not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update medical</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of medical</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="cname">Clinic Name:</label>
        <input type="text" name="cname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="date">Date:</label>
        <input type="text" name="date" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="pid">Patient ID:</label>
        <input type="text" name="pid" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $medical_clinicname = $_POST['cname'];
    $date_ = $_POST['date'];
    $patient_id = $_POST['pid'];
   
    // Update the medical in the database
    $stmt = $connection->prepare("UPDATE medical_clinic SET medical_clinicname=?, date_=?, patient_id=? WHERE medical_id=?");
    $stmt->bind_param("sssi", $medical_clinicname, $date_, $patient_id, $mid);
    $stmt->execute();
    
    // Redirect to medical.php
    header('Location: medical.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
