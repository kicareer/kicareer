<?php
include('config.php');

// Check if this is a subdomain
$host = $_SERVER['HTTP_HOST'];
$is_subdomain = false;
$employer_id = null;

if (count(explode('.', $host)) > 2) {
    $subdomain = explode('.', $host)[0];
    
    // Query to fetch employer details based on subdomain
    $stmt = $conn->prepare("SELECT id FROM employer_tbl WHERE subdomain = ?");
    $stmt->execute([$subdomain]);
    $employer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($employer) {
        $is_subdomain = true;
        $employer_id = $employer['id'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />  
<meta name="author" content="" />
<meta name="description" content="">
<link rel="icon" type="image/png" href="images/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Document title -->
<title>Kenz Career Portal</title>
<!-- Stylesheets & Fonts -->
<link href="webcss/plugins.css" rel="stylesheet">
<link href="webcss/style.css" rel="stylesheet">
</head>

<style type="text/css">
    @font-face {
      font-family: 'Azonix';
      src: url('css/Azonix.otf') format('opentype');
    }
        .kenz-btn{
            border: 1px solid #ececec !important;
            border-radius: 5px;
            background-color: #ffffff !important;
            margin:10px;
            color: black !important;
            width: 85% !important;
            box-shadow: 0 0 5px 0 rgba(154, 161, 191, 0.45);
        }
        .cardstyle{
            padding: 10px !important;
            color: black !important;
        }
        .innercard{
            color: black !important;
            border-left: 1px !important;
            margin-right: 5px !important;
            
        }
        .first-inp{
         width: 40% !important;border-right:2px solid #f2f2f2;
        }
        .sec-inp{
            width:20% !important;border: none;border-right:2px solid #f2f2f2;
        }

        .thrd-inp{
            width: 30% !important;
        }

        .first-card{
            background:#fff !important;width: 100% !important;
            border-radius:100px;display: flex;align-items: center;
            justify-content: center;height: 100px;grid-gap: 5px;
             box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.75);
        }
        .card-search{
            background:#2b88c4 !important;
            color:#fff;border-radius: 20px;
            margin-left: 10px;
        }
        .mb-width{
            background:#fff !important;
            width: 100% !important;
            border-radius:100px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100px;
            grid-gap: 5px;
            box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.75);
        }

        .scrll{
            height:82vh !important;
            overflow-y: scroll;
        }

    .mo-btn{
        position: absolute;bottom: 2px;right:10px;
    }
    .mobi-btn{
            margin-right: -20px !important;
        }
    @media only screen and (min-width:1px) and (max-width:520px){ 


        .mb-width{
            background:#fff !important;
            width: 100% !important;
            border-radius:100px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            grid-gap: 5px;
            box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.75);
        }


        .mo-btn{
             position: absolute;
             bottom: 0px;
             right:10px;
        }
      
        .mo-pd{
            margin-bottom: 25px !important;
        }
        .scrll{
            height: 100% !important;
            overflow-y: none !important;
        }

        .first-inp{
                margin-bottom: 10px;
                width: 100% !important;border:2px solid #f2f2f2;
            }
            .sec-inp{
                margin-bottom: 10px;
                width:100% !important;border:2px solid #f2f2f2 !important;
            }
            .thrd-inp{
                margin-bottom: 10px;
                width: 100% !important;
                border:2px solid #f2f2f2 !important;
            }
            .first-card{
                border-radius: 10px;
                padding: 10px;
                display:block;
                height: 170px;
            }
            .card-search{
                border-radius:2px !important;
            }

            .mobi-btn{
                margin-right: -20px !important;
            }
    }
    .video-wrapper {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        background: radial-gradient(circle at 50% 50%, #00537B, #0C2947);
    }

    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(100, 95, 92, 0.025);  /* Darkens the video */
        z-index: 1;
    }

    video {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
        opacity: 0.3;  /* Reduced opacity */
    }

    .content-overlay {
        position: relative;
        z-index: 2;
        padding-left: 0%;
        padding-top: 15vh;
    }

    .title__heading1{
  margin: 0;
  font-weight: 900;
  font-size:75px ! important;
  font-family: "Azonix", sans-serif;
  line-height: 1;
  text-align: center;
  margin-top: 10% !important;
  color: #fff;
  text-transform: uppercase;
  background: linear-gradient(45deg,  #274fbd,#f9ac07,#e34a0e, #01d8fd, #14dfea,   #5406d9, #e912a3, #7a3bca, #f9ac07, #7a3bca);
  background-size: 400% 400%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradient-overflow 20s linear infinite;
  user-select: none; }

@keyframes gradient-overflow {
  0% {
    background-position: 0 50%; }
  50% {
    background-position: 100% 50%; }
  100% {
    background-position: 0 50%; } }


    @media (max-width: 768px) {
      .title__heading1 {
        font-size: 1.5rem;
      }
       .content-overlay {
        width: 100%;
       }
    }
</style>
<body>
<!-- Body Inner -->
<div class="body-inner">
    <!-- Header -->
   <?php
   include 'header.php';
   ?>

   <div>
   
   <div class="video-wrapper">
    <div class="video-overlay"></div>
    <video autoplay muted loop>
      <source src="bgspark.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="content-overlay">
      <h1 class="title__heading1">The people behind <br><br>exceptional people.</h1>
    </div>
  </div>
  
   </div>
    <!-- end: Header -->
     <section class="p-b-0" style="background:url(gplay.png) !important;">
        <div class="container">
            <div>
                <center>
                    <h2 class="m-0" style="line-height: 1.5">Find your dream job now</h2>
                    <p>Select a role and we'll show you relevant jobs for it!</p>
                </center>
            </div>
            <div class="row">
                <div class="first-card">
                    <div class="input-group show-hide-password first-inp">
                        <div class="input-group-append">
                            <span class="input-group-text" style="background:none !important"><i class="icon-search" aria-hidden="true" style="cursor: pointer;font-size: 20px"></i></span>
                        </div>
                        <input class="form-control" id="search_job" autocomplete="off" list="searchlist"   type="text" required=""  style="width:30% !important;border: none;" placeholder="Enter Job Role">
                    </div>
                    <datalist id="searchlist"  >
                        <?php
                            $fetch_jobs=$conn->prepare("SELECT sno,job_title FROM post");
                            $fetch_jobs->execute();
                            


                            foreach ($fetch_jobs->fetchAll(PDO::FETCH_ASSOC) as $jobs_key) {
                                echo '<option value="'.$jobs_key['job_title'].'" >'.$jobs_key['job_title'].'</option>';
                            }
                        ?>
                    </datalist>
                    <select id="search_experience" required class="form-control sec-inp">
                        <option value="" >Experience (Any)</option>
                        <option value="0" >Fresher(less than 1 year)</option>
                        <option value="1">1 year</option>
<option value="2">2 years</option>
<option value="3">3 years</option>
<option value="4">4 years</option>
<option value="5">5 years</option>
<option value="6">6 years</option>
<option value="7">7 years</option>
<option value="8">8 years</option>
<option value="9">9 years</option>
<option value="10">10 years</option>
<option value="11">11 years</option>
<option value="12">12 years</option>
<option value="13">13 years</option>
<option value="14">14 years</option>
<option value="15">15 years</option>
<option value="16">16 years</option>
<option value="17">17 years</option>
<option value="18">18 years</option>
<option value="19">19 years</option>
<option value="20">20 years</option>

                    </select>
                    <div class="input-group show-hide-password thrd-inp">
                        <select class="form-control sec-inp" id="location_search" >
                            <option value="">Location (Any)</option>
                            <?php
                                $fetch_location=$conn->prepare("SELECT sno, name FROM locations");
                                $fetch_location->execute();
                                    
                                foreach ($fetch_location->fetchAll(PDO::FETCH_ASSOC) as $location_key ) {
                                     echo '<option value="'.$location_key['name'].'">'.$location_key['name'].'</option>';  
                                   }   
                            ?>
                        </select>
                        <div class="input-group-append">
                            <button type="button" onclick="search_jobs()" class="input-group-text card-search" > Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid p-t-90 p-b-40" style="background:#fff;margin-top:-50px;">
            <div class="carousel client-logos dots-grey" data-items="5" data-items-md="2" data-items-sm="2" data-arrows="ture" data-dots="false">
                <?php
                    $fetch_role=$conn->prepare("SELECT distinct role FROM post WHERE role<>''");
                    $fetch_role->execute();
                    foreach ($fetch_role->fetchAll(PDO::FETCH_ASSOC) as $role_key ) {
                        echo '
                            <div>
                                <button onclick="" class="btn kenz-btn"> '.$role_key['role'].'</button>
                            </div>
                            ';
                    }
                ?>
             </div>
        </div>
    </section>
    
    <style type="text/css">
        .accordion .ac-item .ac-title:before{display: none}
        .ac-title i{
           margin-right: -20px !important;
           font-size: 22px;
           margin-top:2px;
        }

        .card-article{
            padding: 30px 30px !important;
        }
        .two-lines{
           overflow: hidden;
           text-overflow: ellipsis;
           display: -webkit-box;
           -webkit-box-orient: vertical;
           -webkit-line-clamp: 2; /* number of lines to show */
           line-height: 1.5;        /* fallback */
           max-height:40px;       /* fallback */
        }
        .ac-content::-webkit-scrollbar {
            display: none;
        }

            /* Hide scrollbar for IE, Edge and Firefox */
        .ac-content {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

    <section class="background-grey p-b-30">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar-->
                <div class="sidebar d-none d-md-block" style="width:26%">
<!--Tabs with Posts-->
<div class="widget ">
    <div class="toggle accordion">
        <div class="card" style="padding:20px"><b>All Filters</b>
            <div class="ac-item m-t-10 <?php echo (isset($_GET['role_filter']))? 'ac-active' : '' ?> " >
                <h5 class="ac-title active" onclick="activeAc('dep_id')">Department  <i class="icon-chevron-<?php echo (isset($_GET['role_filter']))? 'up': 'down'?>  float-right color_change_class" id="dep_id" style="transform:rotate(0deg) !important;"></i> </h5>

                <div class="ac-content " style="overflow: scroll;height: 250px;">
                     <?php
                        $fetch_jobs=$conn->prepare("SELECT role, count(sno) as total_count FROM post GROUP BY role");
                        $fetch_jobs->execute();
                        foreach ($fetch_jobs->fetchAll(PDO::FETCH_ASSOC) as $jobs_key ) {
                            if($jobs_key['role'] != ''){
                            ?>
                            <div class="custom-control custom-checkbox">
                                    <input type="radio" name="departments" id="rem_'<?=$jobs_key['role']?>'" class="custom-control-input" value="<?=$jobs_key['role']?>">
                                    <label class="custom-control-label" for="rem_'<?=$jobs_key['role']?>'"><?=$jobs_key['role']?>(</label><?=$jobs_key['total_count']?>)</label>
                            </div>
                            <?php
                            }
                        }
                    ?>
                    
                </div>
            </div>
            <div class="ac-item <?php echo (isset($_GET['emp_type']))? 'ac-active' : ''?> ">
                <h5 class="ac-title" onclick="activeAc('work_id')">Work mode  <i class="icon-chevron-<?php echo (isset($_GET['role_filter']))? 'up': 'down'?> float-right color_change_class" id="work_id"></i></h5>
                <div class="ac-content"  style="overflow: scroll;height: auto;">
                    <?php
                        $fetch_type=$conn->prepare("SELECT emp_type, count(sno) as total_count FROM post GROUP BY emp_type");
                        $fetch_type->execute();
                        foreach ($fetch_type->fetchAll(PDO::FETCH_ASSOC) as $type_key ) {
                            if($type_key['emp_type'] != ''){
                            ?>
                            <div class="custom-control custom-checkbox">
                                <input type="radio" name="emp_type" id="work_<?=$type_key['emp_type']?>" value="<?=$type_key['emp_type']?>" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="work_<?=$type_key['emp_type']?>"> <?=$type_key['emp_type']?> </label>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="ac-item <?php echo (isset($_GET['edu']))? 'ac-active' : ''?> ">
                <h5 class="ac-title" onclick="activeAc('edu')" >Industry <i class="icon-chevron-<?php echo (isset($_GET['edu']))? 'up': 'down' ?> float-right color_change_class" id="edu"></i></h5>
                <div class="ac-content"  style="overflow: scroll;height: 250px;">
                <?php
                    $fetch_edu=$conn->prepare("SELECT industry_type, count(sno) as total_count FROM post WHERE industry_type<>'' GROUP BY industry_type");
                    $fetch_edu->execute();
                    foreach ($fetch_edu->fetchAll(PDO::FETCH_ASSOC) as $edu_key ) {
                        ?>
                        <div class="custom-control custom-checkbox">
                            <input  type="radio" name="industry_type" id="edu_<?=$edu_key['industry_type']?>" class="custom-control-input" value="<?=$edu_key['industry_type']?>" >
                            <label class="custom-control-label" for="edu_<?=$edu_key['industry_type']?>"> <?=$edu_key['industry_type']?> </label>
                        </div>

                        <?php
                    }
                ?>
                </div>
            </div>
            <center>
            	<div onclick="apply_filter()" class="btn m-t-10" style="background:#2b88c4;border-color: #2b88c4;width: 50%;">Apply Filters</div>
            </center>
        </div>
    </div>
</div>
<!--End: Tabs with Posts-->
                </div>
               
                <div class="col-lg-12 d-block d-md-none">
                    <button type="button" class="btn" data-toggle="modal" style="background: #1778bc !important;border: none;margin-bottom: 10px !important;margin-left: 4px;" data-target="#exampleModalCenter">
                      <img src="image/filter.png" width="10px"> &nbsp; Filter
                    </button>
                </div>
               
                <!-- end: Sidebar-->
<div class="col-lg-6" >
    <div class="scrll" id="articleholder">
    </div>
</div>
                <style type="text/css">
                    .right-side-css{
                        width: 22%;
                    }
                    @media only screen and (min-width:1px) and (max-width:520px){
                        .right-side-css{
                        width:100%;
                    }
                    .logo-img div img{
                       /*border: 2px solid red;*/
                       width: 100% !important;
                       margin-left:0px !important;
                    }

                    }
                    
                </style>
                <?php if (!$is_subdomain): ?>
                <div class="right-side-css d-none d-md-block">
                    <div class="card card-article">
                        <h5>See our jobs in Featured Companies</h5>
                       
                            <div class="row m-t-10 logo-img" >
                                <?php
                       $fetch_logo = $conn->prepare("SELECT company_logo AS logo, subdomain FROM employer_tbl");
                       $fetch_logo->execute();
                       
                       foreach ($fetch_logo->fetchAll(PDO::FETCH_ASSOC) as $logo_key) {
                           $logo_path = $logo_key['logo'];
                           $subdomain = $logo_key['subdomain'];
                           // Check if the file exists and is a valid image
                           if (!empty($logo_path) && file_exists($logo_path) && @getimagesize($logo_path)) {
                               echo '
                                   <div class="col-lg-6 m-b-10 col-6">
                                       <a href="https://' . $subdomain . '.ki-careers.com" target="_blank">
                                           <img style="max-width:120px; max-height:60px;" src="' . $logo_path . '">
                                       </a>
                                   </div>
                               ';
                           }
                       }
                       
                    ?>
                                
                            </div>
                       
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
</div>
<?php
include('footer.php');
?>
<!-- end: Body Inner -->
<!-- Scroll top -->
<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
<!--Plugins-->
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<!--Template functions-->
<script src="js/functions.js"></script>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="widget ">
                <div class="toggle accordion">
                    <div class="card" style="padding:20px"><b>All Filters</b>
                        <div class="ac-item m-t-10 ">
                            <h5 class="ac-title active" onclick="activeAc('dep_id')">Department  <i class="icon-chevron-down float-right color_change_class" id="dep_id" style="transform:rotate(0deg) !important;"></i> </h5>
                            <div class="ac-content">
                               
                                
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="rem1" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="rem1">Sales & Business Development(11970)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="" id="rem2" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="rem2">Customer Success, Service & Operations(6411)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="" id="rem3" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="rem3">Other(4924)</label>
                                </div>
                            </div>
                        </div>
                        <div class="ac-item ac-active">
                            <h5 class="ac-title" onclick="activeAc('work_id')">
                                Work mode  
                            </h5>
                            <div class="ac-content">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="work1" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="work1">Work from office(67524)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="work2" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="work2">Hybrid(4177)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="work3" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="work3">Permanent Remote / WFH(1920)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="work4" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="work4">Temp. WFH due to covid(875)</label>
                                </div>
                                
                            </div>
                        </div>
                        <div class="ac-item">
                            <h5 class="ac-title" onclick="activeAc('salary')" >Salary <i class="icon-chevron-down float-right color_change_class" id="salary"></i></h5>
                            <div class="ac-content">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="sal1" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="sal1">0-3 Lakhs(21)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="sal2" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="sal2"> 3-6 Lakhs(21)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="sal3" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="sal3"> 6-10 Lakhs(19)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="sal4" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="sal4"> 10-15 Lakhs(38)</label>
                                </div>
                                
                            </div>
                        </div>
                        <div class="ac-item">
                            <h5 class="ac-title" onclick="activeAc('edu')" >Education <i class="icon-chevron-down float-right color_change_class" id="edu"></i></h5>
                            <div class="ac-content">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="edu4" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="edu4"> Any Postgradeducation</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="edu4" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="edu4"> MBA/PGDM(32)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="edu4" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="edu4">B.Tech/B.E.(101)</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="reminders" id="edu4" class="custom-control-input" value="1" required="">
                                    <label class="custom-control-label" for="edu4"> Any Graduate(77)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

  <?php
    if(isset($_GET['success'])){
        ?>
          <script type="text/javascript">
            $(document).ready(function(){
                $('#deleteModel').modal('show');
            });
          </script>
        <?php
         }
    ?>
        <div id="deleteModel" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <center><img src="image/checked.png" width="15%"></center>
                                <h4> Thank You. </h4>
                                <h5 style="color:#303030 !important">Your application has been successfully submitted. </h5>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-2 mb-2">
                            <button data-dismiss="modal" class="btn btn-b" type="button" style="background:#2b88c4;border-color:#2b88c4">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

<script type="text/javascript">
    function activeAc(dep_id){
        var elements = document.getElementsByClassName("color_change_class");
            for (var i = 0; i < elements.length; i++) {
              elements[i].style.transform = "";
            }

        if (document.getElementById(dep_id).style.color === "black") {
          document.getElementById(dep_id).style.transform = "rotate(0deg)";
            document.getElementById(dep_id).style.color = "#303030";
          
           } else{

            document.getElementById(dep_id).style.color = "black";
            document.getElementById(dep_id).style.transform = "rotate(180deg)";
           }
    }    
</script>
<script type="text/javascript">

function get_all_jobs(){
    <?php if ($is_subdomain) { ?>
        // For subdomain - only get employer's jobs
        var url = 'API/get-all-jobs.php?callback=';
        var data = 'get_all_jobs=abc&employer_id=<?=$employer_id?>';
    <?php } else { ?>
        // For main domain - get all jobs
        var url = 'API/get-all-jobs.php?callback=';
        var data = 'get_all_jobs=';
    <?php } ?>
    
    $.ajax({
        type: "GET",
        url: url,
        data: data,
        cache: false,
        crossDomain: false,
        beforeSend: function(){},
        success: function(data){
            data = $.trim(data);
            $("#articleholder").html(data);
        }
    });
}

function apply_filter(){
    var departments = '';
    var emp_type = '';
    var industry_type = '';
    
    $("input[name='departments']:checked").each(function() {
        departments = $(this).val();
    });
    $("input[name='emp_type']:checked").each(function() {
        emp_type = $(this).val();
    });
    $("input[name='industry_type']:checked").each(function() {
        industry_type = $(this).val();
    });
    
    <?php if ($is_subdomain) { ?>
        // For subdomain - include employer_id in filter
        var url = 'API/get-all-jobs.php?callback=';
        var data = 'departments=' + departments + 
                  '&emp_type=' + emp_type + 
                  '&industry_type=' + industry_type + 
                  '&employer_id=<?=$employer_id?>' +
                  '&sort_jobs=';
    <?php } else { ?>
        // For main domain - normal filter
        var url = 'API/get-all-jobs.php?callback=';
        var data = 'departments=' + departments + 
                  '&emp_type=' + emp_type + 
                  '&industry_type=' + industry_type + 
                  '&sort_jobs=';
    <?php } ?>
    
    $.ajax({
        type: "GET",
        url: url,
        data: data,
        cache: false,
        crossDomain: false,
        beforeSend: function(){},
        success: function(data){
            data = $.trim(data);
            $("#articleholder").html(data);
        }
    });
}

function search_jobs(){
    var search_job = $("#search_job").val();
    var search_experience = $("#search_experience").val();
    var location_search = $("#location_search").val();
    
    <?php if ($is_subdomain) { ?>
        // For subdomain - include employer_id in search
        var url = 'API/get-all-jobs.php?';
        var data = 'job=' + encodeURIComponent(search_job) + 
                  '&experience=' + encodeURIComponent(search_experience) + 
                  '&location=' + encodeURIComponent(location_search) + 
                  '&employer_id=<?=$employer_id?>';
    <?php } else { ?>
        // For main domain - normal search
        var url = 'API/get-all-jobs.php?';
        var data = 'job=' + encodeURIComponent(search_job) + 
                  '&experience=' + encodeURIComponent(search_experience) + 
                  '&location=' + encodeURIComponent(location_search);
    <?php } ?>
    
    $.ajax({
        type: "GET",
        url: url + data,
        data: data,
        cache: false,
        crossDomain: false,
        beforeSend: function(){},
        success: function(data){
            data = $.trim(data);
            $("#articleholder").html(data);
        }
    });
}

get_all_jobs(); // Add this back after the function definition
</script>
</body>

</html>