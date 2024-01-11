<?php

if (isset($_POST['RegTemp']) && !empty($_POST['RegTemp'])) {
		
    	include 'assets/inc/config.php';
    	include 'assets/inc/function.php';
		
		$data 		= explode(";",$_POST['RegTemp']);
		$vStamp 	= $data[0];
		$sn 		= $data[1];
		$emp_id		= $data[2];
		$regTemp 	= $data[3];
		
		$device = getDeviceBySn($sn);
		
		$salt = md5($device[0]['ac'].$device[0]['vkey'].$regTemp.$sn.$emp_id);
		
		if (strtoupper($vStamp) == strtoupper($salt)) {
			
			$sql1 		= "SELECT MAX(bio_id) as fid FROM emp_biometric WHERE emp_id=".$emp_id;
			$result1 	= mysqli_query($conn,$sql1);
			$data 		= mysqli_fetch_array($result1);
			$fid 		= $data['fid'];
			
			if ($fid == 0) {
				$sq2 		= "INSERT INTO emp_biometric SET emp_id='".$emp_id."', bio_id=".($fid+1).", details='".$regTemp."' ";
				$result2	= mysqli_query($conn,$sq2);
				if ($result1 && $result2) {
					$res['result'] = true;				
				} else {
					$res['server'] = "Error insert registration data!";
				}
			} else {
				$res['result'] = false;
				$res['user_finger_'.$emp_id] = "Template already exist.";
			}
			
			echo "empty";
			
		} else {
			
			$msg = "Parameter invalid..";
			
			
			
		}

		
}

?>