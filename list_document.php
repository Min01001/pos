<?php
$file = __DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'index.php';

if (file_exists($file)) {
    include($file);
} else {
    echo "File not found: " . $file;
}
?>


<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>အသုံးစရိတ်များ</h3>

        <div class="">
            <form method="GET">
                <input type="search" name="search_query" placeholder="Search here"
                    value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>


        <table class="table table-dark table-hover">
            <tr class="text-white">
                <th>Voncher</th>
                <th>ပစ္စည်းအမျိုးအစား</th>
                <th>အရေအတွက်</th>
                <th>ဈေးနှုန်း</th>
                <th>မှတ်စု</th>
                <th>စုစုပေါင်းတန်ဖိုး</th>
                <th>ရက်စွဲ</th>
                <th colspan="2" style="text-align: center;">Action(ပြင်ရန်)</th>
            </tr>

            <?php

// Correct path to the file


include(__DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'db_connect.php');

$searchQuery = isset($_GET['search_query']) ? $conn->real_escape_string($_GET['search_query']) : '';

if($searchQuery){
    $sql = "SELECT voncher, item, item_count, total_price, price, note, date, id FROM documents WHERE voncher LIKE ? OR item LIKE ? OR note LIKE ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $searchParam = "%{$searchQuery}%";
    $stmt->bind_param('sss', $searchParam, $searchParam, $searchParam);
}else{
    $sql = "SELECT voncher, item, item_count, total_price, price, note, date, id FROM documents ORDER BY id DESC";
                $stmt = $conn->prepare($sql);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div style='overflow-x: auto; overflow-y: auto;'>";
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["voncher"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["item"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["item_count"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["note"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["total_price"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                    echo "<td>";
                    echo "<form id='form_delete_" . htmlspecialchars($row["id"]) . "' method='POST' onsubmit=\"return confirm('Are you sure you want to delete?')\" action='edit_document.php'>";
                    echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                    echo "<button type='submit' class='btn btn-danger btn-sm'>Edit</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</div>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found.</td></tr>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </table>
    </div>
</div>