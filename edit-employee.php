<?php
include('config.php');
$id = htmlspecialchars(trim($_SESSION['id']));

// var_dump($_SESSION['id']);
// exit;
// $fetch=$conn->prepare("SELECT * FROM emp_tbl WHERE id=:id");
// $fetch->bindparam(':id', $id);
// $fetch->execute();
$key = $_SESSION;
// echo json_encode($key);
// exit;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    <title>Edit Profile</title>
    <!-- Stylesheets & Fonts -->
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
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
</style>

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

        </section>
        <div class="container-fluid" style="margin-top:-150px">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                          <?php include_once 'sidebar.php'; ?>
                    </div>
                    <div class="col-md-8">
                        <form method="POST" enctype="multipart/form-data">
                            <article style="background: white !important">
                                <div class="card card-article" style="cursor: pointer;">
                                    <h1>Edit your profile</h1>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Full Name *</label>
                                                <input type="text" required="" value="<?= $key['name'] ?>" class="form-control" name="name" placeholder="What is your name">
                                            </div>
                                            <div class="form-group">
                                                <label> Email Id *</label>
                                                <input type="email" required="" class="form-control" value="<?= $key['email'] ?>" name="email" placeholder="Tell us your Email ID">
                                            </div>
                                            <div class="form-group">
                                                <label> Mobile Number *</label>
                                                <input type="" placeholder="Enter your mobile number" value="<?= $key['contact_number'] ?>" class="form-control" style="width: 80%;float: right;background: none !important" name="contact_number" required>
                                                <select name="country_code" class="form-control" style="width:19%;" id="countryCode" required="">

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label> Profile Image</label>
                                                <input type="file" id="profile_image" class="form-control" value="" name="profile_image" placeholder="Upload Profile Image">
                                            </div>
                                            <style type="text/css">
                                                .select-css {
                                                    width: 300px !important;
                                                    float: left !important;
                                                    margin: 5px;
                                                    border: 1px solid #f2f2f2;
                                                    padding: 10px;
                                                    border-radius: 0px 30px 0px 30px;
                                                }

                                                .select-css img {
                                                    margin-top: 5% !important;
                                                }

                                                @media only screen and (min-width:1px) and (max-width:520px) {
                                                    .select-css {

                                                        width: 100% !important;
                                                    }
                                                }
                                            </style>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label> Work Status</label>
                                                        <div onclick="activeAc('dep_id')">
                                                            <div class="select-css" id="dep_id">
                                                                <center>
                                                                    <img src="image/briefcase.png" width="25px">
                                                                    <img src="image/check-circle.png" width="20px" id="showActive" style="float: right;margin-top:-3px !important;display: none">
                                                                    <input type="radio" name="work_status" <?php if ($key['work_status'] == 'experienced') {
                                                                                                                echo 'checked';
                                                                                                            } ?> value="experienced">
                                                                    <h5 class="m-t-10 m-b-0" style="line-height: 1.5"> I'm Experienced</h5>
                                                                    <h6 class="m-0" style="line-height: 1.5">I have work experience (excluding internships)</h6>
                                                                </center>
                                                            </div>
                                                        </div>
                                                        <div onclick="activeAc('fresher')">
                                                            <div class="select-css" id="fresher">
                                                                <center>
                                                                    <img src="image/school-bag.png" width="25px">
                                                                    <img src="image/check-circle.png" width="20px" id="showActive" style="float: right;margin-top:-3px !important;display: none">
                                                                    <input type="radio" name="work_status" <?php if ($key['work_status'] == 'fresher') {
                                                                                                                echo 'checked';
                                                                                                            } ?> value="fresher">
                                                                    <h5 class="m-t-10 m-b-0" style="line-height: 1.5"> I'm a Fresher</h5>
                                                                    <h6 class="m-0" style="line-height: 1.5">I am a student/ Haven't worked after graduation</h6>
                                                                </center>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div style="width: 125px; height: 125px; border: 1px solid #f2f2f2; border-radius: 50%; float: left; margin: 5px; overflow: hidden; ">
                                                                <?php if(isset($_SESSION['profile_image'])){
                                                                    ?>
                                                                    <img src="<?php echo $_SESSION['profile_image']; ?>" height="125px">
                                                                    <img src="image/check-circle.png" width="20px" id="showActive" style="float: right;margin-top:-3px !important;display: none">
                                                                    <?php
                                                                } 
                                                                else{
                                                                    ?>
                                                                    <p class="m-t-10 m-b-0">Upload Profile Image</p>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group m-t-10">
                                                <label>
                                                    <?php
                                                    if ($key['whatsapp'] == 'on') {
                                                        echo '<input type="checkbox" checked class="form-control" name="whatsapp" placeholder="">Send me important updates on <img src="image/whatsappicon.0011d8c1.png" width="20px"> WhatsApp';
                                                    } else {
                                                        echo '<input type="checkbox"  class="form-control" name="whatsapp" placeholder="">Send me important updates on <img src="image/whatsappicon.0011d8c1.png" width="20px"> WhatsApp';
                                                    }
                                                    ?>
                                                </label>
                                            </div>
                                            <div class="row m-t-10 float-right">
                                                <button class="btn" type="submit" name="submit" style="background:#457eff;border-color:#457eff;border-radius: 20px;float: right !important"> Submit
                                                </button>
                                            </div>
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

<?php
include 'footer.php';
?>
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
        function activeAc(dep_id) {
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
                selectedOption.style.border = "1px solid #f2f2f2";
                selectedOption.style.color = "#303030";
                selectedOption.querySelector("#showActive").style.display = "none";
            } else {
                selectedOption.style.color = "black";
                selectedOption.style.border = "2px solid #457eff";
                selectedOption.querySelector("#showActive").style.display = "block";
            }
        }
    </script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    // Validate and sanitize user input
    $name = htmlspecialchars(trim($_POST['name']));
    $contact_number = htmlspecialchars(trim($_POST['contact_number']));
    $email = htmlspecialchars(trim($_POST['email']));
    $work_status = htmlspecialchars(trim($_POST['work_status']));
    $whatsapp = isset($_POST['whatsapp']) ? 'on' : 'off';
    $country_code = $_POST['country_code'];
    $fileDestination = $_SESSION['profile_image'];
    // Handle file upload for profile image
    $profile_image = null; // Default value in case no file is uploaded
    
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_image'];
        
        // File properties
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Specify allowed file extensions
        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        // Get the file extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check if the file type is allowed
        if (in_array($fileExt, $allowed)) {
            // Check if there were no errors during upload
            if ($fileError === 0) {
                // Check if the file size is not too large (example: 2MB limit)
                if ($fileSize < 2000000) { // 2MB limit
                    // Generate a unique name for the file to prevent overwriting
                    $profile_image = uniqid('', true) . "." . $fileExt;
                    $fileDestination = 'uploads/profile/' . $profile_image; // Save to 'uploads/profile_images' folder

                    // Move the uploaded file to the destination
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // Successfully uploaded
                    } else {
                        // Error uploading file
                        $profile_image = null;
                    }
                } else {
                    echo "Your file is too large. Please upload a file less than 2MB.";
                    exit;
                }
            } else {
                echo "There was an error uploading your file. Error code: " . $fileError;
                exit;
            }
        } else {
            echo "You cannot upload files of this type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }

        $update = $conn->prepare(
            "UPDATE emp_tbl 
            SET name = :name, 
                contact_number = :contact_number, 
                email = :email, 
                work_status = :work_status, 
                whatsapp = :whatsapp, 
                country_code = :country_code,
                profile_image = :profile_image
            WHERE id = :id"
        );

        $update->bindParam(':name', $name);
    $update->bindParam(':contact_number', $contact_number);
    $update->bindParam(':email', $email);
    $update->bindParam(':work_status', $work_status);
    $update->bindParam(':whatsapp', $whatsapp);
    $update->bindParam(':country_code', $country_code);
    $update->bindParam(':profile_image', $fileDestination);
    $update->bindParam(':id', $id); // Assuming $id is already defined, possibly from session

    }
    else{

    // Prepare SQL query to update employee information
    $update = $conn->prepare(
        "UPDATE emp_tbl 
        SET name = :name, 
            contact_number = :contact_number, 
            email = :email, 
            work_status = :work_status, 
            whatsapp = :whatsapp, 
            country_code = :country_code,
        WHERE id = :id"
    );

    $update->bindParam(':name', $name);
    $update->bindParam(':contact_number', $contact_number);
    $update->bindParam(':email', $email);
    $update->bindParam(':work_status', $work_status);
    $update->bindParam(':whatsapp', $whatsapp);
    $update->bindParam(':country_code', $country_code);
    $update->bindParam(':id', $id); // Assuming $id is already defined, possibly from session
}
    // Bind parameters
    

    // Execute the update query
    if ($update->execute()) {
        // If successful, update the session values
        $_SESSION['name'] = $name;
        $_SESSION['contact_number'] = $contact_number;
        $_SESSION['email'] = $email;
        $_SESSION['work_status'] = $work_status;
        $_SESSION['whatsapp'] = $whatsapp;
        $_SESSION['country_code'] = $country_code;
        $_SESSION['profile_image'] = $fileDestination;

        // Redirect to updated employee page with success message
        ?>
            <script type="text/javascript">
                alert("Updated Successfully");
                window.location.href = "edit-employee.php";
            </script>
        <?php
    } else {
        ?>
            <script type="text/javascript">
                alert("Error");
                window.location.href = "edit-employee.php";
            </script>
        <?php
        echo "Errors occurred";
    }
    exit;
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

    // PHP session country code
    const sessionCountryCode = "<?= $_SESSION['country_code'] ?>"; // Your PHP session value

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

                // Check if option.value matches session country code
                if (country.phonecode === sessionCountryCode) {
                    option.selected = true; // Set the matching option as selected
                }

                countrySelect.appendChild(option);
            });
        })
        .catch(error => console.log('Error:', error));
</script>