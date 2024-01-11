<?php require_once('header.php'); ?>

        
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">No of Staff</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                            $query ="SELECT COUNT(*) As total_emp FROM `emp_profile` "; 
                            $res= mysqli_query($conn, $query);
                            if($row = mysqli_fetch_assoc($res)){
                                echo $row['total_emp'];
                            }
                            
                            ?>

                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-group fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Last Promoted</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                            $query ="SELECT COUNT(*) As p_latest FROM `emp_promotion` WHERE `approved`=1 AND YEAR(date_created)=(SELECT MAX(YEAR(date_created)) FROM `emp_promotion`)"; 
                            $p_prom_pending= mysqli_query($conn, $query);
                            
                            if ($row1 = mysqli_fetch_assoc($p_prom_pending)){
                                echo $row1['p_latest'];
    
                            }else{
                                echo 0;
                            }
                            
                            ?>

                            </div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-group fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending promotion</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                            $query ="SELECT COUNT(*) As total_pending FROM `emp_promotion` WHERE `approved`=0"; 
                            $p_prom= mysqli_query($conn, $query);
                            if($row = mysqli_fetch_assoc($p_prom)){
                                echo $row['total_pending'];
                            }
                            
                            ?>
                            </div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total promotion</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $query ="SELECT COUNT(*) As total_prom FROM `emp_promotion` WHERE `approved`=1 "; 
                                $res = mysqli_query($conn,$query);
                                if ($row = mysqli_fetch_assoc($res)){
                                    echo $row['total_prom'];
                                }
                            ?>
                            </div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>

<?php require_once('footer.php'); ?>