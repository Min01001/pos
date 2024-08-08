<?php
// Database connection parameters
include './main/db_connect.php';

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


