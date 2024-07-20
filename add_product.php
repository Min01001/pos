<?php
// Include necessary files
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


    // Prepare and execute the statement for the 'products' table
    $stmt = $conn->prepare("INSERT INTO products (barcode, product, item, price, total_price, profic, quantity, total, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssddds", $barcode, $product, $item, $price, $total_price, $profic, $quantity, $total, $date);

    // Prepare and execute the statement for the 'products_copy' table
    $stmt_copy = $conn->prepare("INSERT INTO products_copy (barcode, product, item, price, total_price, profic, quantity, total, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_copy->bind_param("sssssddds", $barcode, $product, $item, $price, $total_price, $profic, $quantity, $total, $date);

    if ($stmt->execute()) {
        if ($stmt_copy->execute()) {
            echo "<script>window.location.href='add_product.php';</script>";
        } else {
            echo "Error inserting into Products_copy: " . $stmt_copy->error;
        }
    } else {
        echo "Error inserting into Products: " . $stmt->error;
    }

    // Close statements and connection
    $stmt->close();
    $stmt_copy->close();
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
        <h3>ဝယ်ယူမှုစာရင်းပေါင်းထည့်ရန်</h3>
        <form class="row g-3" method="POST" onsubmit="return confirm('Are you sure you want to submit?')" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="col-md-6">
                <label for="barcode" class="form-label text-white">Barcode</label>
                <input type="text" class="form-control bg-transparent text-white" id="barcode" name="barcode">
            </div>
            <div class="col-md-6">
                <label for="product" class="form-label text-white">Product(ပစ္စည်းအမည်)</label>
                <input type="text" class="form-control bg-transparent text-white" id="product" name="product">
            </div>
            <div class="col-12">
                <label for="item" class="text-white">ပစ္စည်းအမျိုးအစား</label>
                <select name="item" id="item" class="selectpicker form-control bg-transparent" data-style="py-0">
                    <option value="မုန့်">မုန့်</option>
                    <option value="အလှကုန်ပစ္စည်း">အလှကုန်ပစ္စည်း</option>
                    <option value="မုန့်">ဆေးဝါမး</option>
                    <option value="အလှကုန်ပစ္စည်း">ဖျော်ရည်</option>
                    <option value="မုန့်">အသုံးအဆောင်</option>
                    <option value="အလှကုန်ပစ္စည်း">လျှပ်စစ်ပစ္စည်း</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="current" class="form-label text-white">မှုရင်းဈေးနှုန်း</label>
                <input type="text" class="form-control bg-transparent text-white" id="current" name="current">
            </div>
            <div class="col-md-6">
                <label for="current_price" class="form-label text-white">ရောင်းဈေး</label>
                <input type="text" class="form-control bg-transparent text-white" id="current_price"
                    name="current_price">
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
        </form>
    </div>
</div>