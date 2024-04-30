<?php

include('connection.php');
// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payment WHERE payment_id=?");
    $stmt->bind_param("s", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['amount'];
        $z = $row['paymentdate'];
        $k = $row['paymentstatus'];
        $w = $row['patient_id'];
        $h = $row['doctor_id'];
        $t = $row['appointment_id'];
    } else {
        echo "Payment not found.";
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
         <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="pdate">Paymentdate:</label>
        <input type="date" name="pdate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="pstatus">Paymentstatus:</label>
        <input type="text" name="pstatus" value="<?php echo isset($k) ? $k : ''; ?>">
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

        <input type="hidden" name="payment_id" value="<?php echo isset($payment_id) ? $payment_id : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $amount = $_POST['amount'];
    $paymentdate = $_POST['pdate'];
    $paymentstatus = $_POST['pstatus'];
    $patient_id = $_POST['pid'];
    $doctor_id = $_POST['did'];
    $appointment_id = $_POST['appid'];
    $payment_id = $_POST['payment_id'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payment SET amount=?, paymentdate=?, paymentstatus=?, patient_id=?, doctor_id=?, appointment_id=? WHERE payment_id=?");
    $stmt->bind_param("ssssssi", $amount, $paymentdate, $paymentstatus, $patient_id, $doctor_id, $appointment_id, $payment_id);
    $stmt->execute();
    
    // Redirect to payment.php
    header('Location: payment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
