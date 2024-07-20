<?php

include(__DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token here if implemented
    
    $id = $_POST['id'];

    $sql = "DELETE FROM employy WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Close prepared statement
        $stmt->close();
        // Close database connection
        $conn->close();
        // Redirect to employy.php after successful deletion
        header("Location: list_employy.php");
        exit(); // Terminate script execution after redirection
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

?>
