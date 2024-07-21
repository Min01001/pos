<?php

include './main/db_connect.php';

$barcode = $_GET['barcode'] ?? ''; // Null coalescing operator ကို သုံးတာက ပိုအဆင်ပြေတယ်
if ($barcode) {
    $sql = "SELECT product, price FROM products WHERE barcode = '$barcode'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = array(
            'product' => $row['product'],
            'price' => $row['price']
        );
    } else {
        $response = array(
            'error' => 'Product not found'
        );
    }
    echo json_encode($response);
    $conn->close();
} else {
    echo json_encode(array('error' => 'No barcode provided'));
}
?>
