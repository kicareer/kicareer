<?php
// Add this at the beginning of the file
$custom_logo = 'image/logo-01.png'; // Default logo
$subdomain = '';

// Get the host name from the URL
$host = $_SERVER['HTTP_HOST'];

// Check if this is a subdomain
if (count(explode('.', $host)) > 2) {
    // Extract subdomain from the host
    $subdomain = explode('.', $host)[0];
    
    // Query to fetch employer details based on subdomain
    $stmt = $conn->prepare("SELECT id, company_logo FROM employer_tbl WHERE subdomain = ?");
    $stmt->execute([$subdomain]);
    $employer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($employer && !empty($employer['company_logo'])) {
        $custom_logo = $employer['company_logo'];
    }
}
?>

<header id="header" data-fullwidth="true" class="header-mini light">
    <div class="header-inner">
        <div class="container">
            <!--Logo-->
            <?php
            //   var_dump($_SESSION['profile_image']);
            //   exit;
                if ($logged_in==1) {
                    // echo "logged in";
                    if(isset($_SESSION['kenz_employer'])){
                        $current_page = basename($_SERVER['PHP_SELF']);
                        if($current_page !== 'preview-job.php') {
                            ?>
                            <script type="text/javascript">
                            window.location.href = './employer/';
                            </script>
                            <?php
                        }
                    }
                    ?>
                    <div id="logo">
                        <a href="./?login&id=<?=$_SESSION['id']?>">
                            <span class="logo-default"><img src="<?=$custom_logo?>" style="max-width: 95px; max-height: 50px;"> </span>
                            <span class="logo-dark"><img src="<?=$custom_logo?>" style="max-width: 95px; max-height: 50px;"></span>
                        </a>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div id="logo">
                        <a href="./">
                            <span class="logo-default"><img src="<?=$custom_logo?>" style="max-width: 95px; max-height: 50px;"> </span>
                            <span class="logo-dark"><img src="<?=$custom_logo?>" style="max-width: 95px; max-height: 50px;"></span>
                        </a>
                    </div>   
                    <?php
                }
            ?>
            <!--end: Header Extras-->
            <!--Navigation Resposnive Trigger-->
            <div id="mainMenu-trigger">
                <a class="lines-button x"><span class="lines"></span></a>
            </div>
            <!--end: Navigation Resposnive Trigger-->
            <!--Navigation-->
            <div id="mainMenu" class="menu-right">
                <div class="container">
                    <nav>
                        <ul>
                            <?php

                                if ($logged_in==1) {
                                    ?>
                                    <li>Hey, <?=$_SESSION['name']?></li>
                                   
                                    <li class="dropdown menu-item"><a href="#"><?php echo $_SESSION['profile_image'] ? '<img src="'.$_SESSION['profile_image'].'" style="width: 24px; height: 24px; border-radius: 50%;">' : '<i class="fas fa-user-circle" style="font-size: 24px; color: #abc;"></i>'; ?></a>
                                        <ul class="dropdown-menu">
                                            <li class="mega-menu-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul>
                                                            <li><a href="my-jobs.php">My Jobs</a></li>
                                                            <li><a href="manage-employee-experience.php">Manage Experience</a></li>
                                                            <li><a href="manage-employee-education.php">Manage Education</a></li>
                                                            <li><a href="manage-employee-skills.php">Manage Skills</a></li>
                                                            <li><a href="manage-employee-certificates.php">Manage Certificates</a></li>
                                                            <li><a href="manage-employee-projects.php">Manage Projects</a></li>
                                                            <li><a href="edit-employee.php">Manage Profile</a></li>
                                                            <li><a href="change-password.php">Change Password</a></li>
                                                            <li><a href="logout.php?logout">Logout</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    

                                    <?php
                                }else{
                                    ?>
                                    <li class="dropdown mega-menu-item"><a href="#">Jobs</a>
                                        <ul class="dropdown-menu">
                                            <li class="mega-menu-content">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <ul>
                                                            <li class="mega-menu-title">Jobs By Roles</li>
                                                            <?php
                                                                $fetch_role=$conn->prepare("SELECT role FROM post WHERE role<>'' GROUP BY role ORDER BY count(sno) ASC LIMIT 10");
                                                                $fetch_role->execute();
                                                                $roles = $fetch_role->fetchAll(PDO::FETCH_ASSOC);
                                                                
                                                                foreach ($roles as $role) {
                                                                    echo '<li><a href="?filter_by_role&role='.$role['role'].'">'.$role['role'].'</a></li>';
                                                                }
                                                                
                                                                // Check if there are more than 10 roles
                                                                $count_roles = $conn->query("SELECT COUNT(DISTINCT role) as count FROM post WHERE role<>''");
                                                                $total_roles = $count_roles->fetch(PDO::FETCH_ASSOC)['count'];
                                                                
                                                                if ($total_roles > 10) {
                                                                    echo '<li><a href="all-roles.php" class="text-primary">View All Roles</a></li>';
                                                                }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    
                                                    <div class="col-lg-4">
                                                        <ul>
                                                            <li class="mega-menu-title">Jobs by location</li>
                                                            <?php
                                                                $fetch_location=$conn->prepare("SELECT distinct location_name as location FROM job_locations LIMIT 10");
                                                                $fetch_location->execute();
                                                                $locations = $fetch_location->fetchAll(PDO::FETCH_ASSOC);
                                                                
                                                                foreach ($locations as $location) {
                                                                    echo '<li><a href="./?filter_by_location&location='.$location['location'].'">'.$location['location'].'</a></li>';
                                                                }
                                                                
                                                                // Check if there are more than 10 locations
                                                                $count_locations = $conn->query("SELECT COUNT(DISTINCT location_name) as count FROM job_locations");
                                                                $total_locations = $count_locations->fetch(PDO::FETCH_ASSOC)['count'];
                                                                
                                                                if ($total_locations > 10) {
                                                                    echo '<li><a href="all-locations.php" class="text-primary">View All Locations</a></li>';
                                                                }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <ul>
                                                            <li class="mega-menu-title">Jobs By Convenience</li>
                                                            <?php
                                                                $fetch_type = $conn->prepare("SELECT emp_type FROM post WHERE emp_type<>'' GROUP BY emp_type LIMIT 10");
                                                                $fetch_type->execute();
                                                                $types = $fetch_type->fetchAll(PDO::FETCH_ASSOC);
                                                                
                                                                foreach ($types as $type) {
                                                                    echo '<li><a href="./?filter_by_type?type='.$type['emp_type'].'">'.$type['emp_type'].'</a></li>';
                                                                }
                                                                
                                                                // Check if there are more than 10 types
                                                                $count_types = $conn->query("SELECT COUNT(DISTINCT emp_type) as count FROM post WHERE emp_type<>''");
                                                                $total_types = $count_types->fetch(PDO::FETCH_ASSOC)['count'];
                                                                
                                                                if ($total_types > 10) {
                                                                    echo '<li><a href="all-types.php" class="text-primary">View All Types</a></li>';
                                                                }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    <li class="dropdown "><a href="#">Job Seeker</a>
                                        <ul class="dropdown-menu">
                                            <li class="mega-menu-content">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <ul>
                                                        <li><a href="login.php">Login</a></li>
                                                        <li><a href="registration.php">Register</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>


                                        <li class="dropdown "><a href="#">Employer</a>
                                        <ul class="dropdown-menu">
                                            <li class="mega-menu-content">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <ul>
                                                            <li><a href="employer-login.php">Admin Login</a></li>
                                                            <!-- <li><a href="employer-login.php">Employee Login</a></li> -->
                                                            <li><a href="recruiter-login.php">Recruiter Login</a></li>
                                                            <?php if (!$is_subdomain): ?>
                                                            <li><a href="our-plans.php">Registration</a></li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="contact-us.php">Contact</a></li>
                                
                                    <?php
                                }


                            ?>
                            
                        </ul>
                    </nav>
                </div>
            </div>
            <!--end: Navigation-->
        </div>
    </div>
