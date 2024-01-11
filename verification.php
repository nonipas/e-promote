<?php

if (isset($_GET['emp_id']) && !empty($_GET['emp_id'])) {
	
	include 'assets/inc/config.php';
	include 'assets/inc/function.php';
	
	$emp_id 	= $_GET['emp_id'];
	$finger		= getUserFinger($emp_id);

	echo "$emp_id;".$finger[0]['finger_data'].";SecurityKey;".$time_limit_ver.";".$base_path."process_verification.php;".$base_path."getac.php".";extraParams";
		
}

?>