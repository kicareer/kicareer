<?php
include './config.php';
// include 'header.php';
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
<section class="content bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>All Job Locations</h2>
                <div class="row">
                    <?php
                    $fetch_location = $conn->prepare("SELECT distinct location_name as location 
                                                    FROM job_locations 
                                                    
                                                    ORDER BY location_name ASC");
                    $fetch_location->execute();
                    foreach ($fetch_location->fetchAll(PDO::FETCH_ASSOC) as $location) {
                        ?>
                        <div class="col-lg-4 mb-3">
                            <a href="./?filter_by_location&location=<?=$location['location']?>" class="btn btn-light btn-block text-left">
                                <?=$location['location']?>
                                
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?> 

</body>
</html>