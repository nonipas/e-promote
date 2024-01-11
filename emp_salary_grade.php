<?php require_once('header.php'); ?>
<?php 


    if(isset($_POST['add'])) {
        $emp_grade = $_POST['emp_grade'];
        $emp_salary = $_POST['emp_salary'];
        $emp_rank = $_POST['emp_rank'];
        
        if ($emp_rank !== ""){
            $sql ="INSERT INTO `emp_salary_grade` (grade_level, salary, rank_id) VALUES ('$emp_grade','$emp_salary','$emp_rank')";
            if (mysqli_query($conn, $sql)) {
                $msg_success ="<p>Record added successfully</p>";
            }else{
                $msg_error ="<p>error connecting to database</p>";
            }
        }
    }
?>
            <h2 style="font-size:24px;">Manage grade level</h2>

            <form method="post" class="emp_form">
                    <div class="title">
                        <h3>Add grade and salary</h3>
                    </div>
                    
                    <div class="form-group">
                    <label>Grade:</label>
                    <p ><input type="text" name="emp_grade" class="form-control" required></p>
                    </div>

                    <div class="form-group">
                    <label>Salary:</label>
                    <p ><input type="text" name="emp_salary" class="form-control"  required></p>
                    </div>

                    <div class="form-group">
                    <label>Rank:</label>
                    <p ><select name="emp_rank" class="form-control"  required>
                        <option>Select rank</option>
                    <?php 
                            $sql ="SELECT * FROM `emp_rank`";
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                    </select></p>
                    </div>
                   
                <div style="overflow:auto;">
                    <div style="float:right;">
                    <input type="submit" name="add" class="btn btn-primary" value="add" id="butadd">
                    </div>
                </div>

            </form>
            <div class="emp_form">
                <div class="title">
                    <h3>List of Salary Grade </h3>
                </div>
                <table class="table table-bordered table-striped" >
                    <thead>
                        <th>Grade</th>
                        <th>Salary</th>
                        <th>Rank</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php 
                            $sql ="SELECT `emp_salary_grade`.grade_level, `emp_salary_grade`.salary, `emp_rank`.name 
                            FROM `emp_salary_grade`
                            LEFT JOIN `emp_rank`
                            ON `emp_salary_grade`.rank_id = `emp_rank`.id 
                            ";
                            $res = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res) > 0){
                            while ($row = mysqli_fetch_assoc($res)) {
                    ?>

                        <tr> 
                            <td> <?php echo'GL-'.$row['grade_level']; ?></td>
                            <td> <?php echo $row['salary']; ?></td>
                            <td> <?php echo $row['name']; ?></td>
                            <td><input type="button" name="edit" value="Edit" class="btn btn-primary btn-xs update" id="butedit"></td>

                        </tr>
                    <?php 
                            }
                        }else {
                            echo "<tr><td colspan='4'>No record</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
          
<?php require_once('footer.php'); ?>