<?php
		
if (isset($_GET['vc']) && !empty($_GET['vc'])) {
	
	include 'assets/inc/config.php';
	include 'assets/inc/function.php';
	
	$data = getDeviceAcSn($_GET['vc']);
	
	echo $data[0]['ac'].$data[0]['sn'];
	
}

?>