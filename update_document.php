<?php
// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters

    include './main/db_connect.php';

    // Prepare and bind parameters for the update query
    $sql = "UPDATE documents SET voncher=?, item=?, item_count=?, price=?, note=?, total_price=?, date=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $_POST['voncher'], $_POST['item'], $_POST['item_count'], $_POST['price'], $_POST['note'], $_POST['total_price'], $_POST['date'], $_POST['id']);

    // Execute the update query
    if ($stmt->execute()) {
        echo "Record updated successfully";
        // Redirect to another page after successful update
        header("Location: list_document.php");
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
