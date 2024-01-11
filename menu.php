  <?php 
    $base_path        = "http://localhost/e-promote";
  ?>      
        <!-- <div class="menu"> -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- <ul class="left_nav"> -->
                
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                    <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-award"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">E-promote</div>
                </a>

                <hr class="sidebar-divider my-0">

                <li class="nav-item <?php dash_active(); ?>" >
                <a class="nav-link" href="<?=$base_path?>/dashboard.php">
                <i class="fa fa-dashboard"></i>
                <span> Dashbord</span></a>
                </li>
                <?php if ($_SESSION['user_level']== 0 || $_SESSION['user_level']== 1){ ?> 
                <hr class="sidebar-divider">

                <li class="nav-item <?php manageEmp_active() ?>"><a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><i class="fas fa-tag"></i> 
                <span> Manage Employee</span></a>
                    <div id="collapseTwo" class="collapse <?php manageEmp_show() ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php addEmp_active() ?>" href="<?=$base_path?>/add_employee.php">Add Employee</a>
                        <a class="collapse-item <?php editEmp_active() ?>" href="<?=$base_path?>/edit_emp_info.php">Edit/Update Employee</a> 
                        <a class="collapse-item <?php empList_active() ?>" href="<?=$base_path?>/emp_list.php">Employee List</a>
                        <a class="collapse-item <?php bio_active() ?>" href="<?=$base_path?>/biometric-capture.php">Capture Biometric</a>
                        <a class="collapse-item <?php verify_active() ?>" href="<?=$base_path?>/bio-verification.php">Verify Employee</a>
                        </div>
                    </div>
                </li>
                <?php } ?>
                <hr class="sidebar-divider ">

                <li class="nav-item <?php manageProm_active() ?>"><a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePromo" aria-expanded="true" aria-controls="collapseTwo"><i class="fas fa-tag"></i> 
                <span> Manage Promotions</span></a>
                    <div id="collapsePromo" class="collapse <?php manageProm_show() ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-light py-2 collapse-inner rounded">
                        <?php if ($_SESSION['user_level']== 0 || $_SESSION['user_level']== 1){ ?>                        
                        <a class="collapse-item <?php gen_active() ?>" href="<?=$base_path?>/generate_emp_promotion.php">Generate Promotion</a>
                        <?php } ?>
                        <a class="collapse-item <?php prom_active() ?>" href="<?=$base_path?>/promotion_list.php">Promotion list</a>
                        <a class="collapse-item <?php app_active() ?>" href="<?=$base_path?>/approve_emp_promotion.php">Approve Promotion</a>
                        </div>
                    </div>
                </li>
<?php if ($_SESSION['user_level']== 0){ ?>
                <hr class="sidebar-divider">

                <li class="nav-item <?php rank_active() ?>">
                <a class="nav-link <?php rank_active() ?>" href="<?=$base_path?>/emp_rank.php"><i class="fas fa-tag"></i> 
                <span>Rank</span></a>
                    
                </li>

                <hr class="sidebar-divider ">

                <li class="nav-item <?php empGrade_active() ?>">
                <a class="nav-link <?php empGrade_active() ?>" href="<?=$base_path?>/emp_salary_grade.php"><i class="fas fa-tag"></i> 
                <span>Salary Grade</span></a>
                </li>

                <hr class="sidebar-divider ">

                <li class="nav-item <?php  ?>">
                <a class="nav-link <?php  ?>" href="<?=$base_path?>/manage-users.php"><i class="fas fa-user"></i> 
                <span>Manage users</span></a>
                </li>
<?php } ?>
                <hr class="sidebar-divider d-none d-md-block">

                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </ul>
        <!-- </div> -->