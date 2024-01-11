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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
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
.dotted-border-bottom{
    border-bottom: 2px dotted #e3e6f0;
}
.container-fluid{
    max-width: 70%;
}
.instruct p {
    margin: 0;
}
.mytable {
width: 100%;
margin-bottom: 0.75em;
text-transform: uppercase;
}
.mytable td, .mytable th{
    padding: 0.45em;
}
.mytable tr {
    border-bottom: 2px dotted #e3e6f0;
}
.list {
    list-style-type: none;
}
@media print{
    .btn {
        display: none;
    }
    .card{
        margin: 0;
        width:100%;
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

            <div id="print" class="card mb-4" style=" margin: 10px auto" >
                    
                    <div class="card-header py-3">
                        <h3 class="m-0 font-weight-bold text-primary text-center ">NOTIFICATION OF PROMOTION</h3>
                    </div>
                    <div class="card-body">
                        
                        
                        <div class="container">
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6">
                                    <p style="text-align: right ">Gen. 35</p>
                                    <div class="instruct" style=" border: 2px solid #e3e6f0; padding: 10px;">
                                        <em><p>To be prepared in Quadruplicate</p>
                                        <p>Original to Officer</p>
                                        <p>Duplicate to Accounts Branch</p>
                                        <p>Triplicate to File</p>
                                        <p>Quadruplicate to Records</p></em>

                                    </div>
                                </div>
                            </div>
                            <?php 
                            if (isset($_GET['promotion_id']) && !empty($_GET['promotion_id'])){
                                $prom_id = $_GET['promotion_id'];
                            $query="SELECT * FROM emp_promotion 
                            left join emp_profile on emp_promotion.emp_id=emp_profile.id
                            left join emp_employment_info on emp_promotion.emp_id=emp_employment_info.emp_id  
                            where emp_promotion.id = $prom_id";
                            $result = mysqli_query($conn,$query);
                            $count = mysqli_num_rows($result);
                            if ($count > 0){
                                $row = mysqli_fetch_array($result);
                            ?>
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-sm-6 " >
                                    
                                    <table class="mytable">
                                        <br><br>
                                        <tr>
                                            
                                            <td><b><?php echo $row['lastname'].' '.$row['firstname'].' '.$row['othername']; ?></b></td>
                                        </tr>
                                        <tr>
                                           
                                            <td><b><?php echo $row['department']; ?></b></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><b><?php echo $row['ministry']; ?></b></td>
                                        </tr>
                                        
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                   
                                    <table class="mytable">
                                       
                                        <tr>
                                            
                                            <td><b>Dept:</b> PERSONNEL</td>
                                        </tr>
                                        <tr>
                                            
                                            <td><?php echo $row['ministry'] ?></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><?php echo 'ABAKALIKI'; ?></td>
                                        </tr>
                                        <tr>
                                            
                                            <td><?php echo date('d-m-yy'); ?></td>
                                        </tr>
                                        
                                       
                                    </table>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>Sir,</p>
                                    <p>I am pleased to inform you that approval has been given for your promotion to ................................................... The following conditions apply:</p>
                                    
                                    <ul class="list">
                                    <li><b>Salary Scale:</b> <lable class="dotted-border-bottom"> 09 </lable></li>
                                    <li><b>Entry point: </b> <lable class="dotted-border-bottom"> ONE </lable></li>
                                    <li><b>Effective Date of Promoton: </b> <lable class="dotted-border-bottom"> Notional: <?php echo $row['notional_date']; ?>, Financial: <?php echo $row['notional_date']; ?> </lable></li>
                                    <li><b>Incremental Date: </b> <lable class="dotted-border-bottom"> JANUARY </lable></li>

                                    </ul> 
                                    <p>2. May I offer you my congratulations and trust that you will carry out dilligently the duties and responsibilies of your new grade.</p>
                                    <p>Necessary gazette action is being taken.</p>  
                                    <p style="float: right;">I have the honour to be, <br> Sir,<br> Your obedient Servant,<br><br> ............................................<br><em>For:</em> <b>Chairman</b></p>   
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

