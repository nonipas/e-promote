
<?php require_once('header.php'); ?>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Promotion</h1>
        </div>

            <?php
$msg = '';
$total = "";
$count_0 = "";
if (isset($_GET['generate'])) { //generate is triggered
    $grade = $_GET['emp_grade'];
    $ministry = $_GET['emp_ministry'];
    $dept = $_GET['emp_dept'];
    $promo_fin_date = date_create($_GET['emp_promo_fin_date']);
    $promo_not_date = date_create($_GET['emp_promo_not_date']);
    $year = date_create($_GET['emp_prom_yr'] . "/05/05");
    $fin_date = date_format($promo_fin_date, 'Y-m-d');
    $not_date = date_format($promo_not_date, 'Y-m-d');
    $prom_yr = date_format($year, 'Y');
    $new_grade = "";

    if ($grade != "" & $ministry != "" & $dept != "") { //generates if any is selected
        $query = "SELECT * FROM `emp_promotion`
            Left join `emp_employment_info` ON `emp_promotion`.`emp_id`=`emp_employment_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_promotion`.`prev_grade`=`emp_salary_grade`.`grade_level`
            WHERE `emp_salary_grade`.`id`='$grade'
            AND `emp_employment_info`.`ministry`='$ministry' 
            AND `emp_employment_info`.`department`='$dept' 
            AND  `emp_promotion`.`prom_year` = '$prom_yr'";
        $res = mysqli_query($conn, $query);
        $count = mysqli_num_rows($res);

        $check = mysqli_fetch_assoc($res);
        if ($count > 0 && $check['approved'] == 1) {
            $msg = 'Approved promotion for the ' . $prom_yr . ' already exists for the selected employees';
        } elseif ($count > 0 && $check['approved'] == 0) {

            $msg = 'Pending promotions exists for the selected employees for the year ' . $prom_yr . ' : Go to approve promotions page';
        } else {

            $sql = "SELECT * 
                    FROM `emp_employment_info` 
                    Left join `emp_academic_info` ON `emp_employment_info`.`emp_id`=`emp_academic_info`.`emp_id`
                    Left join `emp_salary_grade` ON `emp_employment_info`.`salary_grade`=`emp_salary_grade`.`id` 
                    WHERE ($prom_yr - YEAR(`emp_employment_info`.`last_promo_date`)) >= 3 
                    AND (`emp_employment_info`.`salary_grade`='$grade' 
                    AND `emp_employment_info`.`ministry`='$ministry' 
                    AND `emp_employment_info`.`department`='$dept') 
                    AND `emp_academic_info`.`highest_qualification`= 1 ";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);
        }
    } elseif ($grade != "" & $ministry != "") { //generates if grade & ministry are selected

        $query = "SELECT * FROM `emp_promotion`
            Left join `emp_employment_info` ON `emp_promotion`.`emp_id`=`emp_employment_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_promotion`.`prev_grade`=`emp_salary_grade`.`grade_level`
            WHERE `emp_salary_grade`.`id`='$grade'
            AND `emp_employment_info`.`ministry`='$ministry' 
            AND  `emp_promotion`.`prom_year` = '$prom_yr'";
        $res = mysqli_query($conn, $query);
        $count = mysqli_num_rows($res);

        $check = mysqli_fetch_assoc($res);
        if ($count > 0 && $check['approved'] == 1) {
            $msg = 'Approved promotion for the ' . $prom_yr . ' already exists for the selected employees';
        } elseif ($count > 0 && $check['approved'] == 0) {

            $msg = 'Pending promotions exists for the selected employees for the year ' . $prom_yr . ' : Go to approve promotions page';
        } else {

            $sql = "SELECT * 
            FROM `emp_employment_info` 
            Left join `emp_academic_info` ON `emp_employment_info`.`emp_id`=`emp_academic_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_employment_info`.`salary_grade`=`emp_salary_grade`.`id` 
            WHERE ($prom_yr - YEAR(`emp_employment_info`.`last_promo_date`)) >= 2 
            AND `emp_employment_info`.`salary_grade`='$grade' 
            AND `emp_employment_info`.`ministry`='$ministry'  
            AND `emp_academic_info`.`highest_qualification`= 1";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);
        }
    } elseif ($grade != "" & $dept != "") {

        $query = "SELECT COUNT(*) FROM `emp_promotion`
            Left join `emp_employment_info` ON `emp_promotion`.`emp_id` =`emp_employment_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_promotion`.`prev_grade`=`emp_salary_grade`.`grade_level`
            WHERE `emp_salary_grade`.`id`='$grade'
            AND `emp_employment_info`.`department`='$dept' 
            AND `emp_promotion`.`prom_year` = '$prom_yr'";
        $res = mysqli_query($conn, $query);
        $count = mysqli_num_rows($res);

        $check = mysqli_fetch_assoc($res);
        if ($count > 0 && $check['approved'] == 1) {
            $msg = 'Approved promotion for the ' . $prom_yr . ' already exists for the selected employees';
        } elseif ($count > 0 && $check['approved'] == 0) {

            $msg = 'Pending promotions exists for the selected employees for the year ' . $prom_yr . ' : Go to approve promotions page';
        } else {

            $sql = "SELECT * 
            FROM `emp_employment_info` 
            Left join `emp_academic_info` ON `emp_employment_info`.`emp_id`=`emp_academic_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_employment_info`.`salary_grade`=`emp_salary_grade`.`id` 
            WHERE ($prom_yr - YEAR(`emp_employment_info`.`last_promo_date`)) >= 2 
            AND (`emp_employment_info`.`salary_grade`='$grade'  
            AND `emp_employment_info`.`department`='$dept') 
            AND `emp_academic_info`.`highest_qualification`= 1";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);
        }
    } elseif ($ministry != "" & $dept != "") {
        $query = "SELECT * FROM `emp_promotion`
            Left join `emp_employment_info` ON `emp_promotion`.`emp_id` =`emp_employment_info`.`emp_id`
            AND `emp_employment_info`.`ministry`='$ministry' 
            AND `emp_employment_info`.`department`='$dept' 
            AND  `emp_promotion`.`prom_year` = '$prom_yr'";
        $res = mysqli_query($conn, $query);
        $count = mysqli_num_rows($res);

        $check = mysqli_fetch_assoc($res);
        if ($count > 0 && $check['approved'] == 1) {
            $msg = 'Approved promotion for the ' . $prom_yr . ' already exists for the selected employees';
        } elseif ($count > 0 && $check['approved'] == 0) {

            $msg = 'Pending promotions exists for the selected employees for the year ' . $prom_yr . ' : Go to approve promotions page';
        } else {

            $sql = "SELECT * 
            FROM `emp_employment_info` 
            Left join `emp_academic_info` ON `emp_employment_info`.`emp_id`=`emp_academic_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_employment_info`.`salary_grade`=`emp_salary_grade`.`id` 
            WHERE ($prom_yr - YEAR(`emp_employment_info`.`last_promo_date`)) >= 2 
            AND (`emp_employment_info`.`ministry`='$ministry' 
            AND `emp_employment_info`.`department`='$dept') 
            AND `emp_academic_info`.`highest_qualification`= 1";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);
        }
    } elseif ($grade != "" || $ministry != "" || $dept != "") {
        $query = "SELECT * FROM `emp_promotion`
            Left join `emp_employment_info` ON `emp_promotion`.`emp_id`=`emp_employment_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_promotion`.`prev_grade`=`emp_salary_grade`.`grade_level`
            WHERE (`emp_salary_grade`.`id`='$grade'
            or `emp_employment_info`.`ministry`='$ministry' 
            or `emp_employment_info`.`department`='$dept')
            AND `emp_promotion`.`prom_year` = '$prom_yr'";
        $res = mysqli_query($conn, $query);
        $count = mysqli_num_rows($res);

        $check = mysqli_fetch_assoc($res);
        if ($count > 0 && $check['approved'] == 1) {
            $msg = 'Approved promotion for the ' . $prom_yr . ' already exists for the selected employees';
        } elseif ($count > 0 && $check['approved'] == 0) {

            $msg = 'Pending promotions exists for the selected employees for the year ' . $prom_yr . ' : Go to approve promotions page';
        } else {

            $sql = "SELECT * 
            FROM `emp_employment_info` 
            Left join `emp_academic_info` ON `emp_employment_info`.`emp_id`=`emp_academic_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_employment_info`.`salary_grade`=`emp_salary_grade`.`id` 
            WHERE ($prom_yr - YEAR(`emp_employment_info`.`last_promo_date`)) >= 2 
            AND (`emp_employment_info`.`salary_grade`='$grade' 
            OR `emp_employment_info`.`ministry`='$ministry' 
            OR `emp_employment_info`.`department`='$dept') 
            AND `emp_academic_info`.`highest_qualification`= 1 ";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);
        }
    } else {

        $query = "SELECT * FROM `emp_promotion` WHERE `emp_promotion`.`prom_year` = '$prom_yr' ";
        $res = mysqli_query($conn, $query);
        $count = mysqli_num_rows($res);

        $check = mysqli_fetch_assoc($res);
        if ($count > 0 && $check['approved'] == 1) {
            $msg = 'Approved promotion for the ' . $prom_yr . ' already exists for the selected employees';
        } elseif ($count > 0 && $check['approved'] == 0) {

            $msg = 'Pending promotions exists for the selected employees for the year ' . $prom_yr . ' : Go to approve promotions page';
        } else {

            $sql = "SELECT * 
            FROM `emp_employment_info` 
            Left join `emp_academic_info` ON `emp_employment_info`.`emp_id`=`emp_academic_info`.`emp_id`
            Left join `emp_salary_grade` ON `emp_employment_info`.`salary_grade`=`emp_salary_grade`.`id` 
            WHERE ($prom_yr - YEAR(`emp_employment_info`.`last_promo_date`)) >= 2 
            AND `emp_academic_info`.`highest_qualification`= 1";
            $result = mysqli_query($conn, $sql);
            $total = mysqli_num_rows($result);
        }
    }
    if ($total > 0) {


        while ($row = mysqli_fetch_assoc($result)) {
            $emp_id = $row['emp_id'];
            $sal_grade = $row['grade_level'];
            $salary = $row['salary'];
            $highestQual = $row['type'];
            $current_date = date('Y');
            $last_promo_date = $row['last_promo_date'];
            $part = explode('-', $last_promo_date);
            $last_promo_yr = $part[0];
            $diff = $prom_yr - $last_promo_yr;
            $total_p = count($emp_id);

            if ($sal_grade == '01' && $highestQual > 200) {
                $new_grade = '02';
            } elseif ($sal_grade == '02' && $highestQual > 200) {
                $new_grade = '03';
            } elseif ($sal_grade == '03' && $highestQual > 200) {
                $new_grade = '04';
            } elseif ($sal_grade == '04' && $highestQual > 200) {
                $new_grade = '05';
            } elseif ($sal_grade == '05' && $highestQual > 200) {
                $new_grade = '06';
            } elseif ($sal_grade == '06' && $highestQual > 200) {
                $new_grade = '07';
            } elseif ($sal_grade == '07' && $highestQual > 300 && $diff > 2) {
                $new_grade = '08';
            } elseif ($sal_grade == '08' && $highestQual > 300 && $diff > 2) {
                $new_grade = '09';
            } elseif ($sal_grade == '09' && $highestQual > 300 && $diff > 2) {
                $new_grade = '10';
            } elseif ($sal_grade == '10' && $highestQual > 300 && $diff > 2) {
                $new_grade = '12';
            } elseif ($sal_grade == '12' && $highestQual > 300 && $diff > 2) {
                $new_grade = '13';
            } elseif ($sal_grade == '13' && $highestQual > 400 && $diff > 3) {
                $new_grade = '14';
            } elseif ($sal_grade == '14' && $highestQual > 400 && $diff > 3) {
                $new_grade = '15';
            } elseif ($sal_grade == '15' && $highestQual > 400 && $diff > 3) {
                $new_grade = '16';
            } else {
                $new_grade = '0';
                $count_0 = count($new_grade);
            }


            if ($total == $count_0) {
                $msg = $count_0 . ' employee(s) does not meet promotion requirements';
            } else {

                if ($new_grade != 0) {
                    //$i = 0;
                    //    for ($i = 1; $i < $count_p+1; $i++){

                    $insert = "INSERT INTO `emp_promotion` (emp_id,prev_grade,emp_new_grade,emp_new_rank,notional_date,financial_date,prom_year)
          VALUES('$emp_id','$sal_grade','$new_grade',' ','$not_date','$fin_date','$prom_yr') ";
                    //    }
                    
                    
                    $count_p = mysqli_affected_rows($conn);
                    if(mysqli_query($conn,$insert)==true){
                        $msg_success = 'Promotion generated successfully for '.$count_p.' employees';
                        
                        }
                }
         // mysqli_query($conn,$insert);
            
        //    echo "<tr><td>$emp_id</td> 
        //         <td>$sal_grade</td> 
        //         <td>$new_grade</td> 
        //         <td>$salary</td> 
        //         <td>$last_promo_date</td> 
        //         <td>" .$row['ministry']."</td> 
        //         <td>".$row['department']. "
        //         </td>$prom_yr</tr><br>";
         
            }

    } 
    }else{
        if ($msg==""){
        $msg ="No employees exist for the selection: Please check and regenerate";
        }
    } 
}  //show generate form
?>
            <div class="card shadow mb-4">
            <form method="get" class="emp_form">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Generate promotion</h6>
                    </div>
                    <div class="card-body">
                    <div class="form-group">
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
                    <label>Grade</label>
                    <p ><select name="emp_grade" class="custom-select form-control">
                        <option value="">All</option>
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
                    <label>Ministry</label>
                    <p><select name="emp_ministry" class="custom-select form-control">
                        <option value="">All</option>
                        <option value="Finance">Finance</option>
                        <option value="Works">Works</option>
                    </select></p>

                    </div>
                    <div class="form-group">
                    <label>Department</label>
                    <p><select name="emp_dept" class="custom-select form-control">
                        <option value="">All</option>
                        <option value="dept 1">Dept 1</option>
                        <option value="dept 2">Dept 2</option>
                    </select></p>
                    </div>

                    <div class="form-group">
                    <label>Financial date</label>
                    <div class="datepicker input-group date" data-date-format="dd-mm-yyyy" data-provide="datepicker" >
                        <input type="text" name="emp_promo_fin_date" class="form-control"  required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label>Notional date</label>
                        <div class="datepicker input-group date" data-date-format="dd-mm-yyyy" data-provide="datepicker">
                            <input type="text" name="emp_promo_not_date" class="form-control"  required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary"><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <label>Year</label>
                    <p><input type="text" name="emp_prom_yr" class="form-control" placeholder="yyyy" required></p>
                    </div>

                    <div style="overflow:auto;">
                        <div style="float:right;">
                        <input type="submit" name="generate" class="btn btn-primary" value="Generate" id="butgenerate">
                        </div>
                    </div>
                        <?php //} ?>
                    </div>        
            </form>
            </div>
          
<?php require_once('footer.php'); ?>