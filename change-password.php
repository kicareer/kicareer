<?php
include('config.php');
if(isset($_SESSION['id'])){
$id=htmlspecialchars(trim($_SESSION['id']));
$fetch=$conn->prepare("SELECT * FROM emp_tbl WHERE id=:id");
$fetch->bindparam(':id', $id);
$fetch->execute();
$key=$fetch->fetch(PDO::FETCH_ASSOC);
}
else{
    header('location: login.php');
    exit;
}
// var_dump($key);
// exit;
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
    <title>Edit Profile</title>
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

        </style>

<body>
   
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
       <?php
       include'header.php';
       ?>
        <!-- end: Header -->
       
        <div class="container-fluid">
            <div class="col-md-12">
            <div class="row" style="min-height: 600px">

                <div class="col-md-2">
               
                </div>
                <div class="col-md-8" >
                <?php
                    if(isset($_GET['password_matched'])){
                        ?>
                            <form method="POST" enctype="multipart/form-data">
                                <article style="background: white !important">
                                    <div class="card card-article" style="cursor: pointer;">
                                        <h3>Password matched</h3>
                                        <div class="row" style="padding-top: 40px">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label>New password</label>
                                                    <input type="password" id="pass" class="form-control" required placeholder="*****" name="new_password">
                                                </div>

                                                <div class="form-group">
                                                    <label>Confirm password</label>

                                                    <input type="password" id="c_pass" required="" class="form-control" name="" placeholder="******">
                                                </div>

                                                
                                                <div class="row m-t-10 float-right">
                                                    <button class="btn" type="submit" name="change_password" style="background:#457eff;border-color:#457eff;border-radius: 20px;float: right !important"> Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </form>

                        <?php
                    }
                    else{
                        ?>
                        <form method="POST">
                            <article style="background: white !important">
                            <div class="card card-article" style="cursor: pointer;">
                                <h3> Change Password</h3>
                                <div class="row" style="padding-top: 40px">

                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Present password</label>
                                            <input type="password" class="form-control" placeholder="******" name="previous_password">
                                        </div>
                                        <?php
                                            if(isset($_GET['invalid_password'])){
                                                echo'
                                                    <div style="color: red;" ><small><i class="fas fa-info-cirlce" ></i>Invalid password, please try again</small></div>

                                                ';
                                            }
                                            
                                        ?>

                                        <center>
                                        <button class="btn btn-sm adding-btn" type="submit" name="check_password"  > Submit</button>
                                        </center>   
                                    </div>
                                </div>
                            </div>
                            </article>
                        </form>
                        <?php
                    }
                ?>
                </div>
                <div class="col-md-3"></div>
                
            </div>
        </div>
        </div>
        
        <?php include_once 'footer.php'; ?>
    </div>
    <!-- end: Body Inner -->
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <!--Tdep_idlate functions-->
    <script src="js/functions.js"></script>
    <script type="text/javascript">
        $("#c_pass").on("keyup keydown paste change",function(){
          var pass=$("#pass").val();
          var c_pass=$("#c_pass").val();
          if (pass==c_pass) {
            $("#pass_err").html('');
            $("#submit").show();
          }else{
            $("#pass_err").html('<small style="color:red"><i class="fas fa-info-circle"></i> Passwords dont match</small>');
            $("#submit").hide();
          }
        });
    </script>
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
    <script src="plugins/dropzone/dropzone.js"></script>

    <script type="text/javascript">
        function activeAc(dep_id){
            var elements = document.getElementsByClassName("select-css");
            for (var i = 0; i < elements.length; i++) {
                if (elements[i].id !== dep_id) {
                    elements[i].style.color = "#303030";
                    elements[i].style.border = "1px solid #f2f2f2";
                    elements[i].querySelector("#showActive").style.display = "none";
                }
            }
            var selectedOption = document.getElementById(dep_id);
            if (selectedOption.style.color === "black") {
                selectedOption.style.border="1px solid #f2f2f2";
                selectedOption.style.color = "#303030";
                selectedOption.querySelector("#showActive").style.display = "none";
            } else{
                selectedOption.style.color = "black";
                selectedOption.style.border = "2px solid #457eff";
                selectedOption.querySelector("#showActive").style.display = "block";
            }
        } 
    </script>
</body>
</html>


<?php

if (isset($_POST['check_password'])) {
    // var_dump($_POST);
    
    $previous_password=htmlspecialchars(trim($_POST['previous_password']));
     $previous_password=hash("sha256",$previous_password);
    // exit;
    // $id=htmlspecialchars(trim($_SESSION['id']));
    // $check=$conn->prepare("SELECT password FROM emp_tbl WHERE id=:id");
    // $check->bindparam(':id',$id);
    // $check->execute();
    // var_dump($key['password']);
    // exit;
    $key_password=$key['password'];
    if($key_password==$previous_password){
        echo'<script>window.location.href="?password_matched&login&id='.$id.'"</script>';
    }
    else{
        echo'<script>window.location.href="?invalid_password&login&id='.$id.'"</script>';
    }
}
if(isset($_POST['change_password'])){
        $id=htmlspecialchars(trim($_GET['id']));
        $new_password=htmlspecialchars(trim($_POST['new_password']));
        $new_password=hash("sha256",$new_password);
    
        $update=$conn->prepare("UPDATE emp_tbl SET password=:new_password WHERE id=:id");
        $update->bindparam(':new_password',$new_password);
        $update->bindparam(':id',$id);
        $update->execute();
        if($update){
            echo '<script>window.location.href="index.php?&login&id='.$id.'"</script>';
        }
    }
?>