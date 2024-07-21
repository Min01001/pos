<?php
include './main/index.php';
include './main/db_connect.php';
?>



<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>ဝယ်ယူမှုစာရင်းများ</h3>

        <div class="">
            <form method="GET">
                <input type="search" name="search_barcode" placeholder="Search here"
                    value="<?php echo isset($_GET['search_barcode']) ? htmlspecialchars($_GET['search_barcode']) : ''; ?>">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>

        <table class="table table-dark table-hover">
            <thead>
                <tr class="text-white">
                    <th>Barcode</th>
                    <th>Product(ပစ္စည်းအမည်)</th>
                    <th>ပစ္စည်းအမျိုးအစား</th>
                    <th>မှုရင်းဈေး</th>
                    <th>ရောင်းဈေး</th>
                    <!-- <th>အမြတ်ငွေ</th> -->
                    <th>စုစုပေါင်းတန်ဖိုး</th>
                    <th>ရက်စွဲ</th>
                    <th colspan="2" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php


                // Get the search barcode from the URL parameter
                $searchBarcode = isset($_GET['search_barcode']) ? $conn->real_escape_string($_GET['search_barcode']) : '';

                // Modify the SQL query based on the search barcode
                if (!empty($searchBarcode)) {
                    $sql = "SELECT barcode, product, item, price, total_price, total, date, id FROM products 
                            WHERE barcode LIKE ?
                            ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                    $searchParam = "%{$searchBarcode}%";
                    $stmt->bind_param('s', $searchParam);
                } else {
                    $sql = "SELECT barcode, product, item, price, total_price, total, date, id FROM products GROUP BY barcode ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["barcode"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["product"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["item"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["total_price"]) . "</td>";
                        // echo "<td>" . htmlspecialchars($row["profic"]) . "</td>";
                        // echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["total"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                        echo "<td>";
                        echo "<form method='POST' onsubmit=\"return confirm('Are you sure you want to Edit?')\" action='edit_product.php'>";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                        echo "<button type='submit' class='btn btn-warning btn-sm'>Edit</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form method='POST' onsubmit=\"return confirm('Are you sure you want to delete?')\" action='delete_product.php'>";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No records found.</td></tr>";
                }

                // Close statement and database connection
                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>