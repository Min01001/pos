<div style="overflow-x: auto;">
<table class="table table-dark table-bordered">
    <tbody>
    <tr class="text-white">
        <th>Barcode</th>
        <th>Product(ပစ္စည်းအမည်)</th>
        <th>အရေအတွက်</th>
        <th>စုစုပေါင်းတန်ဖိုး</th>
    </tr>

<?php


include './main/db_connect.php';

$sql = "SELECT barcode, product, item_count, total_price, date, id FROM sell_record ORDER BY id DESC";
$result = $conn->query($sql);
$totalPrice = 0;

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["barcode"] . "</td>";
        echo "<td>" . $row["product"] . "</td>";
        echo "<td>" . $row["item_count"] . "</td>";
        echo "<td>" . $row["total_price"] . "</td>";
        echo "</tr>";
        $totalPrice += $row["total_price"];
    }
} else {
    echo "<tr><td colspan='4'>No records found.</td></tr>";
}
?>
    <tr>
        <th scope="row"></th>
        <td colspan="2" class="table-active">Total</td>
        <td><?php echo $totalPrice; ?></td>
    </tr>
    </tbody>
</table>
</div>
