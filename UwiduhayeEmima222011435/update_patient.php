<?php
include('connection.php');

// Check if patient_Id is set
if(isset($_REQUEST['patient_id'])) {
    $pid = $_REQUEST['patient_id'];
    
    $stmt = $connection->prepare("SELECT * FROM patient WHERE patient_id=?");
    $stmt->bind_param("i", $pid); // Assuming patient_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['patientname'];
        $z = $row['patientaddress'];
        $k = $row['phonenumber'];
        $w = $row['email'];
    } else {
        echo "Patient not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update patient</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update patients form -->
    <h2><u>Update Form of patients</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
         <label for="pname">Patientname:</label>
        <input type="text" name="pname" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="pad">Patientaddress:</label>
        <input type="text" name="pad" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <label for="phone">Phonenumber:</label>
        <input type="text" name="phone" value="<?php echo isset($k) ? htmlspecialchars($k) : ''; ?>">
        <br><br>

        <label for="eml">Email:</label>
        <input type="text" name="eml" value="<?php echo isset($w) ? htmlspecialchars($w) : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $patientname = $_POST['pname'];
    $patientaddress = $_POST['pad'];
    $phonenumber = $_POST['phone'];
    $email = $_POST['eml'];
    
    // Update the patient in the database
    $stmt = $connection->prepare("UPDATE patient SET patientname=?, patientaddress=?, phonenumber=?, email=? WHERE patient_id=?");
    $stmt->bind_param("ssssi", $patientname, $patientaddress, $phonenumber, $email, $pid);
    $stmt->execute();
    
    // Redirect to patient.php
    header('Location: patient.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
