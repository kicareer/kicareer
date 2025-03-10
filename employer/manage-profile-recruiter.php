<?php include '../config.php';
// include('../classes/posts.php');
?>
<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="./assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Manage Profile</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="./assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="./assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include 'includes/sidebar.php'; ?>

            <!-- Layout container -->
            <div class="layout-page">

                <?php include 'includes/top-bar.php'; ?>
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home/</span> Edit Profile</h4>
                        <div class="d-flex justify-content-end mb-3">

                        </div>
                        <div class="card">
                            <h5 class="card-header">Update Profile</h5>
                            <div class="p-4" style="min-height: 300px;">
                                <?php
                                // Include your database connection
                                // include 'db_connection.php';
                                // var_dump($_SESSION);
                                if (isset($_SESSION['id'])) {
                                    //   $job_id = $_SESSION['id'];
                                    $employer = $_SESSION;
                                    // Create an instance of the Posts class and get job data by ID

                                } else {
                                    echo "Invalid User ID.";
                                    exit;
                                }
                                ?>
                                <form action="" method="POST" enctype="multipart/form-data" id="updateProfileForm">
                                    <div class="row my-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name *</label>
                                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($employer['name']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input type="email" readonly class="form-control" name="email" value="<?php echo htmlspecialchars($employer['email']); ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" name="contact_number" value="<?php echo htmlspecialchars($employer['contact_number']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Profile Image</label>
                                                
                                                <input type="file" class="form-control" name="profile_image" accept=".jpg, .jpeg, .png, .gif">

                                                <div class="mb-3">
                                                    <img src="../<?php echo htmlspecialchars($employer['profile_image']); ?>" alt="Current Profile Image" class="img-fluid rounded-circle" style="max-width: 100px;">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    

                                    

                                   

                                    

                                    <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                                </form>

                                

                            </div>
                        </div>
                        <!-- <script src="../js/bootstrap.js"></script> -->

                    </div>
                    <!-- / Content -->
                    <?php include 'includes/footer.php';
                    if (isset($_POST['update_profile'])) {
                        // Retrieve and sanitize form data
                        $name = htmlspecialchars(trim($_POST['name']));
                        $email = htmlspecialchars(trim($_POST['email']));
                        $contact_number = htmlspecialchars(trim($_POST['contact_number']));
                       
                        $employer_id = $_SESSION['id']; // assuming 'id' holds the employer ID in the session

                        // Handling the profile image upload
                        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                            $profile_image_tmp_name = $_FILES['profile_image']['tmp_name'];
                            $profile_image_name = $_FILES['profile_image']['name'];
                            $profile_image_size = $_FILES['profile_image']['size'];
                            $profile_image_type = $_FILES['profile_image']['type'];

                            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                            $max_size = 5 * 1024 * 1024; // 5 MB limit

                            if (!in_array($profile_image_type, $allowed_types)) {
                                echo '<script>alert("Invalid file type. Only JPG, PNG, GIF allowed.");</script>';
                                exit;
                            }

                            if ($profile_image_size > $max_size) {
                                echo '<script>alert("File size too large. Max allowed size is 5MB.");</script>';
                                exit;
                            }

                            $profile_image_new_name = uniqid('profile_', true) . '.' . pathinfo($profile_image_name, PATHINFO_EXTENSION);
                            $upload_dir = '../uploads/profile_images/';
                            $upload_dir1 = 'uploads/profile_images/';

                            if (!is_dir($upload_dir)) {
                                mkdir($upload_dir, 0777, true);
                            }

                            if (move_uploaded_file($profile_image_tmp_name, $upload_dir . $profile_image_new_name)) {
                                $profile_image_path = $upload_dir1 . $profile_image_new_name;
                            } else {
                                echo '<script>alert("Error uploading file. Please try again.");</script>';
                                exit;
                            }
                        } else {
                            $profile_image_path = $_SESSION['profile_image']; // Keep the existing profile image if no new one is uploaded
                        }

                        // Update employer profile in the database
                        try {
                            $update = $conn->prepare("UPDATE recruiter_tbl SET
            name = :name,
            email = :email,
            contact_number = :contact_number,
            profile_image = :profile_image
            WHERE id = :id");

                            // Bind parameters
                            $update->bindParam(':name', $name);
                            $update->bindParam(':email', $email);
                            $update->bindParam(':contact_number', $contact_number);
                            $update->bindParam(':profile_image', $profile_image_path);
                            $update->bindParam(':id', $employer_id);

                            // Execute the update
                            if ($update->execute()) {
                                // Update session data
                                $_SESSION['name'] = $name;
                                $_SESSION['email'] = $email;
                                $_SESSION['contact_number'] = $contact_number;
                                $_SESSION['company_name'] = $company_name;
                                $_SESSION['designation'] = $designation;
                                $_SESSION['company_description'] = $company_description;
                                $_SESSION['company_address'] = $company_address;
                                $_SESSION['city'] = $city;
                                $_SESSION['company_state'] = $company_state;
                                $_SESSION['company_country'] = $company_country;
                                $_SESSION['company_pincode'] = $company_pincode;
                                $_SESSION['profile_image'] = $profile_image_path;

                                echo '<script>alert("Profile updated successfully."); window.location.href="./";</script>';
                            } else {
                                echo '<script>alert("Error updating profile. Please try again.");</script>';
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }
                    ?>

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="./assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="./assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>