<?php 
require_once('header.php');
?>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">            
                <h1 class="h3 mb-0 text-gray-800">Manage employees</h1>
                <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="<?=$base_path?>/add_employee.php"><i class='fas fa-plus fa-sm text-white-50'></i> Add Employee</a>
            </div>
            <div  class="card shadow mb-4">
                    <?php msg(); ?>
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employee lists</h6>
                </div>
              <div class="card-body">
              <div class="table-responsive">      
              <table class="table table-bordered uppertext" id="dataTable" width="100%" cellspacing="0">

                    <thead >
                        <th>Action</th>
                        <th>S/n</th>
                        <th>Employee Id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Address</th>
                        <th>Gender</th>                        
                        <th>State</th>
                        <th>Lga</th>
                        <th>Ministry</th>
                        <th>Department</th>
                        <th>Employment date</th>
                        <th>Last Promotion date</th>
                        <th>Salary grade</th>
                        <th>Rank</th>
                        <th>Qualification</th>                        
                    </thead>
                    <tbody>

                        <?php 
                            
                            $sql = "SELECT *, (`emp_profile`.`id`) As emp_id
                            FROM `emp_profile` 
                            Left join `emp_employment_info` ON `emp_profile`.`id`=`emp_employment_info`.`emp_id` 
                            Left join `states` ON `emp_profile`.`state`=`states`.`state_id` 
                            Left join `locals` ON `emp_profile`.`lga`=`locals`.`local_id`
                            LEFT JOIN `emp_salary_grade` ON `emp_employment_info`.`salary_grade`=`emp_salary_grade`.`id` 
                            ";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count > 0){
                            
                                $i = 1;
                            while ($row = mysqli_fetch_assoc($result)){
                                $sql = "SELECT `name` FROM `emp_rank` WHERE id = ".$row['rank_id'] ;
                                $sql1 = "SELECT `cert_obtained` FROM `emp_academic_info` WHERE emp_id = ".$row['emp_id'] ;
                                $emp_id = $row['emp_id'];
                        ?>
                            <tr>
                                <td>
                                    <a class="text-outline-primary" href="<?=$base_path?>/edit_emp_info.php?employee_id=<?php echo $emp_id ?>"><i class="fa fa-edit"></i></a> | <a target="_blank" href="emp-preview.php?employee_id=<?php echo $emp_id; ?>" class="text-primary"><i class="fa fa-eye"></i></a>
                                </td>
                                <td><?php echo $i;
                                $i++;
                                ?></td>
                                <td><?php echo $row['emp_id']; ?></td>
                                <td><?php echo $row['lastname'] ." ".$row['firstname'] ." ".$row['othername']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['date_of_birth']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['local_name']; ?></td>
                                <td><?php echo $row['ministry']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo $row['employment_date']; ?></td>
                                <td><?php echo $row['last_promo_date']; ?></td>
                                <td><?php echo $row['grade_level']; ?></td>
                                <td><?php     
                                    $res = mysqli_query($conn,$sql);

                                    while($row = mysqli_fetch_assoc($res)){
                                
                                        echo $row['name'];
                                        
                                     } ?></td>

                                <td><?php 
                                    $res1 = mysqli_query($conn,$sql1);
                                    while ($row1 = mysqli_fetch_assoc($res1)){
                                
                                 echo $row1['cert_obtained'].",";
                                    } ?>
                                </td>

                            </tr>
                        <?php 
                            }
                       
                        }else {
                            echo "<tr><td colspan='15'>No record</td></tr>";
                        }
                        ?>
                    </tbody>
              </table>
              </div>
              </div>
            </div>
<?php require_once('footer.php'); ?>

