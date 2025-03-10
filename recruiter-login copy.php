<?php
// include('classes/posts.php');
include('config.php');

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
    <title>Recruiter Login</title>
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
       body{
        min-height: 90vh !important;
       }
    }
    #error{
        color: red !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        margin-bottom: 10px !important;
        /* display: none; */
        <?php
        if(isset($_GET['invalid-email']) || isset($_GET['invalid-password'])){
            
        }
        else{
            echo "display: none !important;";
        }
    ?>
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
        <section class="p-b-0" style="background:url(gplay.png) !important;height: 90vh;">
            <div class="container" >
                <div class="col-md-12 mb-marg" >
                    <div class="row ">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 border">
                            <form method="POST" enctype="multipart/form-data">
                                <article>
                                    <div class="p-0 card-article" style="cursor: pointer;">
                                        <h4>Recruiter Login</h4>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" required="" placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <label> Password</label>
                                            <input type="password" class="form-control" name="password" required="" placeholder="*******">
                                            <span style="font-size: 12px;float: right"> <a href="#"> Forgot Password ?</a></span>
                                        </div>
                                        <div class="row m-t-30 m-b-10 ">
                                          <div class="col-md-12">
                                              <button class="btn" type="submit" name="submit_form" style="background:#457eff;border-color:#457eff;border-radius: 0px;width: 200px"> Login</button>
                                          </div>
                                        </div>
                                       
                                       <p style="font-size: 12px"> Don't have an account? <a href="recruiter-registration.php">Register Now</a></p>
                                      <p style="font-size: 12px; color: red; text-align: center" id="error">Invalid Email or Password </p>
                                    </div>
                                </article>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </section>
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
<?php
    if (isset($_POST['submit_form'])) {
        $email=htmlspecialchars(trim($_POST['email']));
        $password=htmlspecialchars(trim($_POST['password']));
        $password=hash('sha256', $password);
        $check=$conn->prepare("SELECT * FROM recruiter_tbl WHERE email=:p1");
        $check->bindparam(':p1',$email);
        $check->execute();
        
        if($check->rowCount()==1){
            $fetch=$check->fetch(PDO::FETCH_ASSOC);
            if ($fetch['password']==$password) {
                // Set session variables for all $fetch data
                // if($fetch['status']=='pending'){
                //     echo '<script>alert("Your account is pending for approval. Please check your registered email")</script>';
                //     echo '<script>window.location.href="recruiter-login.php"</script>';
                //     exit;
                // }
               
                $_SESSION['kenz_recruiter']=$fetch['id'];
                $_SESSION['employer_id']=$fetch['employer_id'];
                $stmt=$conn->prepare("SELECT * FROM employer_tbl WHERE id=:employer_id");
                $stmt->bindparam(':employer_id',$fetch['employer_id']);
                $stmt->execute();
                $company=$stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['company_name']=$company['company_name'];
                $_SESSION['company_description']=$company['company_description'];
                $_SESSION['company_address']=$company['company_address'];
                $_SESSION['company_logo']=$company['company_logo'];
            
                // exit;
                foreach ($fetch as $key => $value) {
                    $_SESSION[$key] = $value;
                }
                $_SESSION['logged_in'] = 1;
                echo '<script>window.location.href="employer/index.php"</script>';
            }else{
                echo '<script>window.location.href="?invalid-password"</script>';
            }
        }
        echo '<script>window.location.href="?invalid-email"</script>';
    }           
?>
