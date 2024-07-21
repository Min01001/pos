

<?php
include './main/index.php';
include './main/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the POST data
    $nrc = $_POST['nrc'];
    $namee = $_POST['names'];
    $father = $_POST['father'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $position = $_POST['position'];
    $startdate = $_POST['startdate'];
    $salary = $_POST['salary'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Prepare and execute SQL INSERT statement
    $stmt = $conn->prepare("INSERT INTO employy (nrc, name, father, address, birthday, position, startdate, salary, gender, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $nrc, $namee, $father, $address, $birthday, $position, $startdate, $salary, $gender, $phone, $email);

    if ($stmt->execute()) {
        echo "New record added";
        echo "<script>window.location.href = 'add_employy.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<div class="content-page">
    <div class="card-body">
        <h3>ဝန်ထမ်းစာရင်းပေါင်းထည့်ရန်</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nrc" class="text-white">Nrc</label>
                        <input type="text" class="form-control image-file" name="nrc" accept="image/*" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="text-white">Name *</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="names">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="father" class="text-white">Father Name *</label>
                        <input type="text" class="form-control" placeholder="Father Name" name="father">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address" class="text-white">Address *</label>
                        <input type="text" class="form-control" placeholder="Enter address" name="address">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="birthday" class="text-white">Birthday *</label>
                        <input type="date" class="form-control calendar bg-ash" name="birthday">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="position" class="text-white">အလုပ်အကိုင်/ရာထူး</label>
                        <select class="selectpicker form-control" name="position" id="position" data-style="py-0">
                            <option value="exclusive">Manager</option>
                            <option value="inclusive">Accounted</option>
                            <option value="inclusive">Salary</option>
                            <option value="inclusive">Marketing</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="startdate" class="text-white">StartDate *</label>
                        <input type="date" class="form-control calendar bg-ash" name="startdate">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="salary" class="text-white">Salary *</label>
                        <input type="text" class="form-control" placeholder="လစာ" name="salary">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender" class="text-white">Gender</label>
                        <select class="selectpicker form-control" name="gender" id="gender" data-style="py-0">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone" class="text-white">Phone *</label>
                        <input type="text" class="form-control" placeholder="ဖုန်းနံပတ်" name="phone">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="text-white">Email *</label>
                        <input type="email" class="form-control" placeholder="email" name="email">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group image-type">
                        <label class="text-white">Upload Teacher Photo <span>(150 X 150)</span></label>
                        <input type="file" name="propic" accept="image/*">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-primary" name="submit"
                style="width: 200px; height: 40px;">Add</button>
            <!-- <button type="reset" class="btn btn-danger">Reset</button> -->
        </form>
    </div>
</div>