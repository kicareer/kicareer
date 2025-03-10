<?php
include('config.php');
$id = $_SESSION['id'];
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
    <title>Kenz Career Portal</title>
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
</head>
<style type="text/css">
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

    /*.scrll{
        height:82vh !important;
        overflow-y: scroll;
    }*/

    .mo-btn{
        position: absolute;bottom: 2px;right:10px;
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
    }
</style>

<body>
   

  <!--  <div class="">
       <div style="width:100%;background:#0008;height:100%;position:fixed;z-index: 99999;top:0;display: flex;align-items: center;justify-content: center;">
            <div class="card card-article">
                <center><img src="image/checked.png" width="15%"></center>
            </div>
       </div>
   </div> -->
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
       <?php
       include'header.php';
       ?>
        <!-- end: Header -->
        <section class="p-b-0" style="background:url(gplay.png) !important;height: 200px !important;">
            <div class="container">
                <div>
                    <center>
                        <h2 class="m-0" style="line-height: 1.5">Applied Jobs</h2>
                        <!-- <p>Select a role and we'll show you relevant jobs for it!</p> -->
                    </center>
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
        </style>

        <section class="background-grey p-b-30">
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar-->

                    <div class="col-lg-2">  </div>
                   
                    <!-- end: Sidebar-->
                    <div class="col-lg-8" >
                        <div class="scrll">
                        <?php
                            $id=htmlspecialchars(trim($_SESSION['id']));
                            $fetch=$conn->prepare("SELECT p.*  FROM post p LEFT JOIN job_applications a ON a.jobid=p.sno LEFT JOIN emp_tbl e ON e.id=a.applied_id where a.applied_id=:id ");
                            $fetch->bindparam(':id', $_SESSION['id']);
                            $fetch->execute();
                            foreach($fetch->fetchAll(PDO::FETCH_ASSOC)as $key){
                                ?>
                                    <article onclick="window.location.href='view-job.php?login&id=<?=$id?>'">
                                        <div class="card card-article" style="cursor: pointer;">
                                            <p class="m-0">
                                              <b><?php echo $key['job_title']; ?></b><br>
                                              <span><?php echo $key['role']; ?></span>
                                            </p>
                                            <div class="p-0 m-0">
                                               <ul style="display:flex;list-style-type: none;padding: 0px !important;margin: 10px 0px;grid-gap:12px;cursor: pointer;">
                                                   <li><i class="icon-clipboard "></i> <?php echo $key['exper_min']; ?> - <?php echo $key['exper_max']; ?></li>
                                                   <li><i class="fas fa-coins text-muted mr-2"></i> <?php echo $key['salary_min']; ?> - <?php echo $key['salary_max']; ?></li>
                                                   <li><i class="icon-map-pin"></i> <?php echo $key['location']; ?></li>
                                               </ul>
                                                <ul style="display:flex;list-style-type: none;padding: 0px !important;margin: 5px 0px">
                                                   <li class="two-lines"><i class="icon-file"></i> &nbsp;<?php echo $key['job_description']; ?></li>
                                                </ul>
                                                
                                            </div>
                                            <div class="breadcrumb m-0 p-0 p-t-5">
                                                <ul>
                                                    <li><i class="fas fa-user-graduate text-muted mr-2"></i> <?php echo $key['education']; ?></li>
                                                    <li><i class="fas fa-chalkboard-teacher text-muted mr-2"></i><?php echo $key['skills']; ?> </li>
                                                </ul>
                                            </div>
                                            <div style="margin-bottom: -10px !important;">
                                                <a href="view-job.php?login&id=<?=$id?>" class="btn btn-primary mt-2" style="background:#1778bc;border-color:#1778bc;float: right;margin-right: -5px;"><i class="fas fa-eye"></i></i> View Details</a>
                                                   
                                            </div>
                                          
                                        </div>
                                    </article>

                                <?php
                            }
                        ?>
                     
                       

                        
                        </div>
                    </div>

                    <!-- <div class="col-lg-3"></div> -->


                    
                </div>
            </div>
        </section>
        <?php
include 'footer.php';
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

</body>
    
</html>