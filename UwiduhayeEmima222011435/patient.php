<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PATIENT</title>
  <style>
  .dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .dropdown-contents a:hover {
    background-color: #f1f1f1;
  }
</style>
<!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body bgcolor=" grey">
   <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color:  darkblue; text-decoration: none; margin-right: 15px;">Home</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html" style="padding: 10px; color: white; background-color:  darkblue; text-decoration: none; margin-right: 15px;">About</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html" style="padding: 10px; color: white; background-color: darkblue; text-decoration: none; margin-right: 15px;">Contact</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Appointment.php" style="padding: 10px; color: white; background-color:  darkblue; text-decoration: none; margin-right: 15px;">Appointment</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Doctor.php" style="padding: 10px; color: white; background-color: darkblue;text-decoration: none; margin-right: 15px;">Doctor</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Patient.php" style="padding: 10px; color: white; background-color: darkblue; text-decoration: none; margin-right: 15px;">Patient</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Insurance.php" style="padding: 10px; color: white; background-color:  darkblue; text-decoration: none; margin-right: 15px;">Insurance</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Payment.php" style="padding: 10px; color: white; background-color: darkblue;text-decoration: none; margin-right: 15px;">Payment</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Prescription.php" style="padding: 10px; color: white; background-color:  darkblue; text-decoration: none; margin-right: 15px;">Prescription</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Medical.php" style="padding: 10px; color: white; background-color: darkblue;text-decoration: none; margin-right: 15px;">Medical_clinic</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: darkblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
    <h1>Patient Form</h1>
<form method="post" onsubmit="return confirmInsert();">

<label for="pid">Patient Id:</label>
<input type="number" id="pid" name="patient_id" required><br><br>

<label for="pname">Patientname:</label>
<input type="name" id="pname" name="pname" required><br><br>

<label for="pad">Patientaddress:</label>
<input type="name" id="pad" name="pad" required><br><br>

<label for="pn">Phonenumber:</label>
<input type="pn" id="phonenumber" name="pn" required><br><br>

<label for="eml">Email:</label>
<input type="name" id="eml" name="eml" required><br><br>


<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
<?php
include('connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $pname  = $_POST['pname'];
    $pad = $_POST['pad'];
    $pn = $_POST['pn'];
    $eml = $_POST['eml'];
    
    // Preparing SQL query
    $sql = "INSERT INTO patient (Patientname, Patientaddress, Phonenumber, Email) 
    VALUES ('$pname','$pad','$pn','$eml')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
       // header("Location: login.html");
        echo "data inserted well .<a href='patient.php'>RESULT</a>";
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>





<?php
include('connection.php');
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// SQL query to fetch data from the patient table
$sql = "SELECT * FROM patient";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of patient</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of patient</h2></center>
    <table border="5">
        <tr>
            <th>Patient Id</th>
            <th>Patient Name</th>
            <th>Patient address</th>
            <th>Phonenumber</th>
            <th>Email</th>
            
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "emima";

        // Establish a new connection
        $connection = new mysqli($host, $user, $pass, $database);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare SQL query to retrieve all patients
        $sql = "SELECT * FROM patient";
        $result = $connection->query($sql);

        // Check if there are any patient
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $pid = $row['patient_id']; // Fetch the patient_id
                echo "<tr>
                    <td>" . $row['patient_id'] . "</td>
                    <td>" . $row['patientname'] . "</td>
                     <td>" . $row['patientaddress'] . "</td>
                    <td>" . $row['phonenumber'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td><a style='padding:4px' href='delete.patient.php?patient_id=$pid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_patient.php?patient_id=$pid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Emima UWIDUHAYE</h2></b>
  </center>
</footer>
</body>
</html>