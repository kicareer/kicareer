<?php
include 'config.php';
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
    <title>Registration</title>
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
        <section class="p-b-0" style="background:url(gplay.png) !important; min-height: 90vh">
            <div class="container-fluid">
                <style type="text/css">
                    .breadcrumb .active a{
                        color:#1778bc !important;
                        font-weight: 600 !important;
                    }
                    @media only screen and (min-width:1px) and (max-width:520px){
                      .card-left-img{
                        display: none;
                      }
                    }
                </style>
            </div>
        
        <div class="container-fluid">
            <div class="col-md-12" >
                <div class="row">
                    <div class="col-md-3">
                         <div class="card card-left-img" style="position: fixed;top:35%;left:25px;width:310px">
                            <center><img src="image/green-boy.c8b59289.svg" width="120px" style="margin-top:-40px"></center>
                             <div class=" p-20" >
                                  <center><h4> On registering, you can </h4></center>
                                  <ul style="list-style: none;text-align: center;">
                                      <li> <img src="image/accept.png" width="15px"> Build your profile and let recruiters find you</li>

                                      <li> <img src="image/accept.png" width="15px"> Get job postings delivered right to your email</li>

                                      <li><img src="image/accept.png" width="15px">
                                        Find a job and grow your career  
                                      </li>
                                  </ul>
                             </div>
                         </div>
                    </div>
                    <div class="col-md-9">
<form method="POST" enctype="multipart/form-data">
<article style="background:  !important">
    <div class="card card-article" style="cursor: pointer;">
        <h1>Find a job & grow your career</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label> Full Name *</label>
                    <input type="text" required="" class="form-control" name="name" placeholder="What is your name">
                </div>
                <div class="form-group">
                    <label> Email Id *</label>
                    <input type="email" required="" class="form-control" name="email" placeholder="Tell us your Email ID">
                </div>
                <div class="form-group">
                    <label> Password *</label>
                    <input type="password" id="pass" class="form-control" name="password" placeholder="*******">
                    <span style="font-size: 12px">Minimum 6 Characters required</span>
                </div>
                <div class="form-group">
                    <label> Confirm Password *</label>
                    <input type="password" id="c_pass" class="form-control" name="" placeholder="*******">
                     <div id="pass_err"></div>
                </div>
                <div class="form-group">
                    <label> Mobile Number *</label>
                    <input type="" placeholder="Enter your mobile number"   class="form-control" style="width: 80%;float: right;background: none !important" name="contact_number" required>
                    <select name="country_code" class="form-control" style="width:19%;" id="countryCode" required="">
                     
                    </select>
                </div>
            </div>
        </div>
            <style type="text/css">
                .select-css{ 
                    width: 300px !important;
                    float: left !important;
                    margin: 5px;
                    border: 1px solid #f2f2f2;
                    padding:10px;
                    border-radius: 0px 30px 0px 30px;
                }
                .select-css img{
                    margin-top: 5% !important;
                }
                @media only screen and (min-width:1px) and (max-width:520px){
                     .select-css{
                    
                    width:100% !important;}
                }
            </style>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label> Work Status</label>
                    <div  onclick="activeAc('dep_id')">
                        <div class="select-css" id="dep_id"> 
                            <center>
                              <img src="image/briefcase.png" width="25px">
                               <img src="image/check-circle.png" width="20px" id="showActive" style="float: right;margin-top:-3px !important;display: none">
                               <input type="radio" name="work_status" value="experienced">
                              <h5 class="m-t-10 m-b-0" style="line-height: 1.5"> I'm Experienced</h5>
                              <h6 class="m-0" style="line-height: 1.5">I have work experience (excluding internships)</h6>
                            </center>
                        </div>
                    </div>
                    <div  onclick="activeAc('fresher')">
                        <div class="select-css" id="fresher">
                            <center>
                              <img src="image/school-bag.png" width="25px"> 
                              <img src="image/check-circle.png" width="20px" id="showActive" style="float: right;margin-top:-3px !important;display: none">
                              <input type="radio" name="work_status" value="fresher">
                              <h5 class="m-t-10 m-b-0" style="line-height: 1.5"> I'm a Fresher</h5>
                              <h6 class="m-0" style="line-height: 1.5">I am a student/ Haven't worked after graduation</h6>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row m-t-10 float-right">
            <button class="btn" type="submit" name="submit" style="background:#457eff;border-color:#457eff;border-radius: 20px;float: right !important"> Register Now</button>
        </div>
        <div class="form-group m-t-10">
            <label>
                <input type="checkbox" class="form-control" name="whatsapp" placeholder="">Send me important updates on <img src="image/whatsappicon.0011d8c1.png" width="20px"> WhatsApp
            </label>
        </div>
        <span style="font-size: 13px;color: #3d9aff">By clicking Register, you agree to the Terms and Conditions & Privacy Policy of Kenz-innovations</span>
    </div>  
