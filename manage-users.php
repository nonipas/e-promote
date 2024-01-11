<?php require_once('header.php'); ?>
<?php 
    if ($_SESSION['user_level'] !=0) {
        echo '<script>alert("Access denied");
        window.location.replace("'.$base_path.'/dashboard.php");
        </script>';
    
    }

    if(isset($_POST['add'])) {

        $full_name = $_POST['name'];
        $user_name = $_POST['username'];
        $user_level = $_POST['user_level'];
        $hashedpwd = trim(password_hash('123456', PASSWORD_DEFAULT));
        $hash = trim(md5( rand(0,1000) ));
        

        if ($full_name !== "" && $user_name !== "" && $user_level !== ""){
            $sql ="INSERT INTO `users` (full_name,user_name,pass,salted_hash,user_level) VALUES ('$full_name','$user_name','$hashedpwd','$hash','$user_level')";
            if (mysqli_query($conn, $sql)) {
                $msg_success ="<p>User added successfully</p>";
            }else{
                $msg_error ="<p>error connecting to database</p>";
            }
        }
    }
    $name_value = $user_value = $id_input = '';
    if (isset($_GET['edit_user']) && $_GET['edit_user'] !==''){
        $user_id = $_GET['edit_user'];
        $sql = "SELECT * FROM `users` WHERE user_id = '$user_id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $name_value='value="'.$row['full_name'].'"';
        $user_value = 'value="'.$row['user_name'].'"';
        $id_input = '<input type="hidden" value="'.$row['user_id'].'" >';
        
    }
?>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">            
            <h2 style="font-size:24px;">Manage users</h2>
          </div>
            <div class="card shadow mb-4" style="max-width:720px;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="emp_form">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add user</h6>
                    </div>
                    <div class="card-body">
                    <span class="msg-success">
                    <?php echo $msg_success; ?>
                    </span>
                    <span class="msg-error">
                    <?php echo $msg_error; ?>
                    </span>
                    <?php echo $id_input; ?>
                    <div class="form-group">
                    <label>Name</label>
                    <input type="text" <?php echo $name_value; ?> name="name" class="form-control" placeholder="e.g: John Umahi" required>
                    </div>
                    <div class="form-group">
                    <label>Username</label>
                    <input type="text" <?php echo $user_value; ?> name="username" class="form-control" placeholder="e.g: johnUmahi" <?php if (isset($_GET['edit_user'])){ echo 'disabled';} ?> required>
                    </div>
                    <div class="form-group">
                    <label>User level</label>
                    <select name="user_level" class="form-control"  required>
                        <option value="1">Manager</option>
                        <option value="2">Approver</option>
                        <option value="0">Admin</option>
                    </select>
                   
                    </div>
                    <?php if (isset($_GET['edit_user'])){ ?>
                    
                    <div class="checkbox">
                    <label><input type="checkbox" value="1"> Reset password</label>
                    </div>
                    <?php } ?>
                
                <div style="overflow:auto;">
                    <div style="float:right;">
                    <input type="submit" name="<?php if (isset($_GET['edit_user'])){ echo 'update';}else{echo 'add'; } ?>" class="btn btn-primary" value="<?php if (isset($_GET['edit_user'])){ echo 'Update';}else{echo 'Add'; } ?>" id="butadd">
                    </div>
                </div>
            </div>  
            </form>
            </div>
            <div class="card shadow mb-4" style="max-width:720px;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Users</h6>
                </div>
                <div class="card-body">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        
                        <th>Name</th>
                        <th>Username</th>
                        <th>Action</th>

                    </thead>
                    <tbody>
                        <?php 
                            $sql ="SELECT * FROM `users`";
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) {
                        ?>

                        <tr> 
                            <td> <?php echo $row['full_name']; ?></td>
                            <td> <?php echo $row['user_name']; ?></td>
                            <td><a href="<?=$base_path?>/manage-users.php?edit_user=<?php echo $row['user_id'] ?>" class="btn btn-primary btn-xs update" id="butedit">Edit</a></td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            </div>
<?php require_once('footer.php'); ?>

