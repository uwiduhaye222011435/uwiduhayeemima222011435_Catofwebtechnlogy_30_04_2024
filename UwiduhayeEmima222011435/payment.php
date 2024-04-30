<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PAYMENT</title>
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
   
    <h1>Payment Form</h1>
<form method="post" onsubmit="return confirmInsert();">

<label for="payment_id">Payment Id:</label>
<input type="number" id="payment_id" name="payment_id" required><br><br>
<label for="amount">amount:</label>

<input type="number" id="amount" name="amount" required><br><br>

<label for="pd">Paymentdate:</label>
<input type="date" id="pd" name="pd" required><br><br>
<label for="ps">Paymentstatus:</label>
<input type="name" id="ps" name="ps" required><br><br>
<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
<?php
include('connection.php');

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $amount= $_POST['amount'];
    $pdate= $_POST['pd'];
    $ps= $_POST['ps'];
     
    
    // Preparing SQL query
    $sql = "INSERT INTO payment(amount,paymentdate, paymentstatus,patient_id) 
    VALUES ('$amount','$pdate','$ps')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
       // header("Location: login.html");
         echo "data inserted well.<a href='payment.php'>RESULT</a>";
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
$sql = "SELECT * FROM payment";
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
    <center><h2>Table of Payment</h2></center>
    <table border="5">
        <tr>
            <th>Payment_id</th>
            <th>Amount</th>
            <th>Paymentdate</th>
            <th>Paymentstatus</th>
           
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

        // Prepare SQL query to retrieve all payment
        $sql = "SELECT * FROM payment";
        $result = $connection->query($sql);

        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $paid = $row['payment_id']; // Fetch the payment_id
                echo "<tr>
                    <td>" . $row['payment_id'] . "</td>
                     <td>" . $row['amount'] . "</td>
                    <td>" . $row['paymentdate'] . "</td>
                     <td>" . $row['paymentstatus'] . "</td>
                     
                    <td><a style='padding:4px' href='delete_payment.php?payment_id=$paid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_payment.php?payment_id=$paid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
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