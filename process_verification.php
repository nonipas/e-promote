<?php

if (isset($_POST['VerPas']) && !empty($_POST['VerPas'])) {
		
	include 'assets/inc/config.php';
	include 'assets/inc/function.php';
	
	$data 		= explode(";",$_POST['VerPas']);
	$emp_id	= $data[0];
	$vStamp 	= $data[1];
	$time 		= $data[2];
	$sn 		= $data[3];
	
	$fingerData = getUserFinger($emp_id);
	$device 	= getDeviceBySn($sn);
	$sql1 		= "SELECT * FROM emp_profile WHERE id ='".$emp_id."'";
	$result1 	= mysqli_query($conn,$sql1);
	$data 		= mysqli_fetch_array($result1);
	$first_name	= $data['firstname'];
		
	$salt = md5($sn.$fingerData[0]['finger_data'].$device[0]['vc'].$time.$emp_id.$device[0]['vkey']);
	
	if (strtoupper($vStamp) == strtoupper($salt)) {
		
		$log = createLog($emp_id, $time, $sn);
		
		if ($log == 1) {
		
			echo $base_path."bio-verification.php?success";
		
		} else {
		
			echo $base_path."messages.php?msg=$log";
			
		}
	
	} else {
		
		$msg = "Parameter invalid..";
		
		echo '<script>alert('.$msg.')</script>';
		
	}
}

?>