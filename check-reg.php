<?php
if (isset ($_GET['action']) && $_GET['action'] == 'checkreg') {
    require_once('assets/inc/config.php');
        $sql1		= "SELECT count(bio_id) as ct FROM emp_biometric WHERE emp_id=".$_GET['user_id'];
        $result1	= mysqli_query($conn,$sql1);
        $data1 		= mysqli_fetch_array($result1);
        
        if (intval($data1['ct']) > intval($_GET['current'])) {
            $res['result'] = true;			
            $res['current'] = intval($data1['ct']);			
        }
        else
        {
            $res['result'] = false;
        }
        echo json_encode($res);
        
    } else {
    
        echo "Parameter invalid..";
    
    }   
    ?>