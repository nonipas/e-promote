<?php 

// menu function
function menu() {

	
    
    $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

    if ($cur_page !== 'index.php'){

        include_once('menu.php');

    }
} //end of menu function

// message function
function msg(){
    
    echo '<div class="alert alert-success alert-dismissible" id="msg-success" style="display:none;">';           
    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
    echo '</div>';

    echo '<div class="alert alert-warning alert-dismissible" id="msg-error" style="display:none;">';
    echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>';
    echo '</div>';
}

function dash_active(){
    if ($_SERVER['REQUEST_URI'] =='/dashboard.php'){
        echo 'active';
    }
}
function addEmp_active(){

    if($_SERVER['REQUEST_URI'] =='/add_employee.php'){
        echo 'active';
    }
}
function empList_active(){

    if($_SERVER['REQUEST_URI'] =='/emp_list.php'){
        echo 'active';
    }
}
function editEmp_active(){

    if($_SERVER['REQUEST_URI'] =='/edit_emp_info.php'){
        echo 'active';
    }
}
function manageEmp_active(){

    if($_SERVER['REQUEST_URI'] =='/add_employee.php' || $_SERVER['REQUEST_URI'] =='/emp_list.php' || $_SERVER['REQUEST_URI'] =='/edit_emp_info.php' || $_SERVER['REQUEST_URI'] =='/biometric-capture.php' || $_SERVER['REQUEST_URI'] =='/bio-verification.php' ){
        echo 'active';
    }
}
function manageEmp_show(){

    if($_SERVER['REQUEST_URI'] =='/add_employee.php' || $_SERVER['REQUEST_URI'] =='/emp_list.php' || $_SERVER['REQUEST_URI'] =='/edit_emp_info.php' || $_SERVER['REQUEST_URI'] =='/biometric-capture.php' || $_SERVER['REQUEST_URI'] =='/bio-verification.php'){
        echo 'show';
    }
}
function manageProm_active(){

    if($_SERVER['REQUEST_URI'] =='/generate_emp_promotion.php' || $_SERVER['REQUEST_URI'] =='/promotion_list.php' || $_SERVER['REQUEST_URI'] =='/approve_emp_promotion.php' ){
        echo 'active';
    }
}
function manageProm_show(){

    if($_SERVER['REQUEST_URI'] =='/generate_emp_promotion.php' || $_SERVER['REQUEST_URI'] =='/promotion_list.php' || $_SERVER['REQUEST_URI'] =='/approve_emp_promotion.php'){
        echo 'show';
    }
}
function rank_active(){

    if($_SERVER['REQUEST_URI'] =='/emp_rank.php'){
        echo 'active';
    }
}
function empGrade_active(){

    if($_SERVER['REQUEST_URI'] =='/emp_salary_grade.php'){
        echo 'active';
    }
}
function bio_active(){

    if($_SERVER['REQUEST_URI'] =='/biometric-capture.php'){
        echo 'active';
    }
}
function verify_active(){

    if($_SERVER['REQUEST_URI'] =='/bio-verification.php'){
        echo 'active';
    }
}
function gen_active(){

    if($_SERVER['REQUEST_URI'] =='/generate_emp_promotion.php'){
        echo 'active';
    }
}
function prom_active(){

    if($_SERVER['REQUEST_URI'] =='/promotion_list.php'){
        echo 'active';
    }
}
function app_active(){

    if($_SERVER['REQUEST_URI'] =='/approve_emp_promotion.php'){
        echo 'active';
    }
}

