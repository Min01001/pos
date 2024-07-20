<?php
$file = __DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'index.php';
if (file_exists($file)) {
    include($file);
} else {
    echo "File not found";
}
include(__DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $barcode = $_POST['barcode'];
        $product = $_POST['product'];
        $item_count = $_POST['item_count'];
        $price = $_POST['price'];
        $total_price = $item_count * $price;
        $date = $_POST['date'];

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
            // Rollback transaction if something went wrong
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }

        // Close the statements
        $stmt1->close();
        $stmt2->close();
    } elseif (isset($_POST['delete'])) {
        try {
            $conn->query("DELETE FROM sell_record");
            echo "All records deleted";
            echo "<script>window.location.href = 'add_sell.php';</script>";
            exit();
        } catch (Exception $e) {
            echo "Error deleting records: " . $e->getMessage();
        }
    }
}

$conn->close();
?>

<div class="content-page">
    <div class="container-fluid mt-6">
        <div>
            <h5>ရောင်းဈေးပေါင်းထည့်ရန်</h5>
        </div>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="bg-grey text-dark p-3">
                    <!-- Form action -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                        onsubmit="return confirm('Are you sure you want to submit?')">
                        <div class="form-group row mb-3">
                            <label for="barcodeInput" class="col-sm-3 col-form-label text-white">Barcode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="barcodeInput" name="barcode"
                                    onchange="fetchProductDetails(this.value)">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="productInput" class="col-sm-3 col-form-label text-white">Product</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="productInput" name="product" readonly>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="piecesInput" class="col-sm-3 col-form-label text-white">အရေအတွက်</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="piecesInput" name="item_count" value="1">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="dateInput" class="col-sm-3 col-form-label text-white">Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dateInput" name="date">
                            </div>
                        </div>

                        <script>
                        document.addEventListener("DOMContentLoaded", function(event) {
                            var today = new Date();
                            var day = ("0" + today.getDate()).slice(-2);
                            var month = ("0" + (today.getMonth() + 1)).slice(-2);
                            var todayStr = today.getFullYear() + "-" + month + "-" + day;
                            document.getElementById("dateInput").value = todayStr;
                        });
                        </script>

                        <div class="form-group row mb-3">
                            <label for="totalInput" class="col-sm-3 col-form-label text-white">ဈေးနှုန်း</label>
                            <div class="col-sm-9">
                                <input type="number" step="0.01" class="form-control" id="totalInput" name="price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="submit" value="submit"
                                    style="width: 200px; height: 40px;">Add</button>
                            </div>
                        </div>
                    </form>

                    <script>
                    function fetchProductDetails(barcode) {
                        let url = 'autosell.php?barcode=' + barcode;
                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('productInput').value = data.product;
                                document.getElementById('totalInput').value = data.price;
                            })
                            .catch(error => console.error('Error:', error));
                    }
                    </script>
                </div>
            </div>
            <div class="col-md-6">
                <h4>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                        onsubmit="return confirm('Are you sure you want to delete all records?')">
                        <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete_record</button>
                    </form>
                </h4>
                <?php
                $file = __DIR__ . DIRECTORY_SEPARATOR . 'sellrecord.php';
                if (file_exists($file)) {
                    include($file);
                } else {
                    echo "File not found";
                }
                ?>
            </div>
        </div>
    </div>
</div>