<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "store_shop";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token here if implemented
    
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Close prepared statement
        $stmt->close();
        // Close database connection
        $conn->close();
        // Redirect to employy.php after successful deletion
        header("Location: list_product.php");
        exit(); // Terminate script execution after redirection
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>
