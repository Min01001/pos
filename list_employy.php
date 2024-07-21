<?php
include './main/index.php';
include './main/db_connect.php';
?>

<div class="content-page">
    <div class="container-fluid mt-3">
        <h3>ဝန်ထမ်းစာရင်းများ</h3>

        <div class="">
            <form method="GET">
                <input type="search" name="search_query" placeholder="Search here"
                    value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>

        <table class="table table-dark table-hover">
            <tr class="text-white">
                <th>Nrc</th>
                <th>Name</th>
                <th>Father</th>
                <th>Address</th>
                <th>Birthday</th>
                <th>Position</th>
                <th>StartDate</th>
                <th>Salary</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Email</th>
                <th colspan="2" style="text-align: center;">Action</th>
            </tr>

            <?php


                // Get the search query
                $searchQuery = isset($_GET['search_query']) ? $conn->real_escape_string($_GET['search_query']) : '';

                // Modify the SQL query to include the search functionality
                if ($searchQuery) {
                    $sql = "SELECT nrc, name, father, address, birthday, position, startdate, salary, gender, phone, email, id FROM employy 
                            WHERE nrc LIKE ? OR 
                                  name LIKE ? OR 
                                  father LIKE ? OR 
                                  address LIKE ? OR 
                                  birthday LIKE ? OR 
                                  position LIKE ? OR 
                                  startdate LIKE ? OR 
                                  salary LIKE ? OR 
                                  gender LIKE ? OR 
                                  phone LIKE ? OR 
                                  email LIKE ? 
                            ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                    $searchParam = "%{$searchQuery}%";
                    $stmt->bind_param('sssssssssss', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
                } else {
                    $sql = "SELECT nrc, name, father, address, birthday, position, startdate, salary, gender, phone, email, id FROM employy ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["nrc"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["father"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["birthday"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["position"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["startdate"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["salary"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["gender"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td>";
                        echo "<form id='form_delete_" . htmlspecialchars($row["id"]) . "' method='POST' onsubmit=\"return confirm('Are you sure you want to Delete?')\">";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm' formaction='employy_delete.php'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form id='form_edit_" . htmlspecialchars($row["id"]) . "' method='POST' onsubmit=\"return confirm('Are you sure you want to Edit?')\">";
                        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                        echo "<button type='submit' class='btn btn-primary btn-sm' formaction='edit_employy.php'>Edit</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No records found</td></tr>";
                }
                $stmt->close();
                $conn->close();
            ?>
        </table>
    </div>
</div>


<!-- <style>
.table-responsive {
    overflow-x: auto;
    overflow-y: auto;
    max-height: 600px;
    /* Adjust the height as needed */
}

/* WebKit browsers (Chrome, Safari) */
.table-responsive::-webkit-scrollbar {
    width: 12px;
    height: 12px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #444;
    /* Background color of the track */
}

.table-responsive::-webkit-scrollbar-thumb {
    background-color: #888;
    /* Scrollbar thumb color */
    border-radius: 6px;
    /* Rounded corners */
    border: 3px solid #444;
    /* Padding around scrollbar thumb */
}

/* Firefox */
.table-responsive {
    scrollbar-width: thin;
    /* Thin scrollbar */
    scrollbar-color: #888 #444;
    /* Scrollbar thumb and track color */
}
</style> -->