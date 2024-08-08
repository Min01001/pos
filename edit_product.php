<?php 
include './main/sidebar.php';
include './main/db_connect.php';
?>

<div class="content-page">
    <?php
        // Check if ID is set and not empty
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];

            // Fetch data from the database based on the ID
            $sql = "SELECT barcode, product, item, price, total_price, quantity, date FROM products WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stmt->close();
            } else {
                echo "No data found for the provided ID.";
                exit(); // Terminate script execution
            }
            $conn->close();
        } else {
            echo "ID parameter is missing or empty.";
            exit(); // Terminate script execution
        }
    ?>
    <div class="card-body">
        <form method="POST" action="update_product.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="col-md-6">
                <label for="barcode" class="form-label text-white">Barcode</label>
                <input type="text" class="form-control bg-transparent text-white" id="barcode" name="barcode"
                    value="<?php echo $row['barcode']; ?>">
            </div>
            <div class="col-md-6">
                <label for="product" class="form-label text-white">Product</label>
                <input type="text" class="form-control bg-transparent text-white" id="product" name="product"
                    value="<?php echo $row['product']; ?>">
            </div>
            <div class="col-6">
                <label for="item" class="text-white">Item Type</label>
                <select name="item" id="item" class="selectpicker form-control bg-transparent" data-style="py-0">
                    <option value="မုန့်" <?php echo $row['item'] == 'မုန့်' ? 'selected' : ''; ?>>မုန့်</option>
                    <option value="အလှကုန်ပစ္စည်း" <?php echo $row['item'] == 'အလှကုန်ပစ္စည်း' ? 'selected' : ''; ?>>
                        အလှကုန်ပစ္စည်း</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label text-white">Price</label>
                <input type="text" class="form-control bg-transparent text-white" id="price" name="price"
                    value="<?php echo $row['price']; ?>">
            </div>
            <div class="col-md-6">
                <label for="total_price" class="form-label text-white">Total Price</label>
                <input type="text" class="form-control bg-transparent text-white" id="total_price" name="total_price"
                    value="<?php echo $row['total_price']; ?>">
            </div>
            <div class="col-md-6">
                <label for="quantity" class="form-label text-white">Quantity</label>
                <input type="text" class="form-control bg-transparent text-white" id="quantity" name="quantity"
                    value="<?php echo $row['quantity']; ?>">
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label text-white">Date</label>
                <input type="date" class="form-control text-dark" id="date" name="date"
                    value="<?php echo $row['date']; ?>">
            </div>
            <div class="col-12" style="padding-top: 40px;">
                <button type="submit" class="btn btn-outline-primary" name="submit"
                    style="width: 200px; height: 40px;">Update</button>
            </div>
        </form>
    </div>
</div>