</article>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
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
    <script>
        Dropzone.autoDiscover = false;
        //Form 1
        var form2 = $('#fileUpload1');
        form2.dropzone({
            url: "http://polo/files/post",
            addRemoveLinks: true,
            maxFiles: 1,
            maxFilesize: 10,
            acceptedFiles: "image/*",
        });
        //Form 2
        var form2 = $('#fileUpload2');
        form2.dropzone({
            url: "http://polo/files/post",
            maxFilesize: 5,
            acceptedFiles: "image/*",
            previewsContainer: "#formFiles2",
            previewTemplate: $("#formTemplate2").html(),
        });
        //Form 3
        var form3 = $('#fileUpload3');
        form3.dropzone({
            url: "http://polo/files/post",
            maxFilesize: 5,
            acceptedFiles: "image/*",
            previewsContainer: "#formFiles3",
            previewTemplate: $("#formTemplate3").html(),
            clickable: ".dropzone-attach-files"
        });
    </script>



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
                $("#show_experience").hide();
            } else{
                selectedOption.style.color = "black";
                selectedOption.style.border = "2px solid #457eff";
                selectedOption.querySelector("#showActive").style.display = "block";
                $("#show_experience").show();
            }
        } 
    </script>
</body>
    
</html>
<?php
    if (isset($_POST['submit'])) {  
        // var_dump($_POST);
        // exit;       
        $name=htmlspecialchars(trim($_POST['name']));
        $email=htmlspecialchars(trim($_POST['email']));
        $password_encrypt=htmlspecialchars(trim($_POST['password']));
        $password=hash("sha256",$password_encrypt);
        $contact_number=htmlspecialchars(trim($_POST['contact_number']));
        $country_code=htmlspecialchars(trim($_POST['country_code']));
        $work_status=htmlspecialchars(trim($_POST['work_status']));
       
        $whatsapp=htmlspecialchars(trim($_POST['whatsapp']));
        $token = bin2hex(random_bytes(16));
        $check=$conn->prepare("SELECT email FROM emp_tbl WHERE email=:email");
        $check->bindparam(':email',$email);
        $check->execute();
        if($check->rowCount()>0){
           echo'<script>window.location.href="?email_exists"</script>';
        }else{
        $insert=$conn->prepare("INSERT INTO `emp_tbl`(
                  name,
                  email,
                  password,
                  contact_number,
                  country_code,
                  work_status,
                  whatsapp,
                  token
                  )VALUES(
                  :name,
                  :email,
                  :password,
                  :contact_number,
                  :country_code,
                  :work_status,
                  :whatsapp,
                  :token
                )");
        $insert->bindparam(':name',$name);
        $insert->bindparam(':email',$email);
        $insert->bindparam(':password',$password);
        $insert->bindparam(':contact_number',$contact_number);
        $insert->bindparam(':country_code',$country_code);
        $insert->bindparam(':work_status',$work_status);
        $insert->bindparam(':whatsapp',$whatsapp);
        $insert->bindparam(':token',$token);

         // Execute the query
         if ($insert->execute()) {
            // Send confirmation email
            // (PHPMailer code goes here, unchanged)

	            
// Create a new PHPMailer instance
$mail = new PHPMailer(true);


$verificationLink = "https://ki-careers.com/verify.php?token=$token";

try {
    // Gmail SMTP server configuration
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                        // Set the SMTP server to Gmail's server
    $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
    $mail->Username   = 'kicareer01@gmail.com';                  // Your Gmail address
    $mail->Password   = 'myen caef fslf jiyw';                   // Your Gmail password or App Password
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; use ENCRYPTION_SMTPS for SSL
    $mail->Port       = 587;                                     // TCP port for TLS (587), or 465 for SSL

    // Recipients
    $mail->setFrom('kicareer01@gmail.com', 'KI Careers');         // Set the sender's email and name
    $mail->addAddress($email, $name); // Add a recipient

    // Content
    $mail->isHTML(true);                                         // Set email format to HTML
    $mail->Subject = 'Welcome to KI Careers Portal';
    $mail->Body    = '
                        <html>
                          <body>
                          <div style="background-color: #F0F0F0 ;padding:20px; border-radius:4px">
                              <div style="background-color: #fff; border-radius: 10px; padding:20px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                  

                                  <div style="color:black; ">
                                    <span> Hi '.$name.',<br> Welcome to KI Careers, you are now successfully registered.<br><br>
                                    <p>Thank you for registering on our website. Please click the link below to verify your email address:</p>
    <p>
        <a href="'.$verificationLink.'" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Verify Email
        </a>
    </p>
    <p>If you did not create an account, no further action is required.</p>
    <p>Thank you!</p>
                                    <br><br>
                                    <h3>Regards,</h3>
                                    <p>KI Careers Team</p>
                                  </div>
                              </div><br>
                          </div>
                          </body>
                        </html>
                      ';
    $mail->AltBody = 'Welcome to KI Careers, thankyou for registering with us';

    // Send the email
    if($mail->send()){
        ?>
    <script type="text/javascript">
        alert('Welcome to KI Careers, thankyou for registering with us, please check your email address for further instructions.');
        window.location.href="login.php";
    </script>
        <?php
    }
    echo 'Message has been sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

        } else {
            echo '<script type="text/javascript">alert("Something went wrong, please try again");</script>';
        }
    }
    }
?>

<script type="text/javascript">
    var current_country = '';
                const apiKey = "ZlkzaVR5cHRkaHkwRnNGQXlzVDRHWDVCT0w3NmxlOWtMaFk0NVNCdg==";
                const headers = new Headers();
                headers.append("X-CSCAPI-KEY", apiKey);

                const requestOptions = {
                    method: 'GET',
                    headers: headers,
                    redirect: 'follow'
                };

                // Fetch and populate countries with the specified format
                fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
                    .then(response => response.json())
                    .then(countries => {
                        const countrySelect = document.getElementById('countryCode');
                        countries.forEach(country => {
                            const option = document.createElement('option');
                            option.value = country.phonecode; // Use phone code as value
                            option.setAttribute('data-countryCode', country.iso2); // Set ISO code as data attribute
                            option.textContent = `${country.name} (+${country.phonecode})`; // Display country name with phone code
                            countrySelect.appendChild(option);
                        });
                    }).then(response => {
                        fetch('https://ipinfo.io/json?token=05d29092b4fb6b') // Replace with your ipinfo.io token
                            .then(response => response.json())
                            .then(data => {
                                // console.log(data.region)
                                const country = data.country; // e.g., "US", "IN", etc.
                                const select = document.getElementById('countryCode');
                                current_country = country;
                                console.log(current_country);
                                // Loop through options to find the matching country code
                                for (let i = 0; i < select.options.length; i++) {
                                    // console.log(select.options[i].dataset.countrycode)
                                    if (select.options[i].dataset.countrycode === country) {
                                        select.selectedIndex = i;
                                        break;
                                    }
                                }
                            }).then(response => {
                                fetch(`https://api.countrystatecity.in/v1/countries/${current_country}/states`, requestOptions)
                                    .then(response => response.json())
                                    .then(states => {
                                        const stateSelect = document.getElementById('state');
                                        stateSelect.innerHTML = '<option value="">Select State</option>'; // Clear previous options
                                        states.forEach(state => {
                                            const option = document.createElement('option');
                                            option.value = state.iso2;
                                            option.textContent = state.name;
                                            stateSelect.appendChild(option);
                                        });
                                    })

                            })
                            .catch(error => console.log('Error fetching countries:', error));

                    })

    </script>