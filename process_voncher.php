<?php
include './main/index.php';
include './main/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $barcode = filter_var($_POST['barcode'], FILTER_SANITIZE_STRING);
    $product = filter_var($_POST['product'], FILTER_SANITIZE_STRING);
    $item_count = filter_var($_POST['item_count'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $total_price = $item_count * $price;
    $date = date('Y-m-d');  // Assuming you want to use the current date

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert into sell table
        $stmt1 = $conn->prepare("INSERT INTO sell (barcode, product, item_count, price, total_price, date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("ssidds", $barcode, $product, $item_count, $price, $total_price, $date);
        $stmt1->execute();

        // Insert into sell_record table
        $stmt2 = $conn->prepare("INSERT INTO sell_record (barcode, product, item_count, price, total_price, date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("ssidds", $barcode, $product, $item_count, $price, $total_price, $date);
        $stmt2->execute();

        // Commit transaction
        $conn->commit();

        echo "New record added";
        echo "<script>window.location.href = 'add_sell.php';</script>";
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    } finally {
        // Close statements and connection
        $stmt1->close();
        $stmt2->close();
        $conn->close();
    }
}
?>


