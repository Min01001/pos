<?php
include './main/index.php';
include './main/db_connect.php';
?>


<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>ရောင်းအား(နှစ်ချူပ်)</h3>

        <table class="table table-dark table-hover">
            <tr class="text-white">
                <th>Barcode</th>
                <th>Product(ပစ္စည်းအမည်)</th>
                <th>အရေအတွက်</th>
                <th>ဈေးနှုန်း</th>
                <th>စုစုပေါင်းတန်ဖိုး</th>
                <th>ရက်စွဲ</th>
            </tr>

            <?php

// Correct path to the file



$sql = "SELECT barcode, product, SUM(item_count) AS total_item, price, SUM(total_price) AS total,  DATE_FORMAT(date, '%Y') AS month,id FROM sell GROUP BY month,barcode ORDER BY id DESC,barcode";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style ='overflow-x: auto; overflow-y: auto;'>";
        echo "<tr>";
        echo "<td>" . $row["barcode"] . "</td>";
        echo "<td>" . $row["product"] . "</td>";
        echo "<td>" . $row["total_item"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["total"] . "</td>";
        echo "<td style='color: blue;'>" . $row["month"] . "</td>";
        echo "</tr>";
        echo "</div>";
    }
} else {
    echo "<tr><td colspan='9'>No records found.</td></tr>";
}
?>
        </table>
    </div>
</div>