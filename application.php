<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config.php');
$postid = $_GET['postid'];
$jobtitle = $_GET['jobtitle'];
$rolecategory = $_GET['rolecategory'];

// var_dump($_REQUEST);
// exit;
if (!($_SESSION['logged_in'])) {
?>
    <script type="text/javascript">
        alert("Please login first");
        window.location.replace("login.php");
    </script>
<?php
}
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
    <title>Job Application</title>
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
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

        .breadcrumb .active a {
            color: #1778bc !important;
            font-weight: 600 !important;
        }

        @media only screen and (min-width:1px) and (max-width:520px) {
            .card-left-img {
                display: none;
            }
        }

        .btn-css {
            background: #2b88c4 !important;
            border: none !important;
            border-radius: 1px !important;
        }

        .wizard[data-style="1"]>.steps ul li>a {
            text-align: center;
            width: auto !important;
            height: auto !important;
            border-radius: 2px;
            /*margin-top: 30px*/
            padding: 5px 10px;
            /*background:#2b88c4 !important;border: none !important;border-radius: 1px !important;*/
        }

        .wizard[data-style="1"]>.steps ul li>a:hover {
            background: #2b88c4 !important;
        }

        .wizard>.steps ul li.current a,
        .wizard>.steps ul li.current a:hover,
        .wizard>.steps ul li.current a:active {
            background: #2b88c4;
            color: #ffffff;
        }

        .wizard[data-style="1"]>.steps ul {
            margin: 0px !important;
        }

        .number {
            display: none !important;
        }

        .wizard[data-style="1"]>.steps ul li::after {
            top: 1.1rem !important;
            border: 1px dashed #f2f2f2 !important;

        }

        button.btn,
        .btn:not(.close):not(.mfp-close),
        a.btn:not([href]):not([tabindex]) {
            background: #2b88c4;
            border: none !important;
        }

        .wizard>.steps ul li>a:hover,
        .wizard>.steps ul li>a:active {
            background: #2b88c4 !important;
            border: none !important;
        }

        .wizard h3:hover {
            background: black !important;
        }

        .clearfix li:last-child {
            display: none !important;
        }

        .steps li:last-child {
            display: block !important;
        }

        ul[role="menu"] li.disabled a[href="#previous"] {
            display: none !important;
        }
    </style>
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
        <?php
        include 'header.php';
        ?>
        <!-- end: Header -->
        <section class="p-b-0" style="background:url(gplay.png) !important;height: 200px">
            <div class="container-fluid">
            </div>
        </section>
        <div class="container-fluid" style="margin-top:-150px">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <!-- <div class="card card-left-img" style="position: fixed;top:35%;left:25px;width:310px">
                            <center><img src="image/green-boy.c8b59289.svg" width="120px" style="margin-top:-40px"></center>
                            <div class=" p-20">
                                <center>
                                    <h4> On registering, you can</h4>
                                </center>
                                <ul style="list-style: none;text-align: center;">
                                    <li> <img src="image/accept.png" width="15px"> Build your profile and let recruiters find you</li>

                                    <li> <img src="image/accept.png" width="15px"> Get job postings delivered right to your email</li>

                                    <li><img src="image/accept.png" width="15px">
                                        Find a job and grow your career
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <div class=" content col-md-8">
                        <div class="card">
                            <div class="card-body">

                                <div>


                                    <h1>Job Application</h1>
                                    <h4 class="text-muted mb-4"><small>Applying for - </small><span class="fw-bolder"><?php echo $jobtitle; ?></span></h4>
                                </div><br>
                                <div class="wizard" data-style="1">
                                    <div class="steps">
                                        <!-- <h3>1 General</h3> -->
                                        <?php

                                        $stmt = $conn->prepare("SELECT * FROM `job_applications` WHERE jobid = :jobid AND applied_id = :applied_id");

                                        // Bind the values to the query parameters
                                        $stmt->bindParam(':jobid', $postid, PDO::PARAM_INT);
                                        $stmt->bindParam(':applied_id', $_SESSION['id'], PDO::PARAM_INT);
                                        $stmt->execute();
                                        $disable = '';
                                        // Step 4: Fetch the results
                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        if ($result) {
                                            // var_dump($result[0]['apply_date']);
                                            // exit;
                                            $apply_date = $result[0]['apply_date'];

                                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $apply_date);

                                            // Check if the date was parsed successfully
                                            if ($date === false) {
                                                echo "Error: Invalid date format.";
                                            } else {
                                                // Format the date to 'dd-mm-yyyy'
                                                $formatted_date = $date->format('d-m-Y');
                                                // Output the formatted date
                                                echo '<h4 style="color:red"><em>You have already applied for this job on ' . $formatted_date . '</em></h4>';
                                            }
                                            $disable = 'disabled';
                                        }


                                        ?>
                                      <form action="" method="POST" enctype="multipart/form-data" id="application_form">
    <input type="hidden" value="<?php echo $postid; ?>" name="jobid" />
    <input type="hidden" value="<?= $_SESSION['id'] ?>" name="applied_id" />
    <input type="hidden" value="<?php echo $rolecategory; ?>" name="rolecategory" />

    <div class="wizard-content">
        <p class="">Personal Details</p>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Id <span>*</span></label>
                        <input type="text" value="<?= $_SESSION['email'] ?>" <?= ($logged_in == 1) ? 'readonly' : '' ?> class="form-control" name="email" required placeholder="Enter your Email ID">
                        <span style="font-size: 12px">We'll never share your email with anyone else.</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Applicant Name<span>*</span></label>
                        <input type="text" value="<?= $_SESSION['name'] ?>" <?= ($logged_in == 1) ? 'readonly' : '' ?> class="form-control" name="name" placeholder="Enter your Name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Profile Image <span>*</span></label>
                        <input type="file" class="form-control" name="profile_image" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date Of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Mobile Number <span>*</span></label>
                <input type="text" placeholder="Enter your mobile number" value="<?= $_SESSION['contact_number'] ?>" <?= ($logged_in == 1) ? 'readonly' : '' ?> class="form-control" style="width: 80%; float: right;" name="phone" required>
                <select name="countryCode" id="countryCode" class="form-control" style="width: 19% !important"></select>
            </div>
            <div class="form-group">
                <label class="form-label">Select State </label>
                <select class="form-control" id="state" name="state">
                    <option>--SELECT--</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Select City/Location </label>
                <select class="form-control" id="city" name="city">
                    <option>--SELECT--</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Experience in years</label>
                    <select class="form-control" name="experience">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10+">10+</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Current Employer </label>
                    <input type="text" class="form-control" name="current_emp" placeholder="Enter your current employer">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Current Salary</label>
                    <input type="text" class="form-control" name="current_sal" placeholder="Enter your current salary">
                </div>
            </div>
            <p class="m-t-20">Preferences</p>
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" class="form-control" id="apply_position" name="apply_position" value="<?php echo $jobtitle; ?>" required>
                    <div class="form-group">
                        <label class="form-label">Preferred Job City <span class="text-danger">*</span></label>
                        <select class="form-control" name="job_city" id="job_city">
                            <option value="">--SELECT--</option>
                            <?php
                            $locationlisting = new posts($conn);
                            $locationlist = $locationlisting->locationlist();
                            foreach ($locationlist as $location) {
                                echo "<option value='" . $location['name'] . "'>" . $location['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Notice Period <span class="text-danger">*</span></label>
                    <select class="form-control" id="notice_period" name="notice_period" required>
                        <option value="">--SELECT--</option>
                        <option value="One Week">One Week</option>
                        <option value="Two Week">Two Weeks</option>
                        <option value="One Month">One Month</option>
                        <option value="Two Months">Two Months</option>
                        <option value="More">More</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- New Section for U.S. Work Authorization -->
        <p class="m-t-20">U.S. Work Authorization</p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Are you a U.S. citizen? <span>*</span></label>
                    <select class="form-control" name="us_citizen" required>
                        <option value="">--SELECT--</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>If not, are you authorized to work in the U.S.? <span>*</span></label>
                    <select class="form-control" name="work_authorized" required>
                        <option value="">--SELECT--</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Do you require sponsorship for a work visa now or in the future? <span>*</span></label>
                    <select class="form-control" name="visa_sponsorship" required>
                        <option value="">--SELECT--</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Current Visa Type</label>
                    <select class="form-control" name="visa_type">
                        <option value="">--SELECT--</option>
                        <option value="H-1B">H-1B</option>
                        <option value="L-1">L-1</option>
                        <option value="F-1 (OPT/CPT)">F-1 (OPT/CPT)</option>
                        <option value="Green Card">Green Card</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Green Card or Work Authorization Expiry Date (if applicable)</label>
                    <input type="date" class="form-control" name="visa_expiry_date">
                </div>
            </div>
        </div>

        <button class="btn" type="submit" name="submit_form" style="float: right;background:#2b88c4 !important"> Submit</button>
    </div>
</form>

                                        <!--end: Wizard 7-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end: Body Inner -->
            <!-- Scroll top -->
            <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
            <!--Plugins-->
            <script src="js/jquery.js"></script>
            <script src="js/plugins.js"></script>
            <!--Tdep_idlate functions-->
            <script src="js/functions.js"></script>

            <script src="plugins/dropzone/dropzone.js"></script>
            <script src="plugins/jquery-steps/validate.min.js"></script>
            <script src="plugins/jquery-steps/jquery.steps.min.js"></script>
            <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
            <link href="plugins/jquery-steps/jquery.steps.css" rel="stylesheet">
            <script>
                $('#wizard1').steps({
                    headerTag: 'h3',
                    bodyTag: '.wizard-content',
                    autoFocus: true,
                    enableAllSteps: true,
                    titleTemplate: '<span class="number">#index#</span><span class="title">#title#</span>',
                    onFinished: function(event, currentIndex) {
                        INSPIRO.elements.notification("Submited",
                            "Thank you, your account has been registed successfully", "success");
                    }
                });

                //Validation
                wizard1.validate({
                    errorClass: 'is-invalid',
                    validClass: 'is-valid',
                    errorElement: "div",
                    rules: {
                        // Step 1 - Account information
                        username: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true,
                            minlength: 8
                        },
                        password: {
                            required: true,
                            minlength: 5,
                            maxlength: 12
                        },
                        password2: {
                            required: true,
                            minlength: 5,
                            maxlength: 12
                        },
                        // Step 4 - Confirmation
                        reminders: {
                            required: true
                        },
                        terms_conditions: {
                            required: true
                        },
                    },
                    errorPlacement: function(error, element) {
                        $(element).parents(".form-group").append(error);
                    }
                });
                $('.wizard').find(".actions ul > li > a").addClass("btn");
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    for (var i = 2; i <= 20; i++) {
                        $("#original_certification_input_" + i).hide('');
                    }
                });

                function show_certificate_input(i) {
                    let j = i;
                    i++;
                    let increment = i;
                    // window.location.href='?'+j;
                    $("#original_certification_button_" + j).html('');
                    $("#original_certification_input_" + increment).show('<textarea class="form-control"></textarea> \
                            <div >\
                                <button onclick="show_certificate_input()" class="btn btn-sm m-t-10" type="button">Add</button>\
                            </div>');
                    $("#total_cert").val(i);

                }

                $(document).ready(function() {
                    for (var i = 2; i <= 20; i++) {
                        $("#original_course_input_" + i).hide('');
                    }
                });

                function show_course_input(i) {
                    let j = i;
                    i++;
                    let increment = i;
                    // window.location.href='?'+j;
                    $("#original_course_button_" + j).html('');
                    $("#original_course_input_" + increment).show('<textarea class="form-control"></textarea> \
                            <div >\
                                <button onclick="show_course_input()" class="btn btn-sm m-t-10" type="button">Add</button>\
                            </div>');
                    $("#total_prof_exp").val(i);

                }

                $(document).ready(function() {
                    for (var i = 2; i <= 20; i++) {
                        $("#original_skills_input_" + i).hide('');
                    }
                });

                function show_skills_input(i) {
                    let j = i;
                    i++;
                    let increment = i;
                    // window.location.href='?'+j;
                    $("#original_skills_button_" + j).html('');
                    $("#original_skills_input_" + increment).show('<textarea class="form-control"></textarea> \
                            <div >\
                                <button onclick="show_skills_input()" class="btn btn-sm m-t-10" type="button">Add</button>\
                            </div>');
                    $("#total_skills").val(i);

                }

                $(document).ready(function() {
                    for (var i = 2; i <= 20; i++) {
                        $("#original_education_input_" + i).hide('');
                    }
                });

                function show_education_input(i) {
                    let j = i;
                    i++;
                    let increment = i;
                    // window.location.href='?'+j;
                    $("#original_education_button_" + j).html('');
                    $("#original_education_input_" + increment).show('<textarea class="form-control"></textarea> \
                            <div >\
                                <button onclick="show_education_input()" class="btn btn-sm m-t-10" type="button">Add</button>\
                            </div>');
                    $("#total_education").val(i);

                }

                $(document).ready(function() {
                    for (var i = 2; i <= 20; i++) {
                        $("#original_preexp_input_" + i).hide('');
                    }
                });

                function show_preexp_input(i) {
                    let j = i;
                    i++;
                    let increment = i;
                    // window.location.href='?'+j;
                    $("#original_preexp_button_" + j).html('');
                    $("#original_preexp_input_" + increment).show('<textarea class="form-control"></textarea> \
                            <div >\
                                <button onclick="show_preexp_input()" class="btn btn-sm m-t-10" type="button">Add</button>\
                            </div>');
                    $("#total_preexp").val(i);

                }

                $(document).ready(function() {
                    for (var i = 2; i <= 20; i++) {
                        $("#original_roles_input_" + i).hide('');
                    }
                });

                function show_roles_input(i) {
                    let j = i;
                    i++;
                    let increment = i;
                    // window.location.href='?'+j;
                    $("#original_roles_button_" + j).html('');
                    $("#original_roles_input_" + increment).show('<textarea class="form-control"></textarea> \
                            <div >\
                                <button onclick="show_roles_input()" class="btn btn-sm m-t-10" type="button">Add</button>\
                            </div>');
                    $("#total_roles").val(i);

                }

                $(document).ready(function() {
                    for (var i = 2; i <= 20; i++) {
                        $("#original_project_input_" + i).hide('');
                    }
                });

                function show_project_input(i) {
                    let j = i;
                    i++;
                    let increment = i;
                    // window.location.href='?'+j;
                    $("#original_project_button_" + j).html('');
                    $("#original_project_input_" + increment).show('<textarea class="form-control"></textarea> \
                            <div >\
                                <button onclick="show_project_input()" class="btn btn-sm m-t-10" type="button">Add</button>\
                            </div>');
                    $("#total_project").val(i);

                }
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

                // Fetch and populate states based on selected country
                document.getElementById('countryCode').addEventListener('change', function() {
                    const countryCode = this.options[this.selectedIndex].getAttribute('data-countryCode');
                    fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states`, requestOptions)
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
                        .catch(error => console.log('Error fetching states:', error));
                });

                // Fetch and populate cities based on selected state
                document.getElementById('state').addEventListener('change', function() {
                    const countryCode = document.getElementById('countryCode').options[document.getElementById('countryCode').selectedIndex].getAttribute('data-countryCode');
                    const stateCode = this.value;
                    fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states/${stateCode}/cities`, requestOptions)
                        .then(response => response.json())
                        .then(cities => {
                            const citySelect = document.getElementById('city');
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

                function addCertificate() {
                    var newCertificate = document.querySelector('.certificate-group .row').cloneNode(true);
                    document.getElementById('certificates').insertBefore(newCertificate, document.querySelector('#certificates button'));
                }

                // Function to add a new skill input group
                function addSkill() {
                    var newSkill = document.querySelector('.skill-group .row').cloneNode(true);
                    document.getElementById('skills').insertBefore(newSkill, document.querySelector('#skills button'));
                }

                // Function to add a new project input group
                function addProject() {
                    var newProject = document.querySelector('.project-group .row').cloneNode(true);
                    document.getElementById('projects').insertBefore(newProject, document.querySelector('#projects button'));
                }

                // Function to add a new experience input group
                function addExperience() {
                    var newExperience = document.querySelector('.experience-group .row').cloneNode(true);
                    document.getElementById('experience').insertBefore(newExperience, document.querySelector('#experience button'));
                }

                // Function to add a new education input group
                function addEducation() {
                    var newEducation = document.querySelector('.education-group .row').cloneNode(true);
                    document.getElementById('education').insertBefore(newEducation, document.querySelector('#education button'));
                }
            </script>

<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted

if (isset($_POST['submit_form'])) {
    

    
    // Sanitize and process form data
    $certifications = isset($_POST['certificates']) ? json_encode(array_map(null, $_POST['certificates'], $_POST['certification_descriptions'])) : null;
    $skills = isset($_POST['skills']) ? json_encode(array_map(null, $_POST['skills'], $_POST['proficiency_levels'])) : null;
    $projects = isset($_POST['projects']) ? json_encode(array_map(null, $_POST['projects'], $_POST['project_descriptions'])) : null;
    $previous_experience = isset($_POST['previous_experience']) ? json_encode(array_map(null, $_POST['previous_experience'], $_POST['previous_experience_roles'], $_POST['previous_experience_descriptions'])) : null;
    $education = isset($_POST['education_institutes']) ? json_encode(array_map(null, $_POST['education_institutes'], $_POST['education_degrees'], $_POST['passing_years'])) : null;

    // New fields for U.S. work authorization
    $us_citizen = isset($_POST['us_citizen']) ? $_POST['us_citizen'] : null;
    $work_authorized = isset($_POST['work_authorized']) ? $_POST['work_authorized'] : null;
    $visa_sponsorship = isset($_POST['visa_sponsorship']) ? $_POST['visa_sponsorship'] : null;
    $visa_type = isset($_POST['visa_type']) ? $_POST['visa_type'] : null;
    $visa_expiry_date = isset($_POST['visa_expiry_date']) ? $_POST['visa_expiry_date'] : null;

    // Handle file uploads for resume and profile image
    $resume_file = null;
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $resume_name = $_FILES['resume']['name'];
        $resume_tmp = $_FILES['resume']['tmp_name'];
        $unique_name = uniqid('resume_', true);
        $file_extension = pathinfo($resume_name, PATHINFO_EXTENSION);
        $new_resume_name = $unique_name . '.' . $file_extension;
        $resume_file = 'uploads/resumes/' . $new_resume_name;
        move_uploaded_file($resume_tmp, $resume_file);
    }

    $profile_image_file = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image_name = $_FILES['profile_image']['name'];
        $profile_image_tmp = $_FILES['profile_image']['tmp_name'];
        $unique_name = uniqid('profile_', true);
        $file_extension = pathinfo($profile_image_name, PATHINFO_EXTENSION);
        $new_profile_image_name = $unique_name . '.' . $file_extension;
        $profile_image_file = 'uploads/profile/' . $new_profile_image_name;
        move_uploaded_file($profile_image_tmp, $profile_image_file);
    }

    // Prepare the SQL query to insert the form data
    $stmt = $conn->prepare("INSERT INTO job_applications 
        (jobid, applied_id, email, name, phone, countryCode, state, city, dob, experience, 
        current_emp, current_sal, apply_position, job_city, notice_period, certifications, 
        skills, projects, previous_experience, education, resume_file, profile_image, 
        us_citizen, work_authorized, visa_sponsorship_needed, visa_type, visa_expiry_date) 
        VALUES 
        (:jobid, :applied_id, :email, :name, :phone, :countryCode, :state, :city, :dob, 
        :experience, :current_emp, :current_sal, :apply_position, :job_city, :notice_period, 
        :certifications, :skills, :projects, :previous_experience, :education, :resume_file, 
        :profile_image, :us_citizen, :work_authorized, :visa_sponsorship_needed, :visa_type, :visa_expiry_date)");

    // Execute the query with the form data
    try {
        $stmt->execute([
            ':jobid' => $_POST['jobid'],
            ':applied_id' => $_POST['applied_id'],
            ':email' => $_POST['email'],
            ':name' => $_POST['name'],
            ':phone' => $_POST['phone'],
            ':countryCode' => $_POST['countryCode'],
            ':state' => $_POST['state'],
            ':city' => $_POST['city'],
            ':dob' => $_POST['dob'],
            ':experience' => $_POST['experience'],
            ':current_emp' => $_POST['current_emp'],
            ':current_sal' => $_POST['current_sal'],
            ':apply_position' => $_POST['apply_position'],
            ':job_city' => $_POST['job_city'],
            ':notice_period' => $_POST['notice_period'],
            ':certifications' => $certifications,
            ':skills' => $skills,
            ':projects' => $projects,
            ':previous_experience' => $previous_experience,
            ':education' => $education,
            ':resume_file' => $resume_file,
            ':profile_image' => $profile_image_file,
            ':us_citizen' => $us_citizen,
            ':work_authorized' => $work_authorized,
            ':visa_sponsorship_needed' => $visa_sponsorship,
            ':visa_type' => $visa_type,
            ':visa_expiry_date' => $visa_expiry_date
        ]);
        // var_dump($_POST);
        // exit;
        echo "<script>alert('Application submitted successfully!'); window.location.href = 'index.php';</script>";
    } catch (Exception $e) {
     
        echo "<script>alert('Failed to submit application: " . $e->getMessage() . "')</script>";
        // var_dump($_POST);
        // echo "Error";
// exit;
    }
}
?>





            <script type="text/javascript" src="js/bootstrap.js "></script>
</body>

</html>