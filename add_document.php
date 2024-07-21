<?php 
include './main/index.php';
include './main/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Retrieve and sanitize form data
        $voncher = $_POST['voncher'];
        $item = $_POST['item'];
        $item_count = $_POST['item_count']; 
        $price = $_POST['price'];
        $note = $_POST['note'];
        $total_price = $_POST['total_price'];
        $date = $_POST['date'];

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO documents (voncher, item, item_count, price, note, total_price, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $voncher, $item, $item_count, $price, $note, $total_price, $date);

        if($stmt->execute()){
            echo "New record added";
            echo "<script>window.location.href='add_document.php';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>


<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>အသုံးစရိတ်ပေါင်းထည့်ရန်</h3>
        <form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="col-md-12">
                <label for="voncher" class="form-label text-white">Voncher</label>
                <input type="text" class="form-control bg-transparent text-white" id="voncher" name="voncher">
            </div>
            <div class="col-md-6">
                <label for="item" class="form-label text-white">ပစ္စည်းအမျိုးအစား</label>
                <input type="text" class="form-control bg-transparent text-white" id="item" name="item">
            </div>
            <div class="col-md-6">
                <label for="item_count" class="form-label text-white">အရေအတွက်</label>
                <input type="text" class="form-control bg-transparent text-white" id="item_count" name="item_count" value="1">
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label text-white">တစ်ခုလိုက်ဈေးနှုန်း</label>
                <input type="text" class="form-control bg-transparent text-white" id="price" name="price">
            </div>
            <div class="col-6">
                <label for="note" class="text-white">မှတ်စု</label>
                <select name="note" id="note" class="selectpicker form-control bg-transparent" data-style="py-0">
                    <option value="document" >Documents</option>
                    <option value="food">Food</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="total_price" class="form-label text-white">စုစုပေါင်းတန်ဖိုး</label>
                <input type="text" class="form-control bg-transparent text-white" id="total_price" name="total_price">
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
                <button type="submit" class="btn btn-outline-primary" name="submit" style="width: 200px; height: 40px;">Add</button>
            </div>
        </form>
    </div>
</div>