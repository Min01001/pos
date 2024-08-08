<?php
include './main/sidebar.php';


if(isset($_POST['id']) && !empty($_POST['id'])){
    $id = $_POST['id'];


include './main/db_connect.php';

    $sql = "SELECT voncher, item, item_count, price, note, total_price, date FROM documents WHERE id=?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo "No data found";
        exit();
    }
} else {
    echo "Id isn't provided";
    exit();
}
?>

<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>အသုံးစရိတ်ပြင်ဆင်ရန်</h3>
        <form class="row g-3" method="POST" action="update_document.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="col-md-12">
                <label for="voncher" class="form-label text-white">Voncher</label>
                <input type="text" class="form-control bg-transparent text-white" id="voncher" name="voncher" value="<?php echo $row['voncher']; ?>">
            </div>
            <div class="col-md-6">
                <label for="item" class="form-label text-white">ပစ္စည်းအမျိုးအစား</label>
                <input type="text" class="form-control bg-transparent text-white" id="item" name="item" value="<?php echo $row['item']; ?>">
            </div>
            <div class="col-md-6">
                <label for="item_count" class="form-label text-white">အရေအတွက်</label>
                <input type="text" class="form-control bg-transparent text-white" id="item_count" name="item_count" value="<?php echo $row['item_count']; ?>">
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label text-white">တစ်ခုလိုက်ဈေးနှုန်း</label>
                <input type="text" class="form-control bg-transparent text-white" id="price" name="price" value="<?php echo $row['price']; ?>">
            </div>
            <div class="col-6">
                <label for="note" class="text-white">မှတ်စု</label>
                <select name="note" id="note" class="selectpicker form-control bg-transparent" data-style="py-0">
                    <option value="document" <?php if($row['note'] == 'document') echo 'selected'; ?>>Documents</option>
                    <option value="food" <?php if($row['note'] == 'food') echo 'selected'; ?>>Food</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="total_price" class="form-label text-white">စုစုပေါင်းတန်ဖိုး</label>
                <input type="text" class="form-control bg-transparent text-white" id="total_price" name="total_price" value="<?php echo $row['total_price']; ?>">
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label text-white">ရက်စွဲ</label>
                <input type="date" class="form-control text-dark" id="date" name="date" value="<?php echo $row['date']; ?>">
            </div>
            <!-- <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    var today = new Date();
                    var day = ("0" + today.getDate()).slice(-2);
                    var month = ("0" + (today.getMonth() + 1)).slice(-2);
                    var todayStr = today.getFullYear() + "-" + month + "-" + day;
                    document.getElementById("date").value = todayStr;
                });
            </script> -->
            <div class="col-12" style="padding-top: 40px;">
                <button type="submit" class="btn btn-outline-primary" name="submit" style="width: 200px; height: 40px;">Update</button>
            </div>
        </form>
    </div>
</div>
