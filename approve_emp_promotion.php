<?php 
require_once('header.php');
?>
<?php 
if (isset($_POST['approveAll'])) {
    $sql="SELECT * FROM `emp_promotion` WHERE Approved = 0";
    mysqli_query($conn,$sql);
    $num_rows = mysqli_affected_rows($conn);

    if ($num_rows > 0){
    $employees = $_POST['empIdAll'];
    $newGrades = $_POST['newGrade'];
    $promoDates = $_POST['promoDate'];
    $count_p = count($_POST['employeeId']);
    $sql ="UPDATE `emp_promotion` 
    SET approved = 1 WHERE approved = 0
    ";
    if (mysqli_query($conn, $sql) == true){
        for($k=0;$k<$count_p; $k++){
            
            $sql_upd ="UPDATE `emp_employment_info` 
            SET salary_grade = '$newGrades[$k]', 
            last_promo_date ='$promoDates[$k]' WHERE emp_id ='$employees[$k]' ";
            if (mysqli_query($conn, $sql_upd) == true){
                $msg_success ="You have successfully approved all promotions for 2019";
                
            }
        }
    }

    }else{ $msg = 'No unapproved promotions';}
}

if (isset($_POST['approveSelected'])) {
    $sql="SELECT * FROM `emp_promotion` WHERE Approved = 0";
    $result = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0){
        $employees = $_POST['employeeId'];
        $newGrades = $_POST['newGrade'];
        $promoDates = $_POST['promoDate'];
        $count_p = count($_POST['employeeId']);
    if (!empty($employees)){
        foreach($employees As $employee){
        $sql ="UPDATE `emp_promotion` 
        SET approved = 1 WHERE emp_id ='$employee' AND approved = 0
        ";
        if (mysqli_query($conn, $sql) == true){
            for($k=0;$k<$count_p; $k++){
            
                $sql_upd ="UPDATE `emp_employment_info` 
                SET salary_grade = '$newGrades[$k]', 
                last_promo_date ='$promoDates[$k]' WHERE emp_id ='$employees[$k]' ";
                if (mysqli_query($conn, $sql_upd) == true){
                $msg_success ="You have successfully approved promotions for 2019 for ".$count_p." employees";
                }
            }
        } else{ $msg = 'error communicating to database';}
    }
    }else{ $msg = 'Please select item to approve';}
    
} else{ $msg = 'No unapproved promotions';}
    }
?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage promotions approval</h1>
        </div> 
        <div class="card shadow mb-4"> 
            <form method="post">
            <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Promotion list</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($msg)){?>    
                    <p class="alert alert-warning alert-dismissable fade show" style="font-size:12px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $msg; ?>
                    </p>
                    <?php } ?>
                    <?php if (!empty($msg_success)){?>
                    <p class="alert alert-success alert-dismissable fade show" style="font-size:12px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $msg_success; ?>
                    </p>
                    <?php } ?>
                <div class="d-sm-flex align-items-left justify-content-start mb-4">
                    <input type="submit" class="btn btn-primary mr-5" name="approveAll" value="Approve all" onclick="return confirmApproveAll()" >  <input type="submit" class="btn btn-primary " name="approveSelected" value="Approve selected" onclick="return confirmApproveSelected()">
                </div>  
              <div class="table-responsive">      
              <table class="table table-striped uppertext" id="dataTable">

                    <thead >
                        <th><input type="checkbox" name="checkall" id="checkall" onClick="check_unchecked(this.checked);" /></th>
                        <th>Employee Id</th>
                        <th>Name</th>
                        <th>Previous Salary Grade</th>
                        <th>New Salary Grade</th>
                        <th>Gender</th>                        
                        <th>Ministry</th>
                        <th>Department</th>
                        <th>Employment date</th>
                        <th>Last Promotion date</th>
                        <th>Current Promotion date</th>
                        <th>Status</th>
                                    
                    </thead>
                    <tbody>

                        <?php 
                            
                            $sql = "SELECT *, (`emp_promotion`.`emp_id`) As p_emp_id, (`emp_salary_grade`.`id`) As new_grade_id
                            FROM `emp_promotion` 
                            Left join `emp_profile` ON `emp_promotion`.`emp_id`=`emp_profile`.`id` 
                            Left join `emp_employment_info` ON `emp_promotion`.`emp_id`=`emp_employment_info`.`emp_id` 
                            Left join `states` ON `emp_profile`.`state`=`states`.`state_id` 
                            Left join `locals` ON `emp_profile`.`lga`=`locals`.`local_id`
                            LEFT JOIN `emp_salary_grade` ON `emp_promotion`.`emp_new_grade`=`emp_salary_grade`.`grade_level` 
                            WHERE approved = 0
                            ";
                            $result = mysqli_query($conn, $sql);
    
                            $count = mysqli_affected_rows($conn);
                            if ($count > 0){
                            
                                $i = 1;
                            while ($row = mysqli_fetch_assoc($result)){
                                $sql = "SELECT `name` FROM `emp_rank` WHERE id = ".$row['rank_id'] ;
                                $sql1 = "SELECT `cert_obtained` FROM `emp_academic_info` WHERE emp_id = ".$row['p_emp_id'] ;
                                $emp_id = $row['p_emp_id'];
                        ?>
                            <tr>
                                <td>
                                    <div class="form-group">
                                    <input type="checkbox" id="employee" name="employeeId[]" value="<?php echo $row['emp_id']; ?>" class="form-control"  >
                                    <input type="hidden" name="empIdAll[]" value="<?php echo $row['emp_id']; ?>">
                                    <input type="hidden" name="promoDate[]" value="<?php echo $row['notional_date']; ?>">
                                    <input type="hidden" name="newGrade[]" value="<?php echo $row['new_grade_id']; ?>">
                                </div>
                                </td>
                                
                                <td><?php echo $row['emp_id']; ?></td>
                                <td><?php echo $row['lastname'] ." ".$row['firstname'] ." ".$row['othername']; ?></td>
                                <td><?php echo $row['prev_grade']; ?></td>
                                <td><?php echo $row['emp_new_grade']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['ministry']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo $row['employment_date']; ?></td>
                                <td><?php echo $row['last_promo_date']; ?></td>
                                <td><?php echo $row['notional_date']; ?></td>
                                <td><?php if ($row['approved']==0) {echo 'Unapproved';}else{echo 'Approved';} ?></td>

                                <!-- <td><?php     
                                    // $res = mysqli_query($conn,$sql);

                                    // while($row = mysqli_fetch_assoc($res)){
                                
                                    //     echo $row['name'];
                                        
                                    //  } ?></td>

                                <td><?php 
                                //     $res1 = mysqli_query($conn,$sql1);
                                //     while ($row1 = mysqli_fetch_assoc($res1)){
                                
                                //  echo $row1['cert_obtained'].",";
                                //     } ?>
                                </td> -->

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
        </form>
        </div>
<?php require_once('footer.php'); ?>