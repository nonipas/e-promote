<?php 
require_once('header.php');
?>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">            
            <h1 class="h3 mb-2 text-gray-800">Update Employee Details</h1>
          </div>
          <?php 
          if (isset($_GET['employee_id'])){ 
          $employee_id = $_GET['employee_id'];    
         ?>
            <form method="post" class="emp_form">
                    <?php msg(); ?>
               
                <div class="card shadow mb-4">
                <?php 
                $sql_profile ="SELECT * FROM `emp_profile` WHERE id = $employee_id";
                $res_profile = mysqli_query($conn, $sql_profile);
                while ($row_profile = mysqli_fetch_assoc($res_profile)) {
                ?>
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employee profile</h6>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                    <label>Firstname</label>
                    <p ><input type="text" value="<?php echo $row_profile['firstname'] ?>" name="emp_firstname" id="emp_firstname" class="form-control" placeholder="First name" required></p>
                    </div>
                    <div class="form-group"> 
                    <label>Lastname</label>
                    <p><input type="text" value="<?php echo $row_profile['lastname'] ?>" name="emp_lastname" id="emp_lastname" class="form-control" placeholder="Last name" required></p>
                    </div>
                    <div class="form-group">
                    <label>Other names</label>
                    <p><input type="text" value="<?php echo $row_profile['othername'] ?>" name="emp_othernames" id="emp_othernames"class="form-control" placeholder="Other name" ></p>
                    </div>
                    <div class="form-group">
                    <label>Phone number</label>
                    <p><input type="tel" value="<?php echo $row_profile['phone'] ?>" name="emp_phone" id="emp_phone" class="form-control" placeholder="Phone number" required></p>
                    </div>
                    <div class="form-group">
                    <label>Contact Address</label>
                    <p><input type="text" value="<?php echo $row_profile['address'] ?>" name="emp_adr" id="emp_adr" class="form-control" placeholder="Address" required></p>
                    </div>
                    <div class="form-group">
                    <label>Date of Birth</label>
                    <!-- <p><input type="date" name="emp_dob" class="form-control" placeholder="Date of birth" required></p> -->
                    <div class="datepicker input-group date" data-date-format="dd-mm-yyyy" data-provide="datepicker" id="datepicker">
                        <input type="text" value="<?php echo $row_profile['date_of_birth'] ?>" name="emp_dob" id="emp_dob" class="form-control" placeholder="dd-mm-yyyy" required>
                        <div class="input-group-append">
                        <button type="button" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <label>Gender</label>
                    <p><select name="emp_gender" id="emp_gender" class="custom-select form-control" required>
                        <option value="">Select gender</option>
                        <option value="male" <?php if($row_profile['gender'] =='male'){echo 'Selected';} ?>>Male</option>
                        <option value="female" <?php if($row_profile['gender'] =='female'){echo 'Selected';} ?>>Female</option>
                    </select></p>
                    </div>

                    <div class="form-group">
                    <label>Marital status</label>
                    <p><select name="emp_marital_status" id="emp_marital_status" class="custom-select form-control" required>
                        <option value="">Select</option>
                        <option value="Married" <?php if($row_profile['marital_status'] =='Married'){echo 'Selected';} ?>>Married</option>
                        <option value="Single" <?php if($row_profile['marital_status'] =='Single'){echo 'Selected';} ?>>Single</option>
                        <option value="Divorced" <?php if($row_profile['marital_status'] =='Divorced'){echo 'Selected';} ?>>Divorced</option>
                        <option value="Widowed" <?php if($row_profile['marital_status'] =='Widowed'){echo 'Selected';} ?>>Widowed</option>
                    </select></p>
                    </div>

                    <div class="form-group">
                    <label>State of origin</label>
                    <p><select name="emp_origin_state" class="custom-select form-control" id="state" onchange="getLga(this.value)" required>
                        <option>Select state</option>
                        <?php 
                            $sql ="SELECT * FROM `states`";
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) { 
                        ?>
                        <option value="<?php echo $row['state_id']; ?>" <?php if($row_profile['state'] ==$row['state_id']){echo 'Selected';} ?>><?php echo $row['name']; ?></option>

                        <?php } ?>
                    </select></p>
                    </div>

                    <div class="form-group">
                    <label>LGA of origin</label>
                    <p><select name="emp_origin_lga" id="lga" class="custom-select form-control" required>
                        <option>Select LGA</option>
                        
                    </select></p>
                    </div>
                    <input type="button" name="UpdateEmpProfile" value="Update" class="btn btn-primary" >
                </div>   
                </div>
                            <?php } ?>
                <!-- employment information -->
                
                <div class="card shadow mb-4">
                <?php 
                $sql_info ="SELECT * FROM `emp_employment_info` WHERE emp_id = $employee_id";
                $res_info = mysqli_query($conn, $sql_info);
                while ($row_info = mysqli_fetch_assoc($res_info)) {
                ?>
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employment Information</h6>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                    <label>Date of Employment</label>
                    <!-- <p><input type="date" name="emp_appt_date" class="form-control" placeholder="Employment date" required></p> -->
                    <div class="datepicker input-group date" data-date-format="dd-mm-yyyy" data-provide="datepicker" id="datepicker">
                        <input type="text" value="<?php echo $row_info['employment_date'] ?>" name="emp_appt_date" id="emp_appt_date" class="form-control" placeholder="dd-mm-yyyy"  required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label>Date of Last Promotion</label>
                    <div class="datepicker input-group date" data-date-format="dd-mm-yyyy" data-provide="datepicker" >
                        <input type="text" <?php echo $row_info['last_promo_date'] ?> name="emp_last_promo_date" id="emp_last_promo_date" class="form-control" placeholder="dd-mm-yyyy" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <label>Ministry</label>
                    <p><select name="emp_ministry" id="emp_ministry" class="custom-select form-control" required>
                        <option value="">Select Ministry</option>
                        <option value="Finance" <?php if($row_info['ministry'] =='Finance'){echo 'Selected';} ?>>Finance</option>
                        <option value="Works" <?php if($row_info['ministry'] =='Works'){echo 'Selected';} ?>>Works</option>
                    </select></p>
                    </div>
                    <div class="form-group">
                    <label>Department</label>
                    <p><select name="emp_dept" id="emp_dept" class="custom-select form-control" required>
                        <option value="">Select Department</option>
                        <option value="dept 1" <?php if($row_info['department'] =='dept 1'){echo 'Selected';} ?>>Dept 1</option>
                        <option value="dept 2" <?php if($row_info['department'] =='dept 2'){echo 'Selected';} ?>>Dept 2</option>
                    </select></p>
                    </div>

                    <div class="form-group">
                    <label>Grade Level</label>
                    <p><select name="emp_grade" id="emp_grade" class="custom-select form-control" required>
                        <option value="">Select grade</option>
                        <?php 
                            $sql ="SELECT * FROM `emp_salary_grade`";
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) { 
                        ?>
                        <option value="<?php echo $row['id']; ?>" <?php if($row_info['salary_grade'] ==$row['id']){echo 'Selected';} ?>><?php echo 'GL-'.$row['grade_level']; ?></option>
                        <?php 
                            }
                        ?>

                    </select></p>
                    </div>
                    <div class="form-group">
                    <label>Rank</label>
                    <p><select name="emp_rank" id="emp_rank" class="custom-select form-control" required>
                        <option>Select rank</option>
                        <?php 
                            $sql ="SELECT * FROM `emp_rank`";
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) { 
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php 
                            }
                        ?>
                    </select></p>
                    </div>
                    <input type="button" name="UpdateEmpInfo" value="Update" class="btn btn-primary" >
                    </div>
                    <?php } ?>
                </div>    
                        
                <!-- academic qualification -->
            
                <div class="card shadow mb-4">
                
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Academic Qualification</h6>
                    </div>
                    <div class="card-body">
                    <table class="table table-borderless table-responsive" >
                        <tr>
                            <th>Qual. Type</th>
                            <th>Cert. Obtained</th>
                            <th>Institution</th>
                            <th>Year Obtained</th>
                            <th>Highest(Select yes for highest qualification)</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <p class="form-group">
                                    <select style="size: 50px" name="emp_qual_type" id="emp_qual_type" class="custom-select form-control">
                                        <option value="">Select type</option>
                                        <option value="500">Higher Degree</option>
                                        <option value="400">Lower Degree</option>
                                        <option value="300">Promotion Cert.</option>
                                        <option value="200">SSCE</option>
                                        <option value="100">Primary</option>
                                    </select>
                                </p>
                            </td>
                            <td>
                                <p class="form-group">
                                    <input type="text" name="emp_certificate" id="emp_certificate" class="form-control" placeholder="Certificate obtained">
                                </p>
                            </td>
                            <td>
                                <p class="form-group">
                                    <input type="text" name="emp_institution" id="emp_institution" class="form-control" placeholder="Name of Institution">
                                </p>
                            </td>
                            <td>
                                <p class="form-group">
                                    <input type="text" name="emp_cert_year" id="emp_cert_year" class="form-control" placeholder="Year obtained">
                                </p>
                            </td>
                            <td>
                                
                               <p class="form-group">
                                    <select name="emp_highest_qual" id="emp_highest_qual" class="custom-select form-control">
                                        
                                        <option value="Yes">Yes</option>
                                        <option value="No" selected>No</option>
                                    </select>
                                </p>
                            </td>
                            <td>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input type="button" name="addQual" class="btn btn-primary" value="Add" >
                            </td>
                        </tr>
                    </table>

                    <table id="table1" name="table1" class="table table-responsive ">
                        <thead>
                        <tr>
                            <th>Qual. Type</th>
                            <th>Cert. Obtained</th>
                            <th>Institution</th>
                            <th>Year Obtained</th>
                            <th>Highest qualification</th>
                            <th>Action</th>
                        <tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query="SELECT * FROM emp_academic_info WHERE emp_id = $employee_id ";
                                $result = mysqli_query($conn,$query);
                                while($row = mysqli_fetch_array($result)){
                                    
                                
                            ?>
                            <tr>
                                <td><?php echo $row['type'] ?></td>
                                <td><?php echo $row['cert_obtained'] ?></td>
                                <td><?php echo $row['institution'] ?></td>
                                <td><?php echo $row['year_obtained'] ?></td>
                                <td><?php if( $row['highest_qualification'] ==0){ echo 'No';}else{echo 'Yes';} ?></td>
                                <td> 
                                <input type="button" name="save" class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $row['id'];  ?>" value="Edit" >
                                </td>
                            <tr>
                            <div class="modal fade" id="myModal-<?php echo $row['id']; ?>" role="dialog">
            <div class="modal-dialog">
                <div class="card shadow mb-4 modal-content">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Academic Qualification

                            <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                            </h6> 
                    </div>
                    <div class="card-body modal-body">
                       
						<div class="thank-you-pop">
                        <p class="form-group">
                                 <label>Qual. Type</label>
                                    <select name="emp_qual_type" id="emp_qual_type" class="custom-select form-control">
                                        <option value="">Select type</option>
                                        <option value="500" <?php if($row['type']==500){echo 'selected';} ?>>Higher Degree</option>
                                        <option value="400" <?php if($row['type']==400){echo 'selected';} ?>>Lower Degree</option>
                                        <option value="300" <?php if($row['type']==300){echo 'selected';} ?>>Promotion Cert.</option>
                                        <option value="200" <?php if($row['type']==200){echo 'selected';} ?>>SSCE</option>
                                        <option value="100" <?php if($row['type']==100){echo 'selected';} ?>>Primary</option>
                                    </select>
                                </p>
                                                        
                                <p class="form-group">
                                 <label>Cert. Obtained</label>
                                    <input type="text" name="emp_certificate" id="emp_certificate" class="form-control" placeholder="Certificate obtained">
                                </p>
                            
                            
                                <p class="form-group">
                                <label>Institution</label>

                                    <input type="text" name="emp_institution" id="emp_institution" class="form-control" placeholder="Name of Institution">
                                </p>
                            
                            
                                <p class="form-group">
                                <label>Year Obtained</label>

                                    <input type="text" name="emp_cert_year" id="emp_cert_year" class="form-control" placeholder="Year obtained">
                                </p>
  
                               <p class="form-group">
                                <lable>Highest qualification?</label>

                                    <select name="emp_highest_qual" id="emp_highest_qual" class="custom-select form-control">
                                        
                                        <option value="Yes">Yes</option>
                                        <option value="No" selected>No</option>
                                    </select>
                                </p>
                                                  
                                <input type="button" name="updateQual" class="btn btn-primary" value="update" >
							
							
 						</div>
                         
                    </div>
					
                </div>
            </div>
                                <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>   
                </div>
                
                <!-- <div style="overflow:auto;">
                    <div style="float:right;">
                    <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    <input type="button" name="save" class="btn btn-primary" data-toggle="modal" data-target="" value="Save" id="saveEmpDetails">
                    </div>
                </div>
                Circles which indicates the steps of the form: 
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div> -->
            </form>
            
        
          
                <?php }else{ ?>
                    <div class="card shadow mb-4">
                
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Access disallowed!</h6>
                    </div>
                    <div class="card-body">
                        <p>No Employee selected. Go to <a href="<?=$base_path?>/emp_list.php">Employee List</a></p>
                    </div>
                    </div>
                <?php } require_once('footer.php'); ?>