function msg_alert(){
    $msg = '';
    $msg_success = '';
?>
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
<?php    
}
// login paage header code
function indexStyle(){
    $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

    if ($cur_page == 'index.php'){
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
	body {
		color: #fff;
        background-color: #224abe;
        background-image: url(assets/images/bg2.jpg);
        background-repeat: no-repeat;
        /* background-size: cover; */
        background-blend-mode: overlay;
	}
	.form-control {
        min-height: 41px;
		background: #fff;
		box-shadow: none !important;
		border-color: #e3e3e3;
	}
	.form-control:focus {
        border-color: #4e73df;
        border-width: 2px;
	}
    .form-control, .btn {        
        border-radius: 2px;
    }
	.login-form {
		width: 350px;
		margin: 0 auto;
		padding: 100px 0 30px;		
	}
	.login-form form {
		color: #7a7a7a;
		border-radius: 2px;
    	margin-bottom: 15px;
        font-size: 13px;
        background: #ececec;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;	
        position: relative;	
    }
	.login-form h2 {
		font-size: 22px;
        margin: 35px 0 25px;
    }
	.login-form .avatar {
		position: absolute;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: -50px;
		width: 95px;
		height: 95px;
		border-radius: 50%;
		z-index: 9;
		background: #4e73df;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.login-form .avatar img {
		width: 100%;
	}	
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .btn {        
        font-size: 16px;
        font-weight: bold;
		background: #4e73df;
		border: none;
		margin-bottom: 20px;
    }
	.login-form .btn:hover, .login-form .btn:focus {
		background: #224abe;
        outline: none !important;
	}    
	.login-form a {
		color: #fff;
		text-decoration: underline;
	}
	.login-form a:hover {
		text-decoration: none;
	}
	.login-form form a {
		color: #7a7a7a;
		text-decoration: none;
	}
	.login-form form a:hover {
		text-decoration: underline;
	}
</style>
<?php } }?>
<?php 
	function getDevice() {
		include 'config.php';
		$sql 	= 'SELECT * FROM device ORDER BY device_name ASC';
		$result	= mysqli_query($conn,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'device_name'	=> $row['device_name'],
				'sn'		=> $row['sn'],
				'vc'		=> $row['vc'],
				'ac'		=> $row['ac'],
				'vkey'		=> $row['vkey']
			);

			$i++;

		}

		return $arr;

	}
	
	function getDeviceAcSn($vc) {
		include 'config.php';
		$sql 	= "SELECT * FROM device WHERE vc ='".$vc."'";
		$result	= mysqli_query($conn,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'device_name'	=> $row['device_name'],
				'sn'		=> $row['sn'],
				'vc'		=> $row['vc'],
				'ac'		=> $row['ac'],
				'vkey'		=> $row['vkey']
			);

			$i++;

		}

		return $arr;

	}
	
	function getDeviceBySn($sn) {
		include 'config.php';
		$sql 	= "SELECT * FROM device WHERE sn ='".$sn."'";
		$result	= mysqli_query($conn,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'device_name'	=> $row['device_name'],
				'sn'		=> $row['sn'],
				'vc'		=> $row['vc'],
				'ac'		=> $row['ac'],
				'vkey'		=> $row['vkey']
			);

			$i++;

		}

		return $arr;

	}

	function getUser() {
		include 'config.php';
		$sql 	= 'SELECT * FROM emp_profile ORDER BY id ASC';
		$result	= mysqli_query($conn,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'emp_id'	=> $row['id'],
				'first_name'	=> $row['firstname']
			);

			$i++;

		}

		return $arr;

	}

	function deviceCheckSn($sn) {
		include 'config.php';
		$sql 	= "SELECT count(sn) as ct FROM device WHERE sn = '".$sn."'";
		$result	= mysqli_query($conn,$sql);
		$data 	= mysqli_fetch_array($result);

		if ($data['ct'] != '0' && $data['ct'] != '') {
			return "sn already exist!";
		} else {
			return 1;
		}

	}

	function checkUserName($first_name) {
		include 'config.php';
		$sql	= "SELECT firstname FROM emp_profile WHERE firstname = '".$first_name."'";
		$result	= mysqli_query($conn,$sql);
		$row	= mysqli_num_rows($result);

		if ($row>0) {
			return "Username exist!";
		} else {
			return "1";
		}

	}

	function getUserFinger($emp_id) {
		include 'config.php';
		$sql 	= "SELECT * FROM emp_biometric WHERE emp_id= '".$emp_id."' ";
		$result = mysqli_query($conn,$sql);
		$arr 	= array();
		$i	= 0;

		while($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'emp_id'	=>$row['emp_id'],
				"finger_id"	=>$row['bio_id'],
				"finger_data"	=>$row['details']
				);
			$i++;

		}

		return $arr;

	}
	
	function getLog() {
		include 'config.php';
		$sql 	= 'SELECT * FROM emp_verification ORDER BY date_verified DESC';
		$result	= mysqli_query($conn,$sql);
		$arr 	= array();
		$i 	= 0;

		while ($row = mysqli_fetch_array($result)) {

			$arr[$i] = array(
				'log_time'		=> $row['date_verified'],
				'first_name'		=> $row['emp_id'],
				'data'			=> $row['data']
			);

			$i++;

		}

		return $arr;

	}
	
	function createLog($emp_id, $time, $sn) {
		include 'config.php';
		$sq1 		= "INSERT INTO emp_verification SET emp_id='".$emp_id."', data='".date('Y-m-d H:i:s', strtotime($time))." (PC Time) | ".$sn." (SN)"."', status = 1 ";
		$result1	= mysqli_query($conn,$sq1);
		if ($result1) {
			return 1;				
		} else {
			return "Error insert log data!";
		}
		
	}

?>