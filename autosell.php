<?php
// Simulating database connection
include(__DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'db_connect.php');

// Get barcode value from AJAX request
$barcode = $_GET['barcode'];

// Prepare SQL statement to fetch product details based on barcode
$sql = "SELECT product, total_price FROM products WHERE barcode = '$barcode'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Product details found, return them as JSON
    $row = $result->fetch_assoc();
    $product = $row['product'];
    $total_price = $row['total_price'];

    $response = array(
        'product' => $product,
        'total_price' => $total_price
    );

    echo json_encode($response);
} else {
    // No product found for the given barcode
    $response = array(
        'error' => 'Product not found'
    );

    echo json_encode($response);
}

// Close database connection
$conn->close();
?>
