<?php require_once('header.php'); ?>
<?php 


    if(isset($_POST['add'])) {

        $emp_rank = $_POST['emp_rank'];

        if ($emp_rank !== ""){
            $sql ="INSERT INTO `emp_rank` (name) VALUES ('$emp_rank')";
            if (mysqli_query($conn, $sql)) {
                $msg_success ="<p>Rank added successfully</p>";
            }else{
                $msg_error ="<p>error connecting to database</p>";
            }
        }
    }
?>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">            
            <h2 style="font-size:24px;">Manage rank</h2>
          </div>
            <div class="card shadow mb-4" style="max-width:720px;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="emp_form">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add rank</h6>
                    </div>
                    <div class="card-body">
                    <span class="msg-success">
                    <?php echo $msg_success; ?>
                    </span>
                    <span class="msg-error">
                    <?php echo $msg_error; ?>
                    </span>
                    <div class="form-group">
                    <label>Rank</label>
                    <p ><input type="text" name="emp_rank" class="form-control" placeholder="enter rank name" required></p>
                    </div>
                   
                
                <div style="overflow:auto;">
                    <div style="float:right;">
                    <input type="submit" name="add" class="btn btn-primary" value="add" id="butadd">
                    </div>
                </div>
            </div>  
            </form>
            </div>
            <div class="card shadow mb-4" style="max-width:720px;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of ranks</h6>
                </div>
                <div class="card-body">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        
                        <th>Rank name</th>
                        <th>Action</th>

                    </thead>
                    <tbody>
                        <?php 
                            $sql ="SELECT * FROM `emp_rank`";
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) {
                        ?>

                        <tr> 
                            <td> <?php echo $row['name']; ?></td>
                            <td><input type="button" name="edit" value="Edit" class="btn btn-primary btn-xs update" id="butedit"></td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            </div>
<?php require_once('footer.php'); ?>

