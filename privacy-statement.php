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
    .video-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      &::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
        z-index: 1;
      }
    }

    video {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ensures video covers the screen */
      transform: translate(-50%, -50%);
      filter: brightness(0.7); /* Adjust brightness as needed */
    }

    .content-overlay {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: left;
      color: white;
      width: 100%;
      padding-left: 10%;
      z-index: 2; /* Ensures it's above the video */
    }
    section ul{
    list-style-type: disc;
    padding-left: 20px;
    margin-bottom: 10px;
  }

    @media (max-width: 768px) {
      .title__heading1 {
        font-size: 1.5rem;
      }
       .content-overlay {
        width: 100%;
       }
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

@keyframes gradient-overflow {
  0% {
    background-position: 0 50%; }
  50% {
    background-position: 100% 50%; }
  100% {
    background-position: 0 50%; } }


</style>
<body>
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <h1>Privacy Statement</h1>
        
        <div class="content">
            <h4>Last Updated: <?php echo date('F d, Y'); ?></h4>
            
            <section>
                <h5>1. Information We Collect</h5>
                <p>At KI Careers, we collect the following types of information:</p>
                <ul>
                    <li>Personal information (name, email address, phone number)</li>
                    <li>Professional information (resume, work history, education)</li>
                    <li>Account credentials</li>
                    <li>Job application history</li>
                    <li>Website usage data</li>
                </ul>
            
                <h5>2. How We Use Your Information</h5>
                <p>We use your information to:</p>
                <ul>
                    <li>Process job applications</li>
                    <li>Match candidates with potential employers</li>
                    <li>Communicate about job opportunities</li>
                    <li>Improve our services</li>
                    <li>Ensure platform security</li>
                </ul>
            
                <h5>3. Information Sharing</h5>
                <p>We share your information with:</p>
                <ul>
                    <li>Potential employers (when you apply for jobs)</li>
                    <li>Service providers who assist our operations</li>
                    <li>Legal authorities when required by law</li>
                </ul>
            
                <h5>4. Data Security</h5>
                <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, or disclosure.</p>
            
                <h5>5. Your Rights</h5>
                <p>You have the right to:</p>
                <ul>
                    <li>Access your personal information</li>
                    <li>Correct inaccurate information</li>
                    <li>Request deletion of your information</li>
                    <li>Opt-out of marketing communications</li>
                </ul>
            
                <h5>6. Contact Us</h5>
                <p>If you have questions about this Privacy Statement, please contact us at:</p>
                <p>Email: privacy@kicareers.com<br>
                Phone: +1 (XXX) XXX-XXXX</p>
            </section>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html> 