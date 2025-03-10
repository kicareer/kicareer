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
    }

    video {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ensures video covers the screen */
      transform: translate(-50%, -50%);
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


  section ul{
    list-style-type: disc;
    padding-left: 20px;
    margin-bottom: 10px;
  }

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
        <h1 class="mb-4">Terms and Conditions</h1>
        
        <div class="content">
            <h4>Last Updated: <?php echo date('F d, Y'); ?></h4>

            <section class="mb-4">
                <h5>1. Acceptance of Terms</h5>
                <p>By accessing and using KI Careers, you agree to be bound by these Terms and Conditions. If you do not agree to these terms, please do not use our services.</p>
            
                <h5>2. User Accounts</h5>
                <p>Users must:</p>
                <ul>
                    <li>Provide accurate and complete information</li>
                    <li>Maintain the security of account credentials</li>
                    <li>Not share accounts with others</li>
                    <li>Update information as needed</li>
                </ul>
            
                <h5>3. Job Postings and Applications</h5>
                <p>Users agree to:</p>
                <ul>
                    <li>Submit accurate information in job applications</li>
                    <li>Not submit false or misleading information</li>
                    <li>Not apply for jobs using multiple accounts</li>
                    <li>Respect employer requirements and qualifications</li>
                </ul>
            
                <h5>4. Employer Responsibilities</h5>
                <p>Employers must:</p>
                <ul>
                    <li>Post legitimate job opportunities</li>
                    <li>Provide accurate job descriptions</li>
                    <li>Comply with employment laws</li>
                    <li>Maintain confidentiality of applicant information</li>
                </ul>
            
                <h5>5. Prohibited Activities</h5>
                <p>Users may not:</p>
                <ul>
                    <li>Violate any applicable laws or regulations</li>
                    <li>Harass or discriminate against others</li>
                    <li>Submit malicious content or software</li>
                    <li>Attempt to breach platform security</li>
                </ul>
            
                <h5>6. Intellectual Property</h5>
                <p>All content on KI Careers is protected by copyright and other intellectual property rights. Users may not copy, modify, or distribute content without permission.</p>
            
                <h5>7. Limitation of Liability</h5>
                <p>KI Careers is not liable for:</p>
                <ul>
                    <li>User-generated content</li>
                    <li>Employment decisions</li>
                    <li>Disputes between users</li>
                    <li>Service interruptions</li>
                </ul>
            
                <h5>8. Changes to Terms</h5>
                <p>We reserve the right to modify these terms at any time. Continued use of the platform constitutes acceptance of updated terms.</p>
            
                <h5>9. Contact Information</h5>
                <p>For questions about these Terms and Conditions, contact us at:</p>
                <p>Email: legal@kicareers.com<br>
                Phone: +1 (XXX) XXX-XXXX</p>
            </section>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html> 