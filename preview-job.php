<?php
include('config.php');
$id=htmlspecialchars(trim($_GET['id']));
$fetch=$conn->prepare("SELECT p.*  FROM post p  WHERE p.sno=:id ");
$fetch->bindparam(':id', $id);
$fetch->execute();
$key=$fetch->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />  
      <meta name="author" content="INSPIRO" />    
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="images/favicon.png">   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title></title>
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
</head>
<style type="text/css">
            .btn1{
                border-color:#457eff;
                background: no-repeat;
                color: #457eff;
                border-radius: 15px;
                padding: 5px 20px;
            }
			.btn{
				background: #457eff !important;
				border-radius: 10px;
				border-color: #457eff !important;
			}
            .kenz-btn{
                border: 1px solid #ececec !important;
                border-radius: 5px;
                background-color: #ffffff !important;
                margin:10px;
                color: black !important;
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
               .accordion .ac-item .ac-title:before{display: none}
            .ac-title i{
               margin-right: -20px !important;
               font-size: 22px;
               margin-top:2px;
            }

            .card-article{
                padding: 30px 30px !important;
            }
            .vertical{
            	border-top: none;
            	border-left: none;
            	border-bottom: none;
            	border-right: 1px solid;
            	border-spacing: 5px !important;
            	border-color: #bebfc2;
            	padding-right: 10px;

            }

        </style>

<body>
   
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
       <?php
    //    include'header.php';
       ?>
        <!-- end: Header -->
        <section class="p-b-0" style="background:url(gplay.png) !important;height: 200px">
            <div class="container-fluid">
                <style type="text/css">
                    .breadcrumb .active a{
                        color:#1778bc !important;
                        font-weight: 600 !important;
                    }
                </style>
                <h3 class="text-center">Job Details</h3>
                <p class="text-center">
                <b><?=$key['job_title']?></b>
                </p>
            </div>
        </section>
        <div class="container-fluid">
            <!-- <div class="col-md-12">
                <div class="breadcrumb p-t-5 m-b-0">
                    <ul>

                        <li><a href="my-jobs.php?login&id=<?=$id?>" style="cursor: pointer;background-color: white;">My Jobs</a></li>
                        <li   class="active"><a href="#">View Job</a> </li>
                    </ul>
                </div>
            </div> -->
            <div class="col-md-12" >
            <div class="row">
            <div class="col-md-2">
              
            </div>
                <div class="col-md-8">
                 
                    <?php if ($key) { ?>
                    <article style="background: #fff !important">
                        <div class="card card-article" style="cursor: pointer;">
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="m-0">
                                      <b><?=$key['job_title']?></b><br>
                                      
                                    </h4>
                                    <div>
                                        <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                           <li><i class="icon-clipboard "></i>  <?=$key['exper_min']?> - <?=$key['exper_max']?></li>
                                           <li><i class="fas fa-coins text-muted mr-2"></i> <?=$key['salary_min']?> - <?=$key['salary_max']?></li>
                                           <li><i class="icon-map-pin"></i> <?=$key['location']?></li>
                                       </ul>
                                    </div>
                                    <div>

                                    	<hr class="m-b-20 m-t-10">
                                    	<div class="">

                                    		<span class="vertical">Posted :  
                                                <strong>
                                                 <?=$key['post_date']?>
                                                 </strong>
                                            </span>
                                    		<span  style="margin-left:10px">Openings : 
                                                <strong><?=$key['openings']?>
                                                </strong>
                                            </span>
                                    	</div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </article>




            
                    <article style="background: #fff !important">
                        <div class="card card-article" style="cursor: pointer;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="m-0">Job description</h4>
                                    <div>
                                        <p style="color: #424242">
                                           <?=$key['job_description']?>
                                        </p>                           
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="m-0">Job requirement</h4>
                                    <div class="row" style="margin-top: 8px">
                                        <div class="col-md-6">
                                            <p style="color: #424242"><i class="fas fa-user-graduate text-muted mr-2"></i> <?=$key['education']?></p>
                                            <p style="color: #424242"><i class="fas fa-chalkboard-teacher text-muted mr-2"></i><?=$key['skills']?></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </article>

                    <?php
                        if ($key['employer_id']=='admin') {
                            echo'';    
                        }else{
                            $fetch_com=$conn->prepare("SELECT e.* FROM employer_tbl e LEFT JOIN post p ON p.employer_id = e.id WHERE p.sno=:id ");
                            $fetch_com->bindparam(':id', $id);
                            $fetch_com->execute();
                            $c_key=$fetch_com->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <article  style="background: #fff !important">
                                <div class="card card-article" style="cursor: pointer;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Employer Details</h4>
                                            <p class="m-0"><b><?=$c_key['name']?></b></p>
                                            <p class="m-b-10"><?=$c_key['designation']?></p>
                                            <p class="m-0"><b>Company Description</b></p>
                                            <p class="m-b-10"><?=$c_key['company_description']?></p>
                                            <p class="m-0"><b>Company Info</b></p>
                                            <small>Address : <?=$c_key['company_address']?> , <?=$c_key['city']?> , <?=$c_key['company_state']?> , <?=$c_key['company_country']?> , <?=$c_key['company_pincode']?></small>
                                        </div>
                                    </div>
                                </div>
                            </article>
                                <?php
                        }
                    }
                    else{
                        echo '<div class="card card-article" style="cursor: pointer;">';
                        echo '<div class="row">';
                        echo '<div class="col-md-12">';
                        echo '<p class="m-0 text-center"><b>No Job Found</b></p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>


                    

                </div>
               
            
            </div>
        </div>
        </div>
        <?php
// include 'footer.php';
?>
        
    </div>
    <!-- end: Body Inner -->
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <!--Template functions-->
    <script src="js/functions.js"></script>

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
</body>
    
</html>