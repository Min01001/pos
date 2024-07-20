<?php
// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    include(__DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'db_connect.php');

    // Prepare and bind parameters for the update query
    $sql = "UPDATE employy SET nrc=?, name=?, father=?, address=?, birthday=?, position=?, startdate=?, salary=?, gender=?, phone=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssi", $_POST['nrc'], $_POST['name'], $_POST['father'], $_POST['address'], $_POST['birthday'], $_POST['position'], $_POST['startdate'], $_POST['salary'], $_POST['gender'], $_POST['phone'], $_POST['email'], $_POST['id']);

    // Execute the update query
    if ($stmt->execute()) {
        echo "Record updated successfully";
        // Redirect to another page after successful update
        header("Location: list_employy.php");
        exit(); // Terminate script execution after redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Method not allowed.";
}
?>
