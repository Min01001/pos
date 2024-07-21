<?php
// Check if all required POST parameters are set and not empty
if (isset($_POST['id']) && !empty($_POST['id']) &&
    isset($_POST['barcode']) && !empty($_POST['barcode']) &&
    isset($_POST['product']) && !empty($_POST['product']) &&
    isset($_POST['item']) && !empty($_POST['item']) &&
    isset($_POST['price']) && !empty($_POST['price']) &&
    isset($_POST['total_price']) && !empty($_POST['total_price']) &&
    isset($_POST['quantity']) && !empty($_POST['quantity']) &&
    isset($_POST['date']) && !empty($_POST['date'])) {

    $id = $_POST['id'];
    $barcode = $_POST['barcode'];
    $product = $_POST['product'];
    $item = $_POST['item'];
    $price = $_POST['price'];
    $total_price = $_POST['total_price'];
    $quantity = $_POST['quantity'];
    $total = $total_price * $quantity;
    $date = $_POST['date'];


    include './main/db_connect.php';
    
    $sql = "UPDATE products SET barcode = ?, product = ?, item = ?, price = ?, total_price = ?, quantity = ?, total = ?, date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    $stmt->bind_param("ssssssisi", $barcode, $product, $item, $price, $total_price, $quantity, $total, $date, $id);
    
    if ($stmt->execute() === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    } else {
        echo "Record updated successfully";
        header("Location: list_product.php");
        exit();
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Required parameters are missing.";
}
?>