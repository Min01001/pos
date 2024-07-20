<?php
$file = __DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'index.php';
if (file_exists($file)) {
    include($file);
} else {
    echo "File not found";
}
include(__DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Retrieve and sanitize form data
        $note = $_POST['note'];
        $income = $_POST['income'];
        $date = $_POST['date'];

            // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO outcomes (note, outcome, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $note, $income, $date);

        if ($stmt->execute()) {
            echo "<script>window.location.href='outcome.php';</script>";
            exit();
        } else {
                echo "Error: " . $stmt->error;
        }

        $stmt->close();

        $conn->close();
    }
}
?>

<div class="content-page">
    <div class="container-fluid mt-6">
        <div>
            <h3>အခြားထွက်ငွေစာရင်း</h3>
        </div>
        <div class="row col-md-12">
            <div class="col-md-6">
                <div class="bg-grey text-dark p-3">
                    <!-- Form action -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                        onsubmit="return confirm('Are you sure you want to submit?')">
                        <div class="form-group row mb-3">
                            <label for="noteInput" class="col-sm-3 col-form-label text-white">မှတ်စု</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="noteInput" name="note">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="incomeInput" class="col-sm-3 col-form-label text-white">ထွက်ငွေ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="incomeInput" name="income">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="dateInput" class="col-sm-3 col-form-label text-white">Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dateInput" name="date">
                            </div>
                        </div>

                        <script>
                        document.addEventListener("DOMContentLoaded", function(event) {
                            var today = new Date();
                            var day = ("0" + today.getDate()).slice(-2);
                            var month = ("0" + (today.getMonth() + 1)).slice(-2);
                            var todayStr = today.getFullYear() + "-" + month + "-" + day;
                            document.getElementById("dateInput").value = todayStr;
                        });
                        </script>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="submit" value="submit"
                                    style="width: 200px; height: 40px;">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Total: -
                    <?php
        // Include database connection
        include(__DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'db_connect.php');

        // Query to fetch total outcome
        $outcomesql = "SELECT SUM(outcome) AS total_outcome FROM outcomes";
        $outcomeresult = $conn->query($outcomesql);
        $resultoutcome = $outcomeresult->fetch_assoc();
        echo $resultoutcome['total_outcome'] . " ကျပ်";

        // Close database connection
        $conn->close();
        ?>
                </h4>
                <div class="">
                    <form method="GET">
                        <input type="search" name="search_query" placeholder="Search here"
                            value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </div>
                <div style="overflow-x: auto;">
                    <table class="table table-dark table-bordered">
                        <thead>
                            <tr class="text-white">
                                <th>မှတ်စု</th>
                                <th>ထွက်ငွေ</th>
                                <th>ရက်စွဲ</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                // Include database connection
                include(__DIR__ . DIRECTORY_SEPARATOR . 'main' . DIRECTORY_SEPARATOR . 'db_connect.php');

                // Get the search query
                $searchQuery = isset($_GET['search_query']) ? $conn->real_escape_string($_GET['search_query']) : '';

                // Modify the SQL query to include the search functionality
                if ($searchQuery) {
                    $sql = "SELECT id, note, outcome, date FROM outcomes 
                            WHERE note LIKE ? OR 
                                  outcome LIKE ? OR 
                                  date LIKE ? 
                            ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                    $searchParam = "%{$searchQuery}%";
                    $stmt->bind_param('sss', $searchParam, $searchParam, $searchParam);
                } else {
                    $sql = "SELECT id, note, outcome, date FROM outcomes ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["note"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["outcome"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                        echo "<td>";
                        echo "<form id='form_delete_" . htmlspecialchars($row["id"]) . "' method='POST' action='delete_outcome.php' onsubmit=\"return confirm('Are you sure you want to Delete?')\">";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="4">No records found</td></tr>';
                }

                // Close database connection
                $stmt->close();
                $conn->close();
                ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>