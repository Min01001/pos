<?php
// Database connection parameters
$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root";
$password = "";
$database = "store_shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize username and password inputs
    $username = sanitize_input($_POST["username"]);
    $password = sanitize_input($_POST["password"]);
    
    // Query to fetch user from database
    $sql = "SELECT * FROM user_login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if result contains any rows
    if ($result->num_rows > 0) {
        // Redirect to another page
        header("Location: dashboard.php");
        exit();
    } else {
        // Handle incorrect username or password
        echo "Incorrect username or password.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-6">
            <div class="">
                <h2 class="mt-5 mb-4 text-center">Login</h2>

                

                <!-- Login Form -->
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
