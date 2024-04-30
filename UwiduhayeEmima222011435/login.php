<?php
session_start(); // Starting the session

// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "emima";

// Create connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Prepare and execute SQL statement to prevent SQL injection
    $sql = "SELECT user_id, email, password FROM user WHERE email=?";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        die("Error in SQL query: " . $connection->error);
    }
    
    // Bind parameters and execute query
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: home.html"); // Redirect to home page after successful log in
            exit();
        } else {
            $error = "Invalid email or password"; // Set error message if password is incorrect
        }
    } else {
        $error = "User not found"; // Set error message if user does not exist
    }
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>