</header>
<div class="modal fade" id="modal-2" tabindex="-1" role="modal" aria-labelledby="modal-label-2" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Email Id</label>
                        <input type="email" name="email" placeholder="Enter your Email">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your Password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-left">
                    <button data-dismiss="modal" class="btn btn-b" type="button">Login</button>
                </div>
            </div>
        </div>
    </div>
</div>
        
<!-- Add this JavaScript code at the bottom of the file, before closing body tag -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle roles
    const showMoreRoles = document.querySelector('.show-more-roles');
    if (showMoreRoles) {
        showMoreRoles.addEventListener('click', function() {
            document.querySelectorAll('.role-hidden').forEach(el => el.classList.remove('d-none'));
            this.style.display = 'none';
        });
    }

    // Handle locations
    const showMoreLocations = document.querySelector('.show-more-locations');
    if (showMoreLocations) {
        showMoreLocations.addEventListener('click', function() {
            document.querySelectorAll('.location-hidden').forEach(el => el.classList.remove('d-none'));
            this.style.display = 'none';
        });
    }

    // Handle types
    const showMoreTypes = document.querySelector('.show-more-types');
    if (showMoreTypes) {
        showMoreTypes.addEventListener('click', function() {
            document.querySelectorAll('.type-hidden').forEach(el => el.classList.remove('d-none'));
            this.style.display = 'none';
        });
    }
});
</script>
        
