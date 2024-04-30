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

// Check if Product_Id is set
if(isset($_REQUEST['insurance_id'])) {
    $i_id = $_REQUEST['insurance_id'];
    
    $stmt = $connection->prepare("SELECT * FROM insurance WHERE insurance_id=?");
    $stmt->bind_param("s",$i_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['insurance_id'];
        $y = $row['insurance_name'];
       
    } else {
        echo "insurance not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update insurance</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of insurances</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    

        <label for="iname">insurance_name:</label>
        <input type="text" name="iname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $insurance_name = $_POST['iname'];
    
    // Update the insurance in the database
    $stmt = $connection->prepare("UPDATE insurance SET insurance_name=? WHERE insurance_id=?");
    $stmt->bind_param("ss",$insurance_name, $i_id);
    $stmt->execute();
    
    // Redirect to insurance.php
    header('Location: insurance.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
