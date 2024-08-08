<?php
include './main/sidebar.php';
include './main/db_connect.php';
?>


<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>အသုံးစာရိတ်(ရက်ချူပ်)</h3>

        <table class="table table-dark table-hover">
            <tr class="text-white">
                <th>ပစ္စည်းအမည်</th>
                <th>အရေအတွက်</th>
                <th>စုစုပေါင်းတန်ဖိုး</th>
                <th>ရက်စွဲ</th>
            </tr>

            <?php

// Correct path to the file





$sql = "SELECT item, item_count, SUM(total_price) AS total, DATE_FORMAT(date, '%Y-%m-%d') AS day,id FROM documents GROUP BY day,item ORDER BY id DESC,item";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style ='overflow-x: auto; overflow-y: auto;'>";
        echo "<tr>";
        echo "<td>" . $row["item"] . "</td>";
        echo "<td>" . $row["item_count"] . "</td>";
        echo "<td>" . $row["total"] . "</td>";
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