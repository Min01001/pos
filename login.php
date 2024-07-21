<?php
// Database connection parameters
$servername = "sql106.infinityfree.com"; // Change if your database is hosted elsewhere
$username = "if0_36944494";
$password = "tKStKffbAC";
$database = "if0_36944494_store_shop";

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


