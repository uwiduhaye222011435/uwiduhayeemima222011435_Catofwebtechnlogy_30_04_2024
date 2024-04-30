<?php
include('connection.php');

// Check if doctor_Id is set
if(isset($_REQUEST['Doctor_id'])) {
    $did = $_REQUEST['Doctor_id'];
    
    $stmt = $connection->prepare("SELECT * FROM doctor WHERE Doctor_id=?");
    $stmt->bind_param("s",$did);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Doctor_id'];
        $y = $row['DoctorName'];
        $z = $row['Specialty'];
        $k = $row['Email'];
        $w = $row['Phonenumber'];
       
       
    } else {
        echo "doctor not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update doctor</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update doctors form -->
    <h2><u>Update Form of doctors</u></h2>

    <form method="POST" onsubmit="return confirmUpdate();">
    

         <label for="dname">DoctorName:</label>
        <input type="text" name="dname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="specialty">Specialty:</label>
        <input type="text" name="specialty" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>


         <label for="eml">Email:</label>
        <input type="text" name="eml" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="phone">Phonenumber:</label>
        <input type="text" name="phone" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $DoctorName = $_POST['dname'];
    $Specialty= $_POST['specialty'];
    $Email = $_POST['eml'];
    $Phonenumber= $_POST['phone'];
    
    // Update the doctor in the database
    $stmt = $connection->prepare("UPDATE doctor SET DoctorName =?,Specialty =?,Email =?,Phonenumber=? WHERE doctor_id=?");
    $stmt->bind_param("ssssi",$DoctorName, $Specialty,$Email ,$Phonenumber, $did);
    $stmt->execute();
    
    // Redirect to doctor.php
    header('Location: doctor.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
