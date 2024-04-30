<?php
include('connection.php');

// Check if prescription_id is set
if(isset($_REQUEST['prescription_id'])) {
    $prid = $_REQUEST['prescription_id'];
    
    $stmt = $connection->prepare("SELECT * FROM prescription WHERE prescription_id=?");
    $stmt->bind_param("s", $prid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['medication_name'];
        $z = $row['dosage'];
        $k = $row['frequency'];
        $s = $row['startdate'];
        $e = $row['Enddate'];
        $w = $row['patient_id'];
        $h = $row['doctor_id'];
        $t = $row['appointment_id'];
    } else {
        echo "prescription not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update payment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update payment form -->
    <h2><u>Update Form of payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="mname">MedicationName:</label>
        <input type="text" name="mname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="dosage">Dosage:</label>
        <input type="number" name="dosage" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="fr">Frequency:</label>
        <input type="number" name="fr" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>
         <label for="start">Startdate:</label>
        <input type="date" name="start" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
         <label for="end">Enddate:</label>
        <input type="date" name="end" value="<?php echo isset($s) ? $s : ''; ?>">
        <br><br>

        <label for="pid">Patient ID:</label>
        <input type="text" name="pid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="did">Doctor ID:</label>
        <input type="text" name="did" value="<?php echo isset($h) ? $h : ''; ?>">
        <br><br>

        <label for="appid">Appointment ID:</label>
        <input type="text" name="appid" value="<?php echo isset($t) ? $t : ''; ?>">
        <br><br>

        <input type="hidden" name="prescription_id" value="<?php echo isset($prid) ? $prid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $medication_name = $_POST['mname'];
    $dosage = $_POST['dosage'];
    $frequency = $_POST['fr'];
    $startdate = $_POST['start'];
    $Enddate = $_POST['end'];
    $patient_id = $_POST['pid'];
    $doctor_id = $_POST['did'];
    $appointment_id = $_POST['appid'];
  
    
    // Update the prescription in the database
    $stmt = $connection->prepare("UPDATE prescription SET medication_name=?, dosage=?, frequency=?, startdate=?, Enddate=?, patient_id=?, doctor_id=?, appointment_id=? WHERE prescription_id=?");
    $stmt->bind_param("ssssssssi", $medication_name, $dosage, $frequency, $startdate, $Enddate, $patient_id, $doctor_id, $appointment_id, $prid);
    $stmt->execute();
    
    // Redirect to prescription.php
    header('Location: prescription.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>