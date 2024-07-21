<?php 
include './main/index.php';
include './main/db_connect.php';

?>

<div class="content-page">
    
        
      <?php
// Check if ID is set and not empty
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];


              
                // Fetch data from the database based on the ID
                $sql = "SELECT nrc, name, father, address, birthday, position, startdate, salary, gender, phone, email FROM employy WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Fetch the data
                    $row = $result->fetch_assoc();
                    // Close the prepared statement
                    $stmt->close();
                } else {
                    echo "No data found for the provided ID.";
                    exit(); // Terminate script execution
                }

                // Close the database connection
                $conn->close();
            } else {
                echo "ID parameter is missing or empty.";
                exit(); // Terminate script execution
            }
            ?>

                



            <div class="card-body">
            <form method="POST" action="update_employy.php">
                    <div class="row">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nrc">Nrc</label>
                                        
                                        <input type="text" class="form-control image-file bg-transparent text-white" name="nrc" value="<?php echo $row['nrc']; ?>"required>       
                                    </div> 
                                </div>  

                                <div class="col-md-6">                      
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" class="form-control bg-transparent text-white" placeholder="Enter Name" name="name" value="<?php echo $row['name']; ?>" required>
                                        
                                    </div>
                                </div>  
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="father">Father Name *</label>
                                        <input type="text" class="form-control bg-transparent text-white" placeholder="Enter Father Name" name="father" value="<?php echo $row['father']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">                      
                                    <div class="form-group">
                                        <label for="address">Address *</label>
                                        <input type="text" class="form-control bg-transparent text-white" placeholder="Enter address" name="address" value="<?php echo $row['address']; ?>">
                                        
                                    </div>
                                </div>  
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday">Birthday *</label>
                                        <input type="date" class="form-control calendar bg-ash bg-transparent text-white" name="birthday" value="<?php echo $row['birthday']; ?>">
                                       
                                    </div>
                                </div>

                                <div class="col-md-6">                      
                                    <div class="form-group">
                                        <label for="position">အလုပ်အကိုင်/ရာထူး</label>
                                        <select class="selectpicker form-control bg-transparent text-white" name="position" id="position" data-style="py-0" value="<?php echo $row['position']; ?>">
                                            <option value="exclusive">Exclusive</option>
                                            <option value="inclusive">Inclusive</option>
                                        </select>
                                    </div>
                                </div>  
  
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="startdate">StartDate *</label>
                                        <input type="date" class="form-control calendar bg-ash bg-transparent text-white" name="startdate" value="<?php echo $row['startdate']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">                      
                                    <div class="form-group">
                                        <label for="salary">Salary *</label>
                                        <input type="text" class="form-control bg-transparent text-white" placeholder="လစာ" name="salary" value="<?php echo $row['salary']; ?>">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>  
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="selectpicker form-control bg-transparent text-white" name="gender" id="gender" data-style="py-0" value="<?php echo $row['gender']; ?>">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone *</label>
                                        <input type="mail" class="form-control bg-transparent text-white" placeholder="ဖုန်းနံပတ်" name="phone" value="<?php echo $row['phone']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="mail" class="form-control bg-transparent text-white" placeholder="email" name="email" value="<?php echo $row['email']; ?>">
                                    </div>
                                </div>


                            </div>                            
                            <button type="submit" class="btn btn-primary mr-2">Update</button>

                        </form>
                </div>
      </div>