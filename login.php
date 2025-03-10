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
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1;
            background: radial-gradient(circle at 50% 50%, #00537B, #0C2947);
        }

        .video-background video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            opacity: 0.4;
        }

        .page-content {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1;
        }

        .left-content {
            flex: 1;
            padding-left: 10%;
            color: white;
        }

        .right-content {
            width: 600px;
            min-height: 100vh;
            background: linear-gradient(to right,rgb(8, 52, 73), #004481);
            padding: 40px !important;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.9;
        }

        @font-face {
            font-family: 'Azonix';
            src: url('fonts/Azonix.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        .title__heading1 {
            margin: 0;
            font-weight: 900;
            font-size: 70px !important;
            font-family: "Azonix", sans-serif;
            line-height: 1;
            text-align: left;
            text-transform: uppercase;
            background: linear-gradient(45deg, #274fbd, #f9ac07, #e34a0e, #01d8fd, #14dfea, #5406d9, #e912a3, #7a3bca, #f9ac07, #7a3bca);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-overflow 20s linear infinite;
            user-select: none;
        }
        

        /* Add the animation keyframes */
        @keyframes gradient-overflow {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .card-my {
            height: 100%;
            width: 90%;
            background: conic-gradient(from 45deg, rgb(255, 255, 255), rgb(250, 250, 250), rgb(255, 255, 255), rgb(255, 255, 255), rgb(255, 255, 255)) !important;
            border-radius: 15px !important;
            border: none !important;
            box-shadow: none !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .card-my::before {
            content: '';
            position: absolute;
            top: 5px;   /* Adjust this to ensure border thickness */
            left: 5px;  /* Adjust this to ensure border thickness */
            right: 5px; /* Adjust this to ensure border thickness */
            bottom: 5px;/* Adjust this to ensure border thickness */
            background: linear-gradient(45deg, #274fbd, rgb(32, 88, 134), rgb(44, 129, 145));
            border-radius: 15px;
            z-index: -1; /* Ensure this stays behind content */
        }

        .card-my form {
            width: 100%;
            padding: 40px;
        }


        .logo-container {
            width: 150px;
            height: 150px;
            margin: 0 auto 60px;
            background: linear-gradient(135deg, #014260, #002552);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            position: relative;
            transition: all 0.3s ease;
        }

        .logo-container:after {
            content: '';
            position: absolute;
            top: -3px;
            left: -3px;
            right: -3px;
            bottom: -3px;
            border-radius: 50%;
            background: linear-gradient(45deg, #274fbd,rgb(30, 152, 209), #01d8fd);
            z-index: -1;
            opacity: 0.7;
        }

        .logo-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        .logo-container img {
            width: 100px;
            transition: all 0.3s ease;
        }

        .logo-container:hover img {
            transform: scale(1.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .input-group {
            background: rgba(255, 255, 255, 0.1) !important;
            border-radius: 15px !important;
            padding: 5px 15px !important;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-group:hover, .input-group:focus-within {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .input-group-text {
            background: transparent !important;
            border: none !important;
            color: rgba(255, 255, 255, 0.7) !important;
            padding-right: 15px !important;
        }

        .input-group-text i {
            font-size: 20px !important;
            color: rgba(255, 255, 255, 0.7) !important;
        }

        input {
            background: transparent !important;
            border: none !important;
            height: 50px !important;
            color: white !important;
            font-size: 16px !important;
            padding: 0 10px !important;
            width: 100% !important;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        input:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .forgot-password {
            text-align: right;
            margin-top: 8px;
        }

        .forgot-password a {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password a:hover {
            color: white !important;
            text-decoration: underline;
        }

        button {
            width: 100% !important;
            margin: 30px 0 !important;
            border: none !important;
            background: linear-gradient(45deg, #0099cc, #00b3d6) !important;
            height: 55px !important;
            color: white !important;
            border-radius: 15px !important;
            font-weight: bold;
            font-size: 16px !important;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            background: linear-gradient(45deg, #00b3d6, #0099cc) !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 153, 204, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .page-content {
                flex-direction: column;
            }
            
            .left-content {
                padding: 20px;
                text-align: center;
                height: 40vh;
                display: flex;
                align-items: center;
            }
            
            .right-content {
                width: 100%;
                min-height: 60vh;
                padding: 40px !important;
            }
            
            .title__heading1 {
                font-size: 30px !important;
            }

            .card-my form {
                padding: 20px;
            }
        }

        .text-center a:hover {
            color: white !important;
            text-decoration: underline !important;
        }
    </style>
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop>
            <source src="bgspark.mp4" type="video/mp4">
        </video>
    </div>

    <div class="page-content">
        <div class="left-content">
            <h1 class="title__heading1">The people<br><br>behind<br><br>exceptional<br><br>people.</h1>
        </div>

        <div class="right-content">
            <div class="card-my">
                <form method="POST" action="login.php" enctype="multipart/form-data">
                    <div class="logo-container">
                        <a href="index.php">
                            <img src="images/kenz-logo1.png" alt="Kenz Logo">
                        </a>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="email" required name="email" class="form-control" placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" required name="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <div class="forgot-password">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div>

                    <button type="submit" name="submit_form">
                        Sign In
                    </button>
                    
                    <div class="text-center" style="color: rgba(255, 255, 255, 0.7);">
                        Don't have an account? 
                        <a href="registration.php" style="color: #01d8fd; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
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
