<div style="overflow-x: auto;">
    <table class="table table-dark table-hover">
        <tr class="text-white">
            <th>Barcode</th>
            <th>Product(ပစ္စည်းအမည်)</th>
            <th>အရေအတွက်</th>
            <th>ဈေးနှုန်း</th>
        </tr>

        <?php

// Correct path to the file



include './main/db_connect.php';

$sql = "SELECT barcode, product, item_count, price,id FROM sell ORDER BY id DESC";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["barcode"] . "</td>";
        echo "<td>" . $row["product"] . "</td>";
        echo "<td>" . $row["item_count"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>No records found.</td></tr>";
}
?>
    </table>

</div>