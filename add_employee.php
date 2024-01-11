<?php 
require_once('header.php');
?>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">            
            <h1 class="h3 mb-2 text-gray-800">Add Employee Details</h1>
          </div>
            <form method="post" class="emp_form">
                    <?php msg(); ?>
                <!-- profile tab -->
                <div class="tab">
                <div style="max-width:780px" class="card shadow mb-4">
                
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employee profile</h6>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                    <label>Firstname</label>
                    <p ><input type="text" name="emp_firstname" id="emp_firstname" class="form-control" placeholder="First name" required></p>
                    </div>
                    <div class="form-group">
                    <label>Lastname</label>
                    <p><input type="text" name="emp_lastname" id="emp_lastname" class="form-control" placeholder="Last name" required></p>
                    </div>
                    <div class="form-group">
                    <label>Other names</label>
                    <p><input type="text" name="emp_othernames" id="emp_othernames"class="form-control" placeholder="Other name" ></p>
                    </div>
                    <div class="form-group">
                    <label>Phone number</label>
                    <p><input type="tel" name="emp_phone" id="emp_phone" class="form-control" placeholder="Phone number" required></p>
                    </div>
                    <div class="form-group">
                    <label>Contact Address</label>
                    <p><input type="text" name="emp_adr" id="emp_adr" class="form-control" placeholder="Address" required></p>
                    </div>
                    <div class="form-group">
                    <label>Date of Birth</label>
                    <!-- <p><input type="date" name="emp_dob" class="form-control" placeholder="Date of birth" required></p> -->
                    <div class="datepicker input-group date" data-date-format="dd-mm-yyyy" data-provide="datepicker" id="datepicker">
                        <input type="text" name="emp_dob" id="emp_dob" class="form-control" placeholder="dd-mm-yyyy" required>
                        <div class="input-group-append">
                        <button type="button" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <label>Gender</label>
                    <p><select name="emp_gender" id="emp_gender" class="custom-select form-control" required>
                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select></p>
                    </div>

                    <div class="form-group">
                    <label>Marital status</label>
                    <p><select name="emp_marital_status" id="emp_marital_status" class="custom-select form-control" required>
                        <option value="">Select</option>
                        <option value="Married">Married</option>
                        <option value="Single">Single</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
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
                        <option value="<?php echo $row['state_id']; ?>"><?php echo $row['name']; ?></option>

                        <?php } ?>
                    </select></p>
                    </div>

                    <div class="form-group">
                    <label>LGA of origin</label>
                    <p><select name="emp_origin_lga" id="lga" class="custom-select form-control" required>
                        <option>Select LGA</option>
                        
                    </select></p>
                    </div>
                </div>   
                </div>
                </div>
                <!-- employment information -->
                <div class="tab">
                <div class="card shadow mb-4">
                
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employment Information</h6>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
                    <label>Date of Employment</label>
                    <!-- <p><input type="date" name="emp_appt_date" class="form-control" placeholder="Employment date" required></p> -->
                    <div class="datepicker input-group date" data-date-format="dd-mm-yyyy" data-provide="datepicker" id="datepicker">
                        <input type="text" name="emp_appt_date" id="emp_appt_date" class="form-control" placeholder="dd-mm-yyyy"  required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label>Date of Last Promotion</label>
                    <div class="datepicker input-group date" data-date-format="dd-mm-yyyy" data-provide="datepicker" >
                        <input type="text" name="emp_last_promo_date" id="emp_last_promo_date" class="form-control" placeholder="dd-mm-yyyy" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <label>Ministry</label>
                    <p><select name="emp_ministry" id="emp_ministry" class="custom-select form-control" required>
                        <option value="">Select Ministry</option>
                        <option value="Finance">Finance</option>
                        <option value="Works">Works</option>
                    </select></p>
                    </div>
                    <div class="form-group">
                    <label>Department</label>
                    <p><select name="emp_dept" id="emp_dept" class="custom-select form-control" required>
                        <option value="">Select Department</option>
                        <option value="dept 1">Dept 1</option>
                        <option value="dept 2">Dept 2</option>
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
                        <option value="<?php echo $row['id']; ?>"><?php echo 'GL-'.$row['grade_level']; ?></option>
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
                    </div>
                </div>    
                </div>
                <!-- academic qualification -->
                <div class="tab">
                <div class="card shadow mb-4">
                
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Academic Qualification</h6>
                    </div>
                    <div class="card-body">
                    <table class="table table-borderless" >
                        <tr>
                            <th>Qual. Type</th>
                            <th>Cert. Obtained</th>
                            <th>Institution</th>
                            <th>Year Obtained</th>
                            <th>Highest(Check yes for highest qualification)</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <p class="form-group">
                                    <select name="emp_qual_type" id="emp_qual_type" class="custom-select form-control">
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
                                <input type="button" name="send" class="btn btn-primary" value="Add" id="butsend">
                            </td>
                        </tr>
                    </table>

                    <table id="table1" name="table1" class="table ">
                        <tbody>
                        <tr>
                            <th>Qual. Type</th>
                            <th>Cert. Obtained</th>
                            <th>Institution</th>
                            <th>Year Obtained</th>
                            <th>Highest(Check yes for highest qualification)</th>
                            <th></th>
                        <tr>
                        </tbody>
                    </table>
                    </div>
                </div>   
                </div>
                
                <div style="overflow:auto;">
                    <div style="float:right;">
                    <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    <input type="button" name="save" class="btn btn-primary" data-toggle="modal" data-target="" value="Save" id="saveEmpDetails">
                    </div>
                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>
					
                    <div class="modal-body">
                       
						<div class="thank-you-pop">
							<img src="assets/images/Green-Round-Tick.png" alt="">
							<h1>Registeration Successful!</h1>
							<p>You have successfully registered the employee</p>
							
							
 						</div>
                         
                    </div>
					
                </div>
            </div>
        </div>
          
<?php require_once('footer.php'); ?>

<!-- <div style="margin: auto;width: 60%;">
<form id="form1" name="form1" method="post">
<div class="form-group">
<label for="email">Student Name:</label>
<input type="text" name="sname" class="form-control" id="name">
</div>
<div class="form-group">
<label for="pwd">Student email:</label>
<input type="text" name="email" class="form-control" id="email">
</div>

</form>

</div> -->
