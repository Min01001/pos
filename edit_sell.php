<?php
include './main/index.php';
include './main/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (isset($_POST['update'])) {
        // Update process
        $barcode = $_POST['barcode'];
        $product = $_POST['product'];
        $item_count = $_POST['item_count'];
        $price = $_POST['price'];
        $total_price = $item_count * $price;
        $date = $_POST['date'];

        $updateSql = "UPDATE sell SET barcode = ?, product = ?, item_count = ?, price = ?, total_price = ?, date = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('ssssssi', $barcode, $product, $item_count, $price, $total_price, $date, $id);

        if ($updateStmt->execute()) {
            echo "Record updated successfully.";
            echo "<script>window.location.href='list_sell.php';</script>";
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $updateStmt->close();
    } else {
        // Fetch record to display in form
        $sql = "SELECT id, barcode, product, item_count, price, total_price, date FROM sell WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Record not found.";
            exit();
        }
        $stmt->close();
    }
} else {
    echo "Invalid request.";
    exit();
}

$conn->close();
?>

<style>
    #item option{
        background-color: white;
        color: black;
    }
</style>

<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>ဝယ်ယူမှုစာရင်ပြင်ဆင်ရန်</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" >
            <div class="col-md-6">
                <label for="barcode" class="form-label text-white">Barcode</label>
                <input type="text" class="form-control" id="barcode" name="barcode" value="<?php echo htmlspecialchars($row['barcode']); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="product" class="form-label text-white">Product(ပစ္စည်းအမည်)</label>
                <input type="text" class="form-control" id="product" name="product" value="<?php echo htmlspecialchars($row['product']); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="item_count" class="form-label text-white">အရေအတွက်</label>
                <input type="number" class="form-control" id="item_count" name="item_count" value="<?php echo htmlspecialchars($row['item_count']); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label text-white">ဈေးနှုန်း</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="total_price" class="form-label text-white">စုစုပေါင်းတန်ဖိုး</label>
                <input type="text" class="form-control" id="total_price" name="total_price" value="<?php echo htmlspecialchars($row['total_price']); ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label text-white">ရက်စွဲ</label>
                <input type="date" class="form-control text-dark" id="date" name="date" value="<?php echo htmlspecialchars($row['date']); ?>" required>
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
                <button type="submit" class="btn btn-outline-primary text-white" name="update" style="width: 200px; height: 40px;">Update</button>
            </div>
        </form>
    </div>
</div>