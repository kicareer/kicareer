<?php
include('config.php');
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
    <title>Job Apply</title>
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
       include'header.php';
       ?>
        <!-- end: Header -->
        <section class="p-b-0 p-t-0" style="background:url(gplay.png) !important;height:60px">
            <div class="container-fluid">
                <style type="text/css">
                    .breadcrumb .active a{
                        color:#1778bc !important;
                        font-weight: 600 !important;
                    }
                </style>
            </div>
        </section>
        <div class="container-fluid">
            <div class="col-md-12" >
            <div class="row">
                <div class="col-md-8">
                    <?php
                       $joblisting = new posts($conn);
                       $joblists = $joblisting ->joblist();

                    //    var_dump($joblists);
                    //    exit;
                       $ok = "notok";
                       $postid = $_GET['postid'];
                       foreach ($joblists as $joblist) { 
                       if($joblist['sno'] == $postid) { ?>


                       <?php
                       
                             $fetch_com=$conn->prepare("SELECT e.* FROM employer_tbl e LEFT JOIN post p ON p.employer_id = e.id WHERE p.sno=:postid");
                            $fetch_com->bindparam(':postid', $postid);
                            $fetch_com->execute();
                            $c_key=$fetch_com->fetch(PDO::FETCH_ASSOC);
                            // var_dump($c_key);
                            // exit;
                            
                            ?>
                            <article  style="background: #fff !important">
                                <div class="card card-article" style="cursor: pointer;">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4 class="m-0"><b><?=$c_key['company_name']?></b></h4>
                                            <p class="m-b-10"><?=$c_key['designation']?></p>
                                            <p class="m-0"><b>Company Description</b></p>
                                            <p class="m-b-10"><?=$c_key['company_description']?></p>
                                            <p class="m-0"><b>Company Info</b></p>
                                            <small>Address : <?=$c_key['company_address']?> , <?=$c_key['city']?> , <?=$c_key['company_state']?> , <?=$c_key['company_country']?> , <?=$c_key['company_pincode']?></small>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="<?=$c_key['company_logo']?>" class="img-fluid" style="max-height: 100px;max-width: 200px"/>
                                        </div>
                                    </div>
                                </div>
                            </article>

<article style="background: #fff !important">
    <div class="card card-article" style="cursor: pointer;">
        <div class="row">
            <div class="col-md-12">
                <p class="m-0">
                  <b><?php echo $joblist['job_title']; ?></b><br>
                  <span><?php echo $joblist['role']; ?> <i class="icon-star" style="color: gold"></i> (11 Reviews)</span>
                </p>
                <div>
                    <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">

                        <?php
                             if ($joblist['exper_max']!='') {
                                 ?>
                                   <li><i class="icon-clipboard "></i>  <?php echo $joblist['exper_min']; ?> - <?php echo $joblist['exper_max']; ?></li>
                                 <?php
                             }else {
                                 echo "";
                             }

                        ?>

                        <?php
                             if ($joblist['salary_max']!='') {
                                 ?>
                                    <li><i class="fas fa-coins text-muted mr-2"></i> <?php echo $joblist['salary_min']; ?> - <?php echo $joblist['salary_max']; ?></li>
                                 <?php
                             }else {
                                 echo "";
                             }

                        ?>
                      
                      
                        <?php
                             if ($joblist['location']!='') {
                                 ?>
                                     <li><i class="icon-map-pin"></i> <?php echo $joblist['location']; ?></li>
                                 <?php
                             }else {
                             }
                        ?>
                   </ul>
                </div>
                <div>
                	<ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                        <li style="position: absolute;right:15px;bottom: 17%">
                        <?php
                            $postid = htmlspecialchars(trim($_GET['postid']));
                            $fetch = $conn->prepare("SELECT * FROM applicants WHERE applied_id=:applied_id AND jobid=:jobid");
                            $fetch->bindParam(':applied_id', $userRow['id']);
                            $fetch->bindParam(':jobid', $postid);
                            $fetch->execute();
                            if ($fetch->rowCount() > 0) {
                                ?>
                                <a href="#" class="btn btn-success mt-2 ml-2"  style="float: right;margin-bottom: 20px !important;"><i class="fas fa-check"></i> Applied</a>
                                <?php
                            } else {
                            ?>         
                                <a href="application.php?login&id=<?=$userRow['id']?>&postid=<?php echo $joblist['sno']; ?>&jobtitle=<?php echo $joblist['job_title']; ?>&rolecategory=<?php echo $joblist['role_category']; ?>"><button class="btn m-b-10"  style="float: right;margin-bottom: 20px !important;" > I AM INTERESTED</button></a><br>
                                <?php
                            }
                        ?> 
                        </li>
                	</ul> <br>
                	<hr class="m-b-20 m-t-10">
                	<div class="">

                		<span class="vertical">Posted :  
                            <strong>
                             <?php echo $joblist['post_date']; ?>
                             </strong>
                        </span>
                		<span style="margin-left:10px">Openings : 
                            <strong><?php echo $joblist['openings']; ?>
                            </strong>
                        </span>
                	</div>
                </div> 
            </div>
        </div>
    </div>
</article>



                    <?php } } ?>
            
                    <article style="background: #fff !important">
                        <div class="card card-article" style="cursor: pointer;">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="m-0">
                                      <b>Job description</b><br>
                                    </p>
                                    <div>
                                        <p style="color: #424242">
                                           <?php echo $joblist['job_description']; ?>
                                        </p>                           
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="m-0"><b>Job requirement</b></p>
                                    <div class="row" style="margin-top: 8px">
                                        <div class="col-md-6">
                                            <p style="color: #424242"><i class="fas fa-user-graduate text-muted mr-2"></i> <?php echo $joblist['education']; ?></p>
                                            <p style="color: #424242"><i class="fas fa-chalkboard-teacher text-muted mr-2"></i><?php echo $joblist['skills']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    
                    
                    <h4>Similar Jobs</h4>

                    <article  style="background: #fff !important">
                        <div class="card card-article" style="cursor: pointer;">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="m-0"><b><a href="#"> Training and Placement On IT Software</a></b></p>
                                   <div>
                                        <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                           <li>ms2.6 <i class="icon-star" style="color: gold"></i> (11 reviews)</li>
                                           <li> Hyderabad / Secunderabad (Banjara hills )</li>
                                           <small>Communication Skills, Presentation Skills, training and placement, presentation, training...</small>
                                        </ul>
                                    </div>
                                    <p style="float: right;">Posted 13 Days Ago</p>
                                </div>   
                            </div><hr>
                            <div class="col-md-12">
                                    <p class="m-0"><b><a href="#"> Be Freshers - IT / Telecom / Computer Science</a></b></p>
                                   <div>
                                        <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                           <li>Capita3.9 <i class="icon-star" style="color: gold"></i> (1806 reviews)</li>
                                           <li> Pune</li>
                                           <small>.Net, communication skills, computer science, coding, telecom, science, computer</small>
                                        </ul>
                                    </div>
                                    <p style="float: right;">Posted 23 Days Ago</p>
                            </div><hr> 

                            <div class="col-md-12">
                                    <p class="m-0"><b><a href="#"> Hiring Grad Freshers With Excellent Comms & MS Office | South Delhi</a></b></p>
                                   <div>
                                        <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                           <li>Sanecto Social Networks</li>
                                           <li>New Delhi(East of Kailash +4)</li>
                                           <small>Communication Skills, MS Office, interpersonal skill, office, analytical skill, microsoft, interpers...</small>
                                        </ul>
                                    </div>
                                    <p style="float: right;">Posted 13 Days Ago</p>
                            </div><hr>
                        </div>
                    </article>

                </div>
               
                <div class="col-md-4">
                    <article  style="background: #fff !important">
                        <div class="card card-article" style="cursor: pointer;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Jobs you might be interested in</h4>
                                    <p class="m-0"><b><a href="#"> Training and Placement On IT Software</a></b></p>
                                   <div>
                                        <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                           <li>ms2.6 <i class="icon-star" style="color: gold"></i> (11 reviews)</li>
                                           <li> Hyderabad / Secunderabad (Banjara hills )</li>
                                           <small>Communication Skills, Presentation Skills, training and placement, presentation, training...</small>
                                        </ul>
                                    </div>
                                    <p style="float: right;">Posted 13 Days Ago</p>
                                </div>   
                            </div><hr>
                            <div class="col-md-12">
                                    <p class="m-0"><b><a href="#"> Be Freshers - IT / Telecom / Computer Science</a></b></p>
                                   <div>
                                        <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                           <li>Capita3.9 <i class="icon-star" style="color: gold"></i> (1806 reviews)</li>
                                           <li> Pune</li>
                                           <small>.Net, communication skills, computer science, coding, telecom, science, computer</small>
                                        </ul>
                                    </div>
                                    <p style="float: right;">Posted 23 Days Ago</p>
                            </div><hr> 

                            <div class="col-md-12">
                                    <p class="m-0"><b><a href="#"> Hiring Grad Freshers With Excellent Comms & MS Office | South Delhi</a></b></p>
                                   <div>
                                        <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                           <li>Sanecto Social Networks</li>
                                           <li>New Delhi(East of Kailash +4)</li>
                                           <small>Communication Skills, MS Office, interpersonal skill, office, analytical skill, microsoft, interpers...</small>
                                        </ul>
                                    </div>
                                    <p style="float: right;">Posted 13 Days Ago</p>
                            </div><hr>
                            <button style="width: 60px;border: none;color:#457eff;background: no-repeat;">View All</button>
                        </div>
                    </article>

                    <article  style="background: #fff !important">
                        <div class="card card-article" style="cursor: pointer;">
                            <div class="row">
                                <div class="col-md-12">
                                   
                                    <p class="m-0"><b> Reviews</b></p>
                                   <div>
                                        <ul style="list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                           <li>Software engineer in Hyderabad/Secunderabad</li>
                                           <li> Anonymous</li>
                                           <li></li>
                                           <li></li>
                                           <li>Likes</li>
                                           <small>I like to work in new zen infotech</small>
                                        </ul>
                                    </div>
                                     <button style=" float: right;border: none;color:#457eff;background: no-repeat;">read all 11 reviews</button>
                                </div>   
                            </div><hr>
                            
                           
                        </div>
                    </article>
                </div>
            </div>
        </div>
        </div>
        
        
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