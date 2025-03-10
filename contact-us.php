<?php
include('config.php');
include './DbConnect.php';
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

   <div>
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">Let's Get In Touch!!!!</h2>
                    <hr class="divider my-4" />
                    <p class="text-muted mb-5">Ready to start your next project with us? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 text-center">
                    <form id="contactForm" method="POST" action="" name="sentMessage">
                        <div class="row">
                            <div class="col-md-12">
                        <div class="form-group">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" id="countryCode" name="country_code" required>
                                    <option value="">Country Code *</option>
                                    <option value="+1">+1</option>
                                    <option value="+91">+91</option>
                                    <option value="+44">+44</option>
                                    <option value="+61">+61</option>
                                    <option value="+1">+1</option>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone *" required>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <textarea class="form-control" id="message" name="message" placeholder="Your Message *" required></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                        <div id="success"></div>
                        <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit" name="submit">Send Message</button>
                    </div>
                </div>
                    </form>
                </div>
            </div>
            <br><br><br><br><br><br>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-phone fa-3x mb-3"></i>
                    <div>+91 (202) 123-4567</div>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fas fa-envelope fa-3x mb-3"></i>
                    <!-- Make sure to change the email address in BOTH the anchor text and the link target below! -->
                    <a class="d-block" href="mailto:info@ki-careers.com">info@ki-careers.com</a>
                </div>
            </div>
        </div>
    </section>
   

</div>

   
<?php
include('footer.php');
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
    <?php
//   var_dump($_REQUEST);
//   exit;
if(isset($_POST['submit'])){
  
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country_code = $_POST['country_code'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    $stmt = $connection->prepare("INSERT INTO contact_us (name, email, country_code, phone, message, create_at) VALUES (:name, :email, :country_code, :phone, :message, NOW())");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':country_code', $country_code);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':message', $message);
    // $stmt->execute();
    
    if ($stmt->execute()) {
        echo "<script>alert('Query Submitted successfully!!!'); window.location.href='contact-us.php'; </script>";
       
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
</body>

</html>