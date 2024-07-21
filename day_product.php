<?php
include './main/index.php';
include './main/db_connect.php';
?>


<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>ဝယ်ယူမှုစာရင်း(ရက်ချူပ်)</h3>

        <table class="table table-dark table-hover">
            <tr class="text-white">
                <th>Barcode</th>
                <th>Product(ပစ္စည်းအမည်)</th>
                <th>ပစ္စည်းအမျိုးအစား</th>
                <th>မူရင်းဈေး</th>
                <th>ရောင်းဈေး</th>
                <th>အမြတ်ငွေ</th>
                <th>အရေအတွက်</th>
                <th>စုစုပေါင်းတန်ဖိုး</th>
                <th>ရက်စွဲ</th>
            </tr>

            <?php

// Correct path to the file




$sql = "SELECT barcode, product, item, price, total_price, SUM(profic) AS total_profic, SUM(quantity) AS total_quantity, SUM(total) AS TOTAL, DATE_FORMAT(date, '%Y-%m-%d') AS day,id FROM products_copy GROUP BY day,barcode ORDER BY id DESC,barcode";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style ='overflow-x: auto; overflow-y: auto;'>";
        echo "<tr>";
        echo "<td>" . $row["barcode"] . "</td>";
        echo "<td>" . $row["product"] . "</td>";
        echo "<td>" . $row["item"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["total_price"] . "</td>";
        echo "<td>" . $row["total_profic"] . "</td>";
        echo "<td>" . $row["total_quantity"] . "</td>";
        echo "<td>" . $row["TOTAL"] . "</td>";
        echo "<td style='color: blue;'>" . $row["day"] . "</td>";
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