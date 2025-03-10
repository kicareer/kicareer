
<?php include '../config.php'; ?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="./assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | KI Careers</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../images/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="./assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="./assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="./assets/js/config.js"></script>
  </head>
<style type="text/css">
    .kenz-btn {
        border: 1px solid #ececec !important;
        border-radius: 5px;
        background-color: #ffffff !important;
        margin: 10px;
        color: black !important;
        box-shadow: 0 0 5px 0 rgba(154, 161, 191, 0.45);
    }
    .cardstyle {
        padding: 10px !important;
        color: black !important;
    }
    .accordion .ac-item .ac-title:before {
        display: none;
    }
    .ac-title i {
        margin-right: -20px !important;
        font-size: 22px;
        margin-top: 2px;
    }
    .card-article {
        padding: 30px 30px !important;
    }
</style>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <section class="p-b-0" style="background:url(../gplay.png) !important; height: 90vh; background-repeat: repeat-x">
            <div class="container">
                <div class="col-md-12">
                    <div class="row ">
                        <div class="col-md-3 p-0 "></div>
                        <div class="col-md-6 p-0 mt-5" style="z-index: 99; background: #fff !important">
                            <form method="POST" action="login.php" enctype="multipart/form-data">
                                <article>
                                    <div class="p-0 card-article" style="cursor: pointer;">
                                        <h4>Admin Login</h4>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" required class="form-control" name="username" placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" required class="form-control" name="password" placeholder="*******">
                                        </div>
                                        <div class="row m-t-30 m-b-10 ">
                                            <div class="col-md-12">
                                                <center>
                                                    <button class="btn" type="submit" name="submit_form" style="background:#457eff;border-color:#457eff;border-radius: 0px;width: 200px; color: #fff; margin-top: 10px"> Login</button>
                                                </center>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </article>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    
    <!-- Plugins -->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <!-- Template functions -->
    <script src="js/functions.js"></script>

    <?php
        // Handle login form submission
        if (isset($_POST['submit_form'])) {

            
            $_SESSION['logged_in'] = false;
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
            $password = hash('sha256', $password);

            $check = $conn->prepare("SELECT * FROM admin WHERE username = :p1");
            $check->bindParam(':p1', $username);
            $check->execute();

            if ($check->rowCount() == 1) {
              
                $fetch = $check->fetch(PDO::FETCH_ASSOC);

                if ($fetch['password'] == $password) {
                    // var_dump($_POST);
                    // exit;
                   // Set session variables for the admin
                    foreach ($fetch as $key => $value) {
                        $_SESSION[$key] = $value;
                    }
                    $_SESSION['logged_in'] = true;
                    $_SESSION['admin_id'] = $fetch['id'];
                    $_SESSION['logged_in_as'] = 'admin';

                    echo '<script>window.location.href="index.php"</script>';
                } else {
                    echo '<script>alert("Invalid Email or Password")</script>';
                }
            } else {
                echo '<script>alert("Invalid Email or Password")</script>';
            }
        }
    ?>
</body> 
</html>
