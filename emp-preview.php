<?php require_once('assets/inc/function.php'); ?>
<?php 
require_once('assets/inc/config.php'); 
$msg_success ="";
$msg_error ="";
?>
<?php 


if(isset($_POST['add'])) {

    $emp_rank = $_POST['emp_rank'];

    if ($emp_rank !== ""){
        $sql ="INSERT INTO `emp_rank` (name) VALUES ('$emp_rank')";
        if (mysqli_query($conn, $sql)) {
            $msg_success ="Rank added successfully";
        }else{
            $msg_error ="error connecting to database";
        }
    }
}
?>
<!Doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">  
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
     <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.min.css"> -->
    
    <link href="/assets/css/1.6.4.bootstrap-datepicker.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/assets/css/4.7.0.font-awesome.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="/assets/css/style.css"> -->
<style>

.mytable {
width: 100%;
margin-bottom: 0.75em;
text-transform: uppercase;
}
.mytable td, .mytable th{
    padding: 0.45em;
}
.mytable tr {
    border-top: 1px solid #e3e6f0;
}
@media print{
    button {
        display: none;
    }
}
</style>
    </head>
    <body id="page-top">
        <div id="wrapper">
        
        <div id="content-wrapper" class="d-flex flex-column" >

        <div id="content">
        <div class="container-fluid">
            
        <button style="margin-top: 20px" class="btn btn-outline-primary " onclick="printPage('print')">Print this page</button>  

            <div id="print" class="card mb-4" style="width:980px; margin: 10px auto" >
                    
                    <div class="card-header py-3">
                        <h3 class="m-0 font-weight-bold text-primary">Employee information</h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <?php 
                            if (isset($_GET['employee_id'])){
                                $emp_id = $_GET['employee_id'];
                            $query="SELECT * FROM emp_profile 
                            left join states on emp_profile.state=states.state_id
                            left join locals on emp_profile.lga=locals.local_id 
                            where id = $emp_id ";
                            $result = mysqli_query($conn,$query);
                            $count = mysqli_num_rows($result);
                            if ($count > 0){
                                $row = mysqli_fetch_array($result);
                            ?>
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-sm-6 border-right " >
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                                    </div>
                                    <table class="mytable">
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">EMPLOYEE ID</td>
                                            <td><?php echo $row['id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">FULL NAME</td>
                                            <td><?php echo $row['lastname'].' '.$row['firstname'].' '.$row['othername']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">BIRTH DATE</td>
                                            <td><?php echo $row['date_of_birth']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">GENDER</td>
                                            <td><?php echo $row['gender']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">PHONE</td>
                                            <td><?php echo $row['phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">ADDRESS</td>
                                            <td><?php echo $row['address']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">MARITAL STATUS</td>
                                            <td><?php echo $row['marital_status']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">LGA OF ORIGIN</td>
                                            <td><?php echo $row['local_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">STATE OF ORIGIN</td>
                                            <td><?php echo $row['name']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Employment information</h6>
                                    </div>
                                    <table class="mytable">
                                        <?php 
                                        $query_info = "SELECT * FROM emp_employment_info
                                        left join emp_salary_grade on emp_employment_info.salary_grade=emp_salary_grade.id
                                        left join emp_rank on emp_salary_grade.rank_id=emp_rank.id
                                        where emp_id = $emp_id ";
                                        $result_info = mysqli_query($conn,$query_info);
                                        $count_info=mysqli_num_rows($result_info);
                                        if($count_info > 0){
                                            $row_info =mysqli_fetch_array($result_info);
                                        ?>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">EMPLOYMENT DATE</td>
                                            <td><?php echo $row_info['employment_date'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">LAST PROMOTION DATE</td>
                                            <td><?php echo $row_info['last_promo_date'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">MINISTRY</td>
                                            <td><?php echo $row_info['ministry'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">DEPARTMENT</td>
                                            <td><?php echo $row_info['department'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">GRADE LEVEL</td>
                                            <td><?php echo $row_info['grade_level'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">RANK</td>
                                            <td><?php echo $row_info['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">RETIREMENT DATE</td>
                                            <td>01-01-2027</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="width: 150px">EMPLOYMENT STATUS</td>
                                            <td>ACTIVE</td>
                                        </tr>
                                        <?php } ?>
                                    </table>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Academic information</h6>
                                    </div>
                                    <table class="mytable">
                                        <thead>
                                            <th>S/N</th>
                                            <th>Cert. Obtained</th>
                                            <th>Institution</th>
                                            <th>Year Obtained</th>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $i =1;
                                        $query_aca = "SELECT * FROM emp_academic_info where emp_id = $emp_id ";
                                        $result_aca = mysqli_query($conn,$query_aca);
                                        $count_aca=mysqli_num_rows($result_aca);
                                        if($count_info > 0){
                                            while($row_aca =mysqli_fetch_array($result_aca)){
                                           
                                        ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $row_aca['cert_obtained']; ?></td>
                                                <td><?php echo $row_aca['institution']; ?></td>
                                                <td><?php echo $row_aca['year_obtained'] ?></td>
                                            </tr>
                                        <?php } }?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        <?php 
                            }else{ echo 'No record'; }
                        }else{ echo 'No employee selected';}
                        ?>
                        </div>
                    
                    </div>  
            
            </div>
 <script>
function printPage(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
var enteredtext = $('#print').val();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);

}

// onload(printPage());
 </script>           
<?php require_once('footer.php'); ?>

