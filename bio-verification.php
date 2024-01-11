
<?php require_once('assets/inc/function.php'); ?>
<?php 
require_once('assets/inc/config.php');
$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

if ($cur_page !== 'index.php'){
include('assets/inc/session.php');
} 

$msg_success ="";
$msg_error ="";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Biometric capture</title>
    <script src="assets/js/es6-shim.js"></script>
    <script src="assets/js/websdk.client.bundle.min.js"></script>
    <script src="assets/js/fingerprint.sdk.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> -->
    
    <link href="/assets/css/1.6.4.bootstrap-datepicker.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/assets/css/4.7.0.font-awesome.min.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.timer.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/ajaxmask.js"></script>
<link href="assets/css/ajaxmask.css" rel="stylesheet">
<script src="assets/js/custom.js"></script>
</head>

<body id="page-top">
    
        <div id="wrapper">
        <?php 
           menu();
        ?>

        <div id="content-wrapper" class="d-flex flex-column" >

        <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome! <?php echo $row['user_name'] ?></span>
                <div class="img-profile bg-primary rounded-circle" >
                    <p class="text-center text-capitalize profile-txt"><?php echo substr($row['user_name'],0,1); ?></p>
                </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="index.php/?logout=true" >
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                    </a>
                </div>
                </li>
            </ul>
        </nav>
    
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">            
                <h2 style="font-size:24px;">Biometric verification</h2>
            </div>
            <?php 
            if(isset($_GET['success'])){
                echo '<div class="card shadow mb-4" style="max-width:720px;"><div class="card-body">Employee registered successfully</div></div>';
            }else{
                echo '<div class="card shadow mb-4" style="max-width:720px;"><div class="card-body">
                <div class="table-responsive">      
              <table class="table table-bordered uppertext" id="dataTable">

                    <thead >
                        
                        <th>Action</th>
                        <th>Employee No</th>
                        <th>Name</th>
                        
                                    
                    </thead>
                    <tbody>';

                    
		$sql 	= "SELECT * FROM emp_profile ";
        $result	= mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if ($count > 0){
            while ($row=mysqli_fetch_array($result) ){
                $emp_id = $row['id'];
                $full_name = $row['firstname']." ".$row['lastname'];
                $value = base64_encode($base_path."verification.php?emp_id=".$emp_id);
                $verify = "<a href='finspot:FingerspotVer;$value' class='btn btn-xs btn-primary'>verify</a>";
                echo '
                <tr><td>'.$verify.'</td>
                <td>'.$emp_id.'</td>
                <td>'.$full_name.'</td>
                </tr>';
            }
        }
                    
                   echo '</tbody>
                    </table>
                    </div>
                </div></div>';

            }
            ?>
        </div>
        
        

        </div>
        </div>
        </div>

  <!-- Bootstrap core JavaScript-->
  
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="assets/vendor/jquery/jquery.min.js"></script> -->
  <!-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>    
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>  
  <script src="assets/js/demo/datatables-demo.js"></script>
</body>
</html>

     