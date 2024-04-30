<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Appointment</title>
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
</style>
<!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
<form method="post" onsubmit="return confirmInsert();">
</head>
<body bgcolor="grey">
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
    <h1>Appointment Form</h1>
<form method="post" action="appointment.php">

<label for="appid">appointment_id:</label>
<input type="number" id="appid" name="appid" required><br><br>

<label for="name">status:</label>
<input type="text" id="status" name="status" required><br><br>

<label for="date">date:</label>
<input type="date" id="date" name="date" required><br><br>

<label for="reason">reason:</label>
<input type="text" id="reason" name="reason" required><br><br>



<label for="pid">patient_id:</label>
<input type="number" id="pid" name="pid" required><br><br>
<label for="did">doctor_id:</label>
<input type="number" id="pid" name="did" required><br><br>



<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
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

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $date = $_POST['date'];
    $status= $_POST['status'];
    $reason= $_POST['reason'];
    
    $pid= $_POST['pid'];
    $did= $_POST['did'];
    
    
    
    // Preparing SQL query
    $sql = "INSERT INTO appointment (appointmentdate, status_,reason,patient_id,doctor_id) 
    VALUES ('$date','$status','$reason' ,'$pid','$did')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
       // header("Location: login.html");
         echo "data inserted well.<a href='appointment.php'>RESULT</a>";
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
// SQL query to fetch data from the patient table
$sql = "SELECT * FROM appointment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of appointment</title>
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
    <center><h2>Table of Appointment</h2></center>
    <table border="5">
        <tr>
            <th>Appointment_id</th>
            <th>Appointment_date</th>
            <th>Status</th>
            <th>Reason</th>
           <th>Patient_id</th>
            <th>Doctor_id</th>
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

        // Prepare SQL query to retrieve all appointment
        $sql = "SELECT * FROM appointment";
        $result = $connection->query($sql);

        // Check if there are any appointment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $appid = $row['appointment_id']; // Fetch the appointment_id
                echo "<tr>
                    <td>" . $row['appointment_id'] . "</td>
                    <td>" . $row['appointmentdate'] . "</td>
                     <td>" . $row['status_'] . "</td>
                     <td>" . $row['reason'] . "</td>
                    <td>" . $row['patient_id'] . "</td>
                    <td>" . $row['doctor_id'] . "</td>
                   
                    <td><a style='padding:4px' href='delete_appointment.php?appointment_id=$appid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_appointment.php?appointment_id=$appid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
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