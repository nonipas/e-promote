<?php
	
if (isset($_GET['emp_id']) && !empty($_GET['emp_id'])) {
	
	include 'assets/inc/config.php';
	include 'assets/inc/function.php';

	$emp_id 	= $_GET['emp_id'];

	echo "$emp_id;SecurityKey;".$time_limit_reg.";".$base_path."process_register.php;".$base_path."getac.php";
	
}

?>