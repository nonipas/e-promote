<?php
    include 'config.php';
            $id = rand(22234876,25644876);
            $bdate = DateTime::createFromFormat('d-m-Y',$_POST['empdob']);
            $adate = date_create($_POST['empDate']);
            $ldate = date_create($_POST['lastPromo']);
	        $firstname= $_POST['firstname'];
            $lastname= $_POST['lastname'];
            $othernames= $_POST['othernames'];
            $phone= $_POST['phone'];
            $address= $_POST['address'];
            $birthDate= $bdate->format('Y-m-d');        
            $gender= $_POST['gender'];
            $maritalStatus= $_POST['maritalStatus'];
            $state= $_POST['state'];
            $lga= $_POST['lga'];
            $empDate= date_format($adate,'Y-m-d');
            $lastPromo= date_format($ldate,'Y-m-d');
            $ministry= $_POST['ministry'];
            $dept= $_POST['dept'];
            $grade= $_POST['grade'];
            $rank= $_POST['rank'];
            $qualType= json_decode($_POST['qualType']); 
            $certificate= json_decode($_POST['certificate']);
            $institution= json_decode($_POST['institution']);
            $certYear= json_decode($_POST['certYear']);
            $highestQual= json_decode($_POST['emp_highestQual']);
            if ($highestQual == 'Yes'){
                $hQual = 1;
            } else {
                $hQual = 0;
            }

    // insert profile details
	$sql = "INSERT INTO `emp_profile`
    ( `id`, `firstname`, `lastname`, `othername`, `phone`, `address`, `date_of_birth`, `gender`, `marital_status`, `state`, `lga`) 
	VALUES ('$id','$firstname','$lastname','$othernames','$phone','$address','$birthDate','$gender','$maritalStatus','$state','$lga')";
    
    if (mysqli_query($conn, $sql)) {

        // insert employment info

        $sql = "INSERT INTO `emp_employment_info`
        ( `emp_id`, `employment_date`, `last_promo_date`, `ministry`, `department`, `salary_grade`) 
        VALUES ('$id','$empDate','$lastPromo','$ministry','$dept','$grade')";

        if (mysqli_query($conn, $sql)) {

            // insert academic info
            for ($i = 0; $i < count($qualType); $i++) {
                $sql = "INSERT INTO `emp_academic_info`
                ( `emp_id`, `type`, `cert_obtained`, `institution`, `year_obtained`, `highest_qualification`) 
                VALUES ('$id','$qualType[$i]','$certificate[$i]','$institution[$i]','$certYear[$i]','$hQual[$i]')";
                if (mysqli_query($conn, $sql)) {

                    echo 1;
                } else{

                    echo 0;

                } 
            }

        }else{

            //echo json_encode(array("statusCode"=>201));
            echo 0;

        }
		
	} 
	else {
        // echo json_encode(array("statusCode"=>201));
        echo 0;
	}
	mysqli_close($conn);
?>