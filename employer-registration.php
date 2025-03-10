<?php
include('classes/posts.php');
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
error_reporting(E_ERROR);

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
    <title>Employer Registration</title>
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css?v=1.0.1" rel="stylesheet">


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

    .innercard {
        color: black !important;
        border-left: 1px !important;
        margin-right: 5px !important;

    }

    .accordion .ac-item .ac-title:before {
        display: none
    }

    .ac-title i {
        margin-right: -20px !important;
        font-size: 22px;
        margin-top: 2px;
    }

    .card-article {
        padding: 30px 30px !important;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .feature-list li {
        padding: 8px 15px;
        position: relative;
    }

    .feature-list li i {
        margin-right: 10px;
    }

    .price-section {
        padding: 20px 0;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .modal-content {
        border: none;
        border-radius: 15px;
    }

    .modal-header {
        border-bottom: none;
        padding: 20px 30px;
    }

    .modal-body {
        padding: 20px 30px;
    }

    .btn-primary:hover {
        background: #3461cc !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(69, 126, 255, 0.4);
    }

    .modal-xl {
        max-width: 1200px; /* Increased modal width */
    }

    .feature-list li {
        padding: 12px 15px;
        background: #f8f9fa;
        margin-bottom: 8px !important;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .feature-list li:hover {
        background: #eef2ff;
    }

    .price-section {
        padding: 30px 0;
        margin: 0 -24px 24px -24px;
        background: #eef2ff;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .price-section h2 {
        font-size: 2.5rem;
        margin-bottom: 5px;
    }

    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    .modal-content {
        background: #ffffff;
        border: none;
    }

    .modal-header {
        background: #f8f9fa;
        padding: 1.5rem 2rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(69, 126, 255, 0.4);
    }
</style>

<body>

    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
        <?php
        include 'header.php';
        ?>
        <!-- end: Header -->
        <section class="p-b-0" style="background:url(gplay.png) !important;height: 90vh; padding:0%; overflow-y: auto;">
            <div class="container-fluid">
                <style type="text/css">
                    .breadcrumb .active a {
                        color: #1778bc !important;
                        font-weight: 600 !important;
                    }

                    @media only screen and (min-width:1px) and (max-width:520px) {
                        .card-left-img {
                            display: none;
                        }
                    }
                </style>

            </div>


            <div class="container-fluid">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <article style="background: #fff !important">
                                    <div class="card card-article" style="cursor: pointer;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h1>Want to join as an employer?</h1>
                                            <button type="button" style="background:#457eff;" class="btn" data-toggle="modal" data-target="#viewPlansModal">View Plans</button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Full Name *</label>
                                                    <input type="text" required="" class="form-control" name="name" placeholder="What is your name" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Company Logo</label>
                                                    <input type="file" required="" class="form-control" name="company_logo" placeholder="Upload Logo" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Id *</label>
                                                    <input type="email" required="" class="form-control" name="email" placeholder="Your Email ID" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <input type="text" 
                                                                   class="form-control" 
                                                                   name="country_code" 
                                                                   id="countryCode" 
                                                                   list="countryCodeList" 
                                                                   placeholder="Select Country Code"
                                                                   autocomplete="off">
                                                            <datalist id="countryCodeList" autocomplete="off">
                                                                <!-- Will be populated via JavaScript -->
                                                            </datalist>
                                                        </div>
                                                        <input type="text" class="form-control" onchange="this.value = this.value.replace(/[^0-9]/g, '')" name="contact_number" placeholder="Mobile Number" onfocusout="this.value = this.value.replace(/^0+/, '')" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" id="pass" required="" class="form-control" name="password" placeholder="********" autocomplete="off">
                                                    <span style="font-size: 12px">Minimum 6 Characters required</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" id="c_pass" class="form-control" name="confirm_password" placeholder="*******" autocomplete="off">
                                                </div>
                                                <div id="pass_err"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Company Name *</label>
                                                    <input type="text" class="form-control" required="" name="company_name" placeholder="Enter Your Company Name" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Designation *</label>
                                                    <input type="text" class="form-control" name="designation" placeholder="Enter Your Designation" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Company Description *</label>
                                                    <textarea type="text" required="" class="form-control" name="company_description" placeholder="Enter Company Description" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Company Address</label>
                                                    <textarea type="text" required="" class="form-control" name="company_address" placeholder="Enter Company Address" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <input type="text" 
                                                           class="form-control" 
                                                           name="company_country" 
                                                           id="country" 
                                                           list="countryList" 
                                                           placeholder="Select Country"
                                                           autocomplete="off">
                                                    <datalist id="countryList">
                                                        <!-- Will be populated via JavaScript -->
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" 
                                                           class="form-control" 
                                                           name="company_state" 
                                                           id="state" 
                                                           list="stateList" 
                                                           placeholder="Select State"
                                                           autocomplete="off">
                                                    <datalist id="stateList">
                                                        <!-- Will be populated via JavaScript -->
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" 
                                                           class="form-control" 
                                                           name="city" 
                                                           id="city" 
                                                           list="cityList" 
                                                           placeholder="Select City"
                                                           autocomplete="off">
                                                    <datalist id="cityList">
                                                        <!-- Will be populated via JavaScript -->
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pincode</label>
                                                    <input type="text" class="form-control" name="company_pincode" placeholder="Enter Pincode" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Subdomain Name *</label>
                                                    <div class="input-group">
                                                        <input type="text" 
                                                               class="form-control" 
                                                               required="" 
                                                               name="subdomain" 
                                                               id="subdomain"
                                                               pattern="[a-z0-9]+" 
                                                               title="Only lowercase letters and numbers allowed"
                                                               placeholder="Enter desired subdomain"
                                                               autocomplete="off">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.ki-careers.com</span>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">This will be your company's URL: <span id="subdomain-preview">yourcompany</span>.ki-careers.com</small>
                                                    <div id="subdomain-message"></div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Default Currency *</label>
                                                    <input type="text" 
                                                           class="form-control" 
                                                           name="default_currency" 
                                                           id="currency" 
                                                           list="currencyList" 
                                                           placeholder="Select Currency"
                                                           required
                                                           autocomplete="off">
                                                    <datalist id="currencyList">
                                                        <!-- Will be populated via JavaScript -->
                                                    </datalist>
                                                    <script>
        async function fetchCurrencies() {
            try {
                const response = await fetch("https://restcountries.com/v3.1/all");
                const countries = await response.json();

                const currencySet = new Set(); // To store unique currency codes
                countries.forEach(country => {
                    if (country.currencies) {
                        Object.keys(country.currencies).forEach(currencyCode => {
                            const currencyName = country.currencies[currencyCode].name;
                            currencySet.add(`${currencyCode} - ${currencyName}`);
                        });
                    }
                });
                // console.log(currencySet);
                const currencyList = document.getElementById("currencyList");
                currencySet.forEach(currency => {
                    let currencyCode = currency.split(" - ")[0];
                    let currencyName = currency.split(" - ")[1];
                    let option = document.createElement("option");
                    option.value = currencyCode;
                    option.textContent = currencyName;
                    currencyList.appendChild(option);
                });

            } catch (error) {
                console.error("Error fetching currencies:", error);
            }
        }

        fetchCurrencies();
    </script>
                                                    <small class="text-muted">This currency will be used for all your job postings</small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn" type="submit" name="submit" style="background:#457eff;border-color:#457eff;border-radius: 20px;float: right !important">Register Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </form>

                        </div>
                        <div class="col-md-2"></div>

                    </div>
                </div>
            </div>


        </section>
        <script>
            let countryCode = '';
            let stateCode = '';
            const apiKey = "ZlkzaVR5cHRkaHkwRnNGQXlzVDRHWDVCT0w3NmxlOWtMaFk0NVNCdg==";
            const headers = new Headers();
            let current_country = '';
            headers.append("X-CSCAPI-KEY", apiKey);

            const requestOptions = {
                method: 'GET',
                headers: headers,
                redirect: 'follow'
            };

            // Fetch and populate countries
           
// Fetch countries
fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
    .then(response => response.json())
    .then(countries => {
        const countrySelect = document.getElementById('countryList');
        const countryCode = document.getElementById('countryCodeList');

        countries.forEach(country => {
            const option = document.createElement('option');
            const option2 = document.createElement('option');

            option2.value = `+${country.phonecode}`;
            option2.setAttribute('data-countrycode', country.iso2);
            option2.setAttribute('data-phonecode', country.phonecode);
            // option2.textContent = `+${country.phonecode}`;
            countryCode.appendChild(option2);

            option.value = country.name;  // Use ISO2 code instead of country name
            option.setAttribute('data-countrycode', country.iso2);
            option.setAttribute('data-phonecode', country.phonecode);
            option.textContent = country.name;
            countrySelect.appendChild(option);
        });

       return fetch('https://ipinfo.io/json?token=05d29092b4fb6b') // Get user's country
    })
    .then(response => response.json())
    .then(data=> {
        countryCode = data.country;
        // console.log(countryCode,'countryCode');
        return fetch(`https://restcountries.com/v3.1/alpha/${data.country}`)
    })
    .then(response => response.json())
    .then(data => {
        // console.log(data[0]);
        const userCountry = data[0].name.common;

        const callingCode = `${data[0].idd.root}${data[0].idd.suffixes ? data[0].idd.suffixes[0] : ''}`;
        console.log(callingCode,'callingCode');
        document.getElementById('countryCode').value = callingCode;
        const countrySelect = document.getElementById('country');
        // console.log(userCountry);
        // Set the selected country
        countrySelect.value = userCountry;

        // Get corresponding phone code
        //const selectedOption = countrySelect.options[countrySelect.selectedIndex];
        // const phonecode = selectedOption.getAttribute('data-phonecode');
        // document.getElementById('countryCode').value = phonecode;

        return fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states`, requestOptions);
    })
    .then(response => response.json())
    .then(states => {
        // console.log(states,'states');
        const stateSelect = document.getElementById('stateList');
        stateSelect.innerHTML = '<option value="">Select State</option>'; // Clear previous options

        states.forEach(state => {
            const option = document.createElement('option');
            option.value = state.name;
            option.setAttribute('data-stateCode', state.iso2);
            option.textContent = state.name;
            stateSelect.appendChild(option);
        });
    })
    .catch(error => console.error("Error fetching data:", error));


          // Fetch and populate states based on selected country
document.getElementById('country').addEventListener('change', function() {

    // console.log(this.value);
    // console.log(countryCode);
    document.getElementById('state').value = '';
    document.getElementById('city').value = '';
    let options =  document.getElementById('countryList').options;
    // console.log(options);
    // let optionValye = options[options.selectedIndex].getAttribute('data-countrycode');
    for (let option of options) {
            if (option.value === this.value) {
                countryCode = option.dataset.countrycode;
                // let year = option.dataset.year;
                // console.log(`Selected: ${this.value}, Country: ${countryCode}`);
                break;
            }
        }
    

    fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states`, requestOptions)
        .then(response => response.json())
        .then(states => {
            const stateSelect = document.getElementById('stateList');
            stateSelect.innerHTML = '<option value="">Select State</option>'; // Clear previous options
            // console.log(states);
            states.forEach(state => {
                const option = document.createElement('option');
                option.value = state.name;
                option.setAttribute('data-statecode', state.iso2);
                option.textContent = state.name;
                stateSelect.appendChild(option);
            });
        })
        .catch(error => console.log('Error fetching states:', error));
});

// Fetch and populate cities based on selected state
document.getElementById('state').addEventListener('change', function() {
    // const countryCode = document.getElementById('country').options[document.getElementById('country').selectedIndex].getAttribute('data-countrycode');
    // const stateCode = this.options[this.selectedIndex].getAttribute('data-statecode');
    document.getElementById('city').value = '';
    let options =  document.getElementById('stateList').options;
    // console.log(options);
    // let optionValye = options[options.selectedIndex].getAttribute('data-countrycode');
    for (let option of options) {
        if (option.value === this.value) {
            stateCode = option.dataset.statecode;
            // console.log(`Selected: ${this.value}, State: ${stateCode}`);
            break;
        }
    }

    if (!stateCode) return; // Prevent API call if no state is selected

    fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states/${stateCode}/cities`, requestOptions)
        .then(response => response.json())
        .then(cities => {
            const citySelect = document.getElementById('cityList');
            citySelect.innerHTML = '<option value="">Select City</option>'; // Clear previous options

            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.name;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        })
        .catch(error => console.log('Error fetching cities:', error));
});

        </script>

        <!-- end: Body Inner -->
        <!-- Scroll top -->
        <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
        <!--Plugins-->
        <script src="js/jquery.js"></script>
        <script src="js/plugins.js"></script>
        <!--Tdep_idlate functions-->
        <script src="js/functions.js"></script>
        <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
        <script src="plugins/dropzone/dropzone.js"></script>
        <script type="text/javascript">
            $("#c_pass").on("keyup keydown paste change", function() {
                var pass = $("#pass").val();
                var c_pass = $("#c_pass").val();
                if (pass == c_pass) {
                    $("#pass_err").html('');
                    $("#submit").show();
                } else {
                    $("#pass_err").html('<small style="color:red"><i class="fas fa-info-circle"></i> Passwords dont match</small>');
                    $("#submit").hide();
                }
            });
        </script>
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
        <script>
        document.getElementById('subdomain').addEventListener('input', function(e) {
            // Convert to lowercase and remove special characters
            let value = this.value.toLowerCase().replace(/[^a-z0-9]/g, '');
            this.value = value;
            
            // Update preview
            document.getElementById('subdomain-preview').textContent = value;
            
            // Check subdomain availability
            if (value.length >= 3) {
                fetch('check_subdomain.php?subdomain=' + value)
                    .then(response => response.json())
                    .then(data => {
                        const messageDiv = document.getElementById('subdomain-message');
                        if (data.available) {
                            messageDiv.innerHTML = '<small class="text-success"><i class="fas fa-check-circle"></i> Subdomain is available</small>';
                            this.setCustomValidity('');
                        } else {
                            messageDiv.innerHTML = '<small class="text-danger"><i class="fas fa-times-circle"></i> Subdomain is already taken</small>';
                            this.setCustomValidity('This subdomain is already taken');
                        }
                    });
            }
        });
        </script>
        <?php
        if (isset($_POST['submit'])) {
            // Get form data

            // var_dump($_POST);
            // exit();
            // Sanitize input and handle password encryption
            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));


            // Check if email already exists
            $check = $conn->prepare("SELECT email FROM employer_tbl WHERE email=:email");
            $check->bindParam(':email', $email);
            $check->execute();


            if ($check->rowCount() > 0) {
                // Email already exists, redirect to error page
               
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script type="text/javascript">Swal.fire("Error", "Email already exists. Please login using this email, ", "error").then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "employer-login.php";
                    }
                });</script>';
            } else {

                $country_code = htmlspecialchars(trim($_POST['country_code']));
                $password_encrypt = htmlspecialchars(trim($_POST['password']));
                $password = hash("sha256", $password_encrypt);
                $contact_number = htmlspecialchars(trim($_POST['contact_number']));
                $company_name = htmlspecialchars(trim($_POST['company_name']));
                $designation = htmlspecialchars(trim($_POST['designation']));
                $city = htmlspecialchars(trim($_POST['city']));
                $company_description = htmlspecialchars(trim($_POST['company_description']));
                $company_address = htmlspecialchars(trim($_POST['company_address']));
                $company_state = htmlspecialchars(trim($_POST['company_state']));
                $company_country = htmlspecialchars(trim($_POST['company_country']));
                $company_pincode = htmlspecialchars(trim($_POST['company_pincode']));
                $subdomain = strtolower(trim($_POST['subdomain']));
                $default_currency = htmlspecialchars(trim($_POST['default_currency']));
                $selected_plan = isset($_POST['selected_plan']) ? intval($_POST['selected_plan']) : null;




                // Handling the logo upload
                if (isset($_FILES['company_logo']) && $_FILES['company_logo']['error'] == 0) {
                    // Get file details
                    $logo_tmp_name = $_FILES['company_logo']['tmp_name'];
                    $logo_name = $_FILES['company_logo']['name'];
                    $logo_size = $_FILES['company_logo']['size'];
                    $logo_type = $_FILES['company_logo']['type'];

                    // Define the allowed file types and size
                    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                    $max_size = 5 * 1024 * 1024; // 5 MB limit

                    // Check file type and size
                    if (!in_array($logo_type, $allowed_types)) {
                        echo '<script>alert("Invalid file type. Only JPG, PNG, GIF allowed.");</script>';
                        exit;
                    }

                    if ($logo_size > $max_size) {
                        echo '<script>alert("File size too large. Max allowed size is 5MB.");</script>';
                        exit;
                    }

                    // Create a unique file name to avoid name conflicts
                    $logo_new_name = uniqid('logo_', true) . '.' . pathinfo($logo_name, PATHINFO_EXTENSION);

                    // Set the target directory for uploads
                    $upload_dir = 'uploads/company_logos/';

                    // Check if the directory exists, if not create it
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    // Move the uploaded file to the desired directory
                    if (!move_uploaded_file($logo_tmp_name, $upload_dir . $logo_new_name)) {
                        echo '<script>alert("Error uploading file. Please try again.");</script>';
                        exit;
                    }

                    // Store the uploaded logo file name in the database
                    $logo_path = $upload_dir . $logo_new_name;
                } else {
                    // If no logo is uploaded, set a default path (if needed)
                    $logo_path = null; // Or you can set a default logo URL if required
                }
                $token = bin2hex(random_bytes(16));

                // Add this validation before your insert
                if (!preg_match('/^[a-z0-9]+$/', $subdomain)) {
                    echo '<script>alert("Invalid subdomain format. Only lowercase letters and numbers allowed.");</script>';
                    exit;
                }

                // Check if subdomain is already taken
                $check_subdomain = $conn->prepare("SELECT id FROM employer_tbl WHERE subdomain = ?");
                $check_subdomain->execute([$subdomain]);
                if ($check_subdomain->rowCount() > 0) {
                    echo '<script>alert("This subdomain is already taken. Please choose another.");</script>';
                    exit;
                }

                // Insert data into database
                $insert = $conn->prepare("INSERT INTO `employer_tbl`(
        name,
        email,
        country_code,  
        password,
        contact_number,
        company_name,
        designation,
        city,
        company_description,
        company_address,
        company_state,
        company_country,
        company_pincode,
        token,
        company_logo,
        subdomain,
        default_currency,
        plan_id
    ) VALUES (
        :name,
        :email,
        :country_code,  
        :password,
        :contact_number,
        :company_name,
        :designation,
        :city,
        :company_description,
        :company_address,
        :company_state,
        :company_country,
        :company_pincode,
        :token,
        :company_logo,
        :subdomain,
        :default_currency,
        :plan_id
    )");

                // Bind parameters from the $data array
                $insert->bindParam(':name', $name);
                $insert->bindParam(':email', $email);
                $insert->bindParam(':country_code', $country_code);  // Bind country_code here
                $insert->bindParam(':password', $password);
                $insert->bindParam(':contact_number', $contact_number);
                $insert->bindParam(':company_name', $company_name);
                $insert->bindParam(':designation', $designation);
                $insert->bindParam(':city', $city);
                $insert->bindParam(':company_description', $company_description);
                $insert->bindParam(':company_address', $company_address);
                $insert->bindParam(':company_state', $company_state);
                $insert->bindParam(':company_country', $company_country);
                $insert->bindParam(':company_pincode', $company_pincode);
                $insert->bindParam(':token', $token);
                $insert->bindParam(':company_logo', $logo_path); // Store the file path
                $insert->bindParam(':subdomain', $subdomain);
                $insert->bindParam(':default_currency', $default_currency);
                $insert->bindParam(':plan_id', $selected_plan);
                // Execute the query
                if ($insert->execute()) {
                    // Send confirmation email
                    // (PHPMailer code goes here, unchanged)


                    // Create a new PHPMailer instance
                    $mail = new PHPMailer(true);


                    $verificationLink = "https://ki-careers.com/verify_employer.php?token=$token";

                    try {
                        // Gmail SMTP server configuration
                        $mail->isSMTP();                                            // Set mailer to use SMTP
                        $mail->Host       = 'smtp.gmail.com';                        // Set the SMTP server to Gmail's server
                        $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
                        $mail->Username   = 'kicareer01@gmail.com';                  // Your Gmail address
                        $mail->Password   = 'myen caef fslf jiyw';                   // Your Gmail password or App Password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption; use ENCRYPTION_SMTPS for SSL
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
                                    <span> Hi ' . $name . ',<br> Welcome to KI Careers, you are now successfully registered as a employer.<br><br>
                                    <p>Thank you for registering on our website. Please click the link below to verify your email address:</p>
    <p>
        <a href="' . $verificationLink . '" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Verify Email
        </a>
    </p>
    <p>If you did not create an account, no further action is required.</p>
    <p>Thank you!</p>
                                    <br><br>
                                    <h3>Regards,</h3>
                                    <p>KI Careers Team</p>
                                    <p>www.ki-careers.com</p>
                                  <img src="https://ki-careers.com/image/logo-01.png" alt="KI Careers Logo" style="max-width: 100px; max-height: 70px; margin-bottom: 20px;">
                                  </div>
                              </div><br>
                          </div>
                          </body>
                        </html>
                      ';
                        $mail->AltBody = 'Welcome to KI Careers, thankyou for registering with us';

                        // Send the email
                        if ($mail->send()) {
        ?>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                            <script type="text/javascript">
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Welcome to KI Careers, thankyou for registering with us, please check your email address for further instructions.',
                                    icon: 'success',
                                    confirmButtonText: 'Login Now'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "employer-login.php";
                                    }
                                });
                            </script>
        <?php
                        }
                        // echo 'Message has been sent successfully';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    echo '<script type="text/javascript">alert("Something went wrong, please try again");</script>';
                }
            }
        }
        ?>

        <!-- Add the modal markup here -->
        <div class="modal fade" id="viewPlansModal" tabindex="-1" role="dialog" aria-labelledby="viewPlansModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewPlansModalLabel">Choose Your Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <?php
                            // Fetch plans from database
                            $stmt = $conn->prepare("SELECT * FROM plans ORDER BY price ASC");
                            $stmt->execute();
                            $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($plans as $plan) {
                                ?>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100 shadow-sm hover-shadow" style="border-radius: 15px; transition: all 0.3s ease;">
                                        <div class="card-header text-center py-4" style="background: #f8f9fa; border-radius: 15px 15px 0 0; border-bottom: none;">
                                            <h5 class="card-title mb-0" style="color: #457eff; font-weight: 600;">
                                                <?php echo htmlspecialchars($plan['plan_name']); ?>
                                            </h5>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="price-section mb-4">
                                                <h2 class="mb-0" style="color: #2c3e50; font-weight: bold;">
                                                    $<?php echo number_format($plan['price'], 2); ?>
                                                </h2>
                                                <span class="text-muted">
                                                    for <?php echo htmlspecialchars($plan['duration']); ?> days
                                                </span>
                                            </div>
                                            <ul class="list-unstyled feature-list" style="text-align: left;">
                                                <li class="mb-3 d-flex align-items-start">
                                                    <i class="fas fa-check-circle mt-1" style="color: #457eff; margin-right: 10px; flex-shrink: 0;"></i>
                                                    <div>
                                                        <strong><?php echo htmlspecialchars($plan['num_recruiter']); ?></strong> Recruiters Included
                                                    </div>
                                                </li>
                                                <li class="mb-3 d-flex align-items-start">
                                                    <i class="fas fa-check-circle mt-1" style="color: #457eff; margin-right: 10px; flex-shrink: 0;"></i>
                                                    <div>
                                                        Additional recruiters at <strong>$<?php echo number_format($plan['charge_per_recruiter'], 2); ?></strong> each
                                                    </div>
                                                </li>
                                                <li class="mb-3 d-flex align-items-start">
                                                    <i class="fas fa-check-circle mt-1" style="color: #457eff; margin-right: 10px; flex-shrink: 0;"></i>
                                                    <div>
                                                        <strong><?php echo htmlspecialchars($plan['duration']); ?> days</strong> plan validity
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0 text-center pb-4">
                                            <button class="btn btn-primary select-plan w-75" 
                                                    data-plan-id="<?php echo htmlspecialchars($plan['id']); ?>"
                                                    data-plan-name="<?php echo htmlspecialchars($plan['plan_name']); ?>"
                                                    style="background:#457eff; border-radius: 25px; padding: 10px 20px; border: none; transition: all 0.3s ease;">
                                                Select <?php echo htmlspecialchars($plan['plan_name']); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add this hidden input to your form -->
        <input type="hidden" name="selected_plan" id="selected_plan" value="" autocomplete="off">

        <!-- Add this JavaScript before the closing body tag -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle plan selection
            const planButtons = document.querySelectorAll('.select-plan');
            planButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const planId = this.getAttribute('data-plan-id');
                    const planName = this.getAttribute('data-plan-name');
                    
                    // Set the selected plan ID to the hidden input
                    document.getElementById('selected_plan').value = planId;
                    
                    // Show confirmation message
                    alert(`You have selected the ${planName} plan. Please complete your registration to activate this plan.`);
                    
                    // Close the modal
                    $('#viewPlansModal').modal('hide');
                });
            });
        });
        </script>

</body>

</html>