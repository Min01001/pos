<?php
include './main/index.php';
include './main/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $barcode = $_POST['barcode'];
    $product = $_POST['product'];
    $item = $_POST['item'];
    $price = $_POST['current'];
    $total_price = $_POST['current_price'];
    $quantity = $_POST['qty'];
    $date = $_POST['date'];

    $profic = ($total_price - $price) * $quantity;
    $total = $total_price * $quantity;

    // Check if the barcode already exists in the products table
    $stmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE barcode = ?");
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Insert data into products_copy table
    $stmt = $conn->prepare("INSERT INTO products_copy (barcode, product, item, price, total_price, profic, quantity, date, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $barcode, $product, $item, $price, $total_price, $profic, $quantity, $date, $total);

    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

    if ($count > 0) {
        // Barcode already exists in products table
        echo "<script>alert('ထပ်မံပေါင်းထည့်ရန်.');</script>";
    } else {
        // Insert data into the products table
        $stmt = $conn->prepare("INSERT INTO products (barcode, product, item, price, total_price, profic, quantity, date, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $barcode, $product, $item, $price, $total_price, $profic, $quantity, $date, $total);

        if ($stmt->execute()) {
            echo "<script>window.location.href='add_product.php';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<style>
#item option {
    background-color: white;
    color: black;
}
</style>

<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>ဝယ်ယူမှုစာရင်းထပ်ဖြည့်ရန်</h3>
        <form class="row g-3" method="POST" onsubmit="return confirm('Are you sure you want to submit?')" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="col-md-6">
                <label for="barcode" class="form-label text-white">Barcode</label>
                <input type="text" class="form-control bg-transparent text-white" id="barcode" name="barcode"
                    onchange="fetchProductDetails(this.value)">
            </div>
            <div class="col-md-6">
                <label for="productInput" class="form-label text-white">Product(ပစ္စည်းအမည်)</label>
                <input type="text" class="form-control bg-transparent text-white" id="productInput" name="product"
                    readonly>
            </div>
            <div class="col-12">
                <label for="item" class="text-white">ပစ္စည်းအမျိုးအစား</label>
                <select name="item" id="item" class="selectpicker form-control bg-transparent" data-style="py-0">
                    <option value="မုန့်">မုန့်</option>
                    <option value="အလှကုန်ပစ္စည်း">အလှကုန်ပစ္စည်း</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="currentInput" class="form-label text-white">မှုရင်းဈေးနှုန်း</label>
                <input type="text" class="form-control bg-transparent text-white" id="currentInput" name="current"
                    >
            </div>
            <div class="col-md-6">
                <label for="current_priceInput" class="form-label text-white">ရောင်းဈေး</label>
                <input type="text" class="form-control bg-transparent text-white" id="current_priceInput"
                    name="current_price" >
            </div>
            <div class="col-md-6">
                <label for="qty" class="form-label text-white">အရေအတွက်</label>
                <input type="text" class="form-control bg-transparent text-white" id="qty" name="qty" value="1">
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label text-white">ရက်စွဲ</label>
                <input type="date" class="form-control text-dark" id="date" name="date">
            </div>
            <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                var today = new Date();
                var day = ("0" + today.getDate()).slice(-2);
                var month = ("0" + (today.getMonth() + 1)).slice(-2);
                var todayStr = today.getFullYear() + "-" + month + "-" + day;
                document.getElementById("date").value = todayStr;
            });
            </script>
            <div class="col-12" style="padding-top: 40px;">
                <button type="submit" class="btn btn-outline-primary" name="submit"
                    style="width: 200px; height: 40px;">Add</button>
            </div>
            <script>
            function fetchProductDetails(barcode) {
                let url = 'autoproduct.php?barcode=' + barcode;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('productInput').value = data.product;
                        document.getElementById('currentInput').value = data.current;
                        document.getElementById('current_priceInput').value = data.current_price;
                    })
                    .catch(error => console.error('Error:', error));
            }
            </script>
        </form>
    </div>
</div>