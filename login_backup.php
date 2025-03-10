<?php
include "config.php";
// var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />  
    <meta name="author" content="INSPIRO" />    
    <meta name="description" content="">
    <link rel="icon" type="image/png" href="images/favicon.png">   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Login</title>
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
    <style type="text/css">
        body{
            background: radial-gradient(circle at 50% 50%, #00537B, #0C2947);
            color: #ffffff !important;
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
        @media only screen and (min-width:1px) and (max-width:520px){
            .mb-marg{
                margin-bottom: 20% !important;
            }
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .company-details {
            flex: 1;
            margin-right: 20px;
        }
        .login-form {
            flex: 1;
        }
        .video-container {
      height: 95vh;
      width: 100%;
      overflow: hidden; /* Ensures no extra space around the video */
      position: relative;
    }
    .video-container video {
      height: 100%;
      width: 100%;
      object-fit: cover; /* Ensures the video covers the container */
    }

    .title__heading1{
  margin: 0;
  font-weight: 900;
  font-size:50px ! important;
  font-family: "Azonix", sans-serif;
  line-height: 1;
  text-align: left;
  text-transform: uppercase;
  background: linear-gradient(45deg,  #274fbd,#f9ac07,#e34a0e, #01d8fd, #14dfea,   #5406d9, #e912a3, #7a3bca, #f9ac07, #7a3bca);
  background-size: 400% 400%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradient-overflow 20s linear infinite;
  user-select: none; }
  input{
    background: transparent !important;
    width: 100% !important;
    margin: 10px  0 !important;
    border: 0px solid #ccc !important;
    background: linear-gradient(45deg,  #002552, #004481) !important;
    height: 50px !important;
    color: white !important;
  }
  .input-group{
    background: linear-gradient(45deg,  #002552, #004481) !important;
    padding: 0px 10px !important;
  }
  .input-group-text{
    border: 0px solid #ccc !important;
    background: transparent !important;
    padding: 0px !important;
  }

  button{
    width: 100% !important;
    margin: 10px  0 !important;
    border: 0px solid #ccc !important;
    background: linear-gradient(45deg,  #002552, #004481) !important;
    height: 70px !important;
    color: #aaa !important;
    border-radius: 10px !important;
  }
  button:hover{
    background: linear-gradient(45deg,  #004481, #002552) !important;
  }
  
    </style>
</head>
<body>
    <header class="header">
        <div class="container-fluid">
            <div class="row d-flex align-items-center justify-content-between" style=" min-height: 95vh;">
            <div class="col-md-8 text-center">  
                <div class="row">  
   <div class="video-container">
    <video autoplay muted loop>
      <source src="bgspark.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="content-overlay">
      <h1 class="title__heading1">The people<br><br> behind <br><br>exceptional<br><br> people.</h1>
    </div>
  </div>
  
  </div>          
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center" style="background: radial-gradient(circle at 50% 50%, #00537B, #0C2947); height: 95vh;">
        
            <div class="login-form px-5">
                <div style="border-radius: 80px !important; box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.75); padding: 70px 40px !important; border: 3px solid #ececec !important; border-color: linear-gradient(45deg,  #002552, #004481) !important;">
                <form method="POST" action="login.php" enctype="multipart/form-data">
                    <div class="text-center mb-5 d-flex align-items-center justify-content-center">
                        <div class="d-flex align-items-center justify-content-center" style="width: 160px; height: 160px; box-shadow: 0 0 10px 0 rgba(255, 255, 255, 0.50); align-items: center; justify-content: center; border-radius: 50%; overflow: hidden; background:#014260">
                        <a href="index.php" class="reset-anchor">
                            <img src="images/kenz-logo1.png" style="width:120px;" class="img-fluid">
                        </a>
                        </div>
                    </div>
                   
                            
                            <div class="form-group justify-content-center"> 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user" style="font-size: 20px; color: #aaa;"></i></span>
                                    </div>
                                    <input type="email" required="" name="email" class="form-control" placeholder="Enter Email" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                           
                              </div> 
                              <div class="form-group justify-content-center">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock" style="font-size: 20px; color: #aaa;"></i></span>
                                    </div>
                                    <input type="password" required=""  name="password" class="form-control" placeholder="*******" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                               </div>
                                <span style="font-size: 12px; display: block; text-align: right; margin-top: 5px;"><a href="#"> Forgot Password ?</a></span>
                           
                            <div class="form-group justify-content-center">
                                
                                    <button class="btn" type="submit" style="background:#457eff; min-width: 200px" name="submit_form">Login</button>  
                            </div>
                       

                </form>
                </div>
                </div>
            </div>
            </div>
            
        </div>
    </header>
    
        <div class="container-fluid text-center border-top">
            <span class="text-dark mt-3 d-block">&copy; 2025 Kenz. All rights reserved.</span>
        </div>
    
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <!--Tdep_idlate functions-->
    <script src="js/functions.js"></script>

    <?php if (isset($_GET["show_kyc_modal"])) { ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#kycModal').modal('show');
            });
        </script>

        <?php } ?>

    <?php if (isset($_GET["show_kyc_modal"])) {

        $id = htmlspecialchars(trim($_GET["id"]));
        $fetchdet = $conn->prepare("SELECT * FROM emp_tbl WHERE id=:id");
        $fetchdet->bindParam(":id", $id);
        $fetchdet->execute();
        $rename_key = $fetchdet->fetch(PDO::FETCH_ASSOC);
        ?>
            <div class="modal fade" id="kycModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-md login-pop-form" role="document">
                    <div class="modal-content overli" id="loginmodal">
                        <div class="modal-header">
                            <h5 class="modal-title">Uploaded Your Resume In DOC/PDF Formats Only</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                            </button>
                          </div>
                        <div class="modal-body">
                            <div class="login-form">
                                <form method="POST" enctype="multipart/form-data">
                                    <h4><?= $rename_key["name"] ?></h4>

                                    <div class="form-group">
                                        <label>File Upload*</label>
                                        <input type="file" required="" class="form-control" placeholder="" name="resume" style="padding-bottom: 10px !important;" >
                                        <span style="font-size: 12px">(Maximum file size 10mb)</span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="update_form" class="btn" style="background:#457eff;border-color:#457eff;border-radius: 0px;width: 100px" >Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              <?php
    } ?>


    <script type="text/javascript">
        function activeAc(dep_id){
            // alert();
            var elements = document.getElementsByClassName("select-css");
                for (var i = 0; i < elements.length; i++) {
                  elements[i].style.transform = "";
                }
            if (document.getElementById(dep_id).style.color === "black") {
                document.getElementById(dep_id).style.border="1px solid #f2f2f2";
                document.getElementById(dep_id).style.color = "#303030";
            } else{
                document.getElementById(dep_id).style.color = "black";
                document.getElementById(dep_id).style.border = "2px solid #457eff";
                document.getElementById(showActive).style.display = "block";
            }
        }    
    </script>
</body> 
</html>
<?php if (isset($_POST["submit_form"])) {
    $_SESSION["logged_in"] = false;
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $password = hash("sha256", $password);

    $check = $conn->prepare("SELECT * FROM emp_tbl WHERE email = :p1");
    $check->bindParam(":p1", $email);
    $check->execute();

    if ($check->rowCount() == 1) {
        $fetch = $check->fetch(PDO::FETCH_ASSOC);

        if ($fetch["password"] == $password) {
            if ($fetch["status"] == "pending") {
                echo '<script>alert("Your account is pending for approval. Please check your registered email.")</script>';
                echo '<script>window.location.href="login.php"</script>';
                exit();
            }
            // Retrieve resume information
            $checkcv = $conn->prepare(
                "SELECT resume FROM emp_tbl WHERE id = :id"
            );
            $checkcv->bindParam(":id", $fetch["id"]);
            $checkcv->execute();
            $fetchcv = $checkcv->fetch(PDO::FETCH_ASSOC);

            // Set session variables for all $fetch data
            foreach ($fetch as $key => $value) {
                $_SESSION[$key] = $value;
            }
            $_SESSION["logged_in"] = true;
            $_SESSION["logged_in_as"] = "employee";

            // Check if resume is present and set appropriate redirection
            if (empty($fetchcv["resume"])) {
                echo '<script>window.location.href="?id=' .
                    $fetch["id"] .
                    '&show_kyc_modal"</script>';
            } else {
                echo '<script>window.location.href="index.php?login&id=' .
                    $fetch["id"] .
                    '"</script>';
            }
        } else {
            echo '<script>alert("Invalid Email or Password")</script>';
        }
    } else {
        echo '<script>alert("Invalid Email or Password")</script>';
    }
} ?>

<?php if (isset($_POST["update_form"])) {
    $id = htmlspecialchars(trim($_GET["id"]));

    $temp1 = explode(".", $_FILES["resume"]["name"]);
    $ext1 = pathinfo($_FILES["resume"]["name"], PATHINFO_EXTENSION);
    $now = time();
    $custom_name1 = "-1" . $now . "." . end($temp1);
    $newfilename1 = $custom_name1;
    $file1 = "uploads/" . $newfilename1;
    move_uploaded_file(
        $_FILES["resume"]["tmp_name"],
        "uploads/" . $newfilename1
    );

    $update = $conn->prepare(
        "UPDATE `emp_tbl` SET resume=:resume WHERE id=:id"
    );
    $update->bindparam(":id", $id);
    $update->bindparam(":resume", $file1);
    $update->execute();
    if ($update) {
        $_SESSION["kenz_session_esdy"] = $fetch["id"];
        echo '<script>window.location.href="index.php?login&id=' .
            $id .
            '"</script>';
    } else {
        echo '<script>window.location.href="?failed"</script>';
    }
}
?>
