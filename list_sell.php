<?php
include './main/index.php';
include './main/db_connect.php';
?>

<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>ရောင်းဈေးစာရင်းများ</h3>

        <div class="">
            <form method="GET">
                <input type="search" name="search_barcode" placeholder="Search here"
                    value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>

        <table class="table table-dark table-hover">
            <thead>
                <tr class="text-white">
                    <th>Barcode</th>
                    <th>Product(ပစ္စည်းအမည်)</th>
                    <th>အရေအတွက်</th>
                    <th>ဈေးနှုန်း</th>
                    <th>စုစုပေါင်းတန်ဖိုး</th>
                    <th>ရက်စွဲ</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
          

                // Get the search query
                $searchQuery = isset($_GET['search_barcode']) ? $conn->real_escape_string($_GET['search_barcode']) : '';

                // Modify the SQL query to include the search functionality
                if ($searchQuery) {
                    $sql = "SELECT barcode, product, item_count, price, total_price, date, id FROM sell 
                            WHERE barcode LIKE ? OR 
                                  product LIKE ? OR 
                                  date LIKE ? 
                            ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                    $searchParam = "%{$searchQuery}%";
                    $stmt->bind_param('sss', $searchParam, $searchParam, $searchParam);
                } else {
                    $sql = "SELECT barcode, product, item_count, price, total_price, date, id FROM sell ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["barcode"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["product"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["item_count"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["total_price"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                        echo "<td>";
                        echo "<form method='POST' action='edit_sell.php'>";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                        echo "<button type='submit' class='btn btn-warning btn-sm'>Edit</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found.</td></tr>";
                }

                // Close database connection
                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>