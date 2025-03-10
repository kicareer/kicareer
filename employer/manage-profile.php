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
                                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                        <input list="countryCodesList" class="form-control" name="country_code" value="<?php echo htmlspecialchars($employer['country_code']); ?>">
                                                        <datalist id="countryCodesList">
                                                            <option value="<?php echo htmlspecialchars($employer['country_code']); ?>">
                                                        </datalist>
                                                    </div>
                                                    <input type="text" class="form-control" name="contact_number" value="<?php echo htmlspecialchars($employer['contact_number']); ?>">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name *</label>
                                                <input type="text" class="form-control" name="company_name" value="<?php echo htmlspecialchars($employer['company_name']); ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Designation *</label>
                                                <input type="text" class="form-control" name="designation" value="<?php echo htmlspecialchars($employer['designation']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Logo</label>
                                                <input type="file" class="form-control" name="company_logo" id="companyLogo">
                                                <?php if (!empty($employer['company_logo'])): ?>
                                                    <p>Current Logo: <img src="../<?php echo htmlspecialchars($employer['company_logo']); ?>" alt="Company Logo" width="100"></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Description *</label>
                                                <textarea class="form-control" name="company_description" required><?php echo htmlspecialchars($employer['company_description']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Address *</label>
                                                <textarea class="form-control" name="company_address" required><?php echo htmlspecialchars($employer['company_address']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="company_country" 
                                                       id="country" 
                                                       list="countryList" 
                                                       placeholder="Select Country"
                                                       value="<?php echo htmlspecialchars($employer['company_country']); ?>"
                                                       required
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
                                                       value="<?php echo htmlspecialchars($employer['company_state']); ?>"
                                                       required
                                                       autocomplete="off">
                                                <datalist id="stateList">
                                                    <!-- Will be populated via JavaScript -->
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="city" 
                                                       id="city" 
                                                       list="cityList" 
                                                       placeholder="Select City"
                                                       value="<?php echo htmlspecialchars($employer['city']); ?>"
                                                       autocomplete="off">
                                                <datalist id="cityList">
                                                    <!-- Will be populated via JavaScript -->
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control" name="company_pincode" value="<?php echo htmlspecialchars($employer['company_pincode']); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                                </form>

                                <script>
                                    const apiKey = "ZlkzaVR5cHRkaHkwRnNGQXlzVDRHWDVCT0w3NmxlOWtMaFk0NVNCdg==";
                                    const headers = new Headers();
                                    headers.append("X-CSCAPI-KEY", apiKey);

                                    const requestOptions = {
                                        method: 'GET',
                                        headers: headers,
                                        redirect: 'follow'
                                    };

                                    // Fetch and populate countries
                                    fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
                                        .then(response => response.json())
                                        .then(countries => {
                                            const countryList = document.getElementById('countryList');
                                            const countryCodesList = document.getElementById('countryCodesList');
                                            const savedCountry = '<?php echo htmlspecialchars($employer['company_country']); ?>';

                                            countries.forEach(country => {
                                                const option = document.createElement('option');
                                                option.value = country.name;
                                                option.setAttribute('data-countrycode', country.iso2);
                                                option.setAttribute('data-phonecode', country.phonecode);
                                                countryList.appendChild(option);

                                                const option2 = document.createElement('option');
                                                option2.value = country.phonecode;
                                                // option2.setAttribute('data-countrycode', country.iso2);
                                                option2.setAttribute('data-phonecode', country.phonecode);
                                                countryCodesList.appendChild(option2);
                                            });

                                            // If there's a saved country, trigger the state fetch
                                            if (savedCountry) {
                                                const countryOption = Array.from(countryList.options)
                                                    .find(opt => opt.value === savedCountry);
                                                if (countryOption) {
                                                    const countryCode = countryOption.getAttribute('data-countrycode');
                                                    fetchStates(countryCode);
                                                }
                                            }
                                        })
                                        .catch(error => console.log('Error fetching countries:', error));

                                    // Handle country selection change
                                    document.getElementById('country').addEventListener('change', function() {
                                        document.getElementById('state').value = '';
                                        document.getElementById('city').value = '';
                                        const selectedOption = Array.from(document.getElementById('countryList').options)
                                            .find(opt => opt.value === this.value);
                                        
                                        if (selectedOption) {
                                            const countryCode = selectedOption.getAttribute('data-countrycode');
                                            fetchStates(countryCode);
                                        }
                                    });

                                    function fetchStates(countryCode) {
                                        fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states`, requestOptions)
                                            .then(response => response.json())
                                            .then(states => {
                                                const stateList = document.getElementById('stateList');
                                                stateList.innerHTML = ''; // Clear previous options
                                                const savedState = '<?php echo htmlspecialchars($employer['company_state']); ?>';

                                                states.forEach(state => {
                                                    const option = document.createElement('option');
                                                    option.value = state.name;
                                                    option.setAttribute('data-statecode', state.iso2);
                                                    stateList.appendChild(option);
                                                });

                                                // If there's a saved state, trigger the city fetch
                                                if (savedState) {
                                                    const stateOption = Array.from(stateList.options)
                                                        .find(opt => opt.value === savedState);
                                                    if (stateOption) {
                                                        const stateCode = stateOption.getAttribute('data-statecode');
                                                        fetchCities(countryCode, stateCode);
                                                    }
                                                }
                                            })
                                            .catch(error => console.log('Error fetching states:', error));
                                    }

                                    // Handle state selection change
                                    document.getElementById('state').addEventListener('change', function() {
                                        document.getElementById('city').value = '';
                                        const countryInput = document.getElementById('country');
                                        const selectedCountryOption = Array.from(document.getElementById('countryList').options)
                                            .find(opt => opt.value === countryInput.value);
                                        
                                        const selectedStateOption = Array.from(document.getElementById('stateList').options)
                                            .find(opt => opt.value === this.value);
                                        
                                        if (selectedCountryOption && selectedStateOption) {
                                            const countryCode = selectedCountryOption.getAttribute('data-countrycode');
                                            const stateCode = selectedStateOption.getAttribute('data-statecode');
                                            fetchCities(countryCode, stateCode);
                                        }
                                    });

                                    function fetchCities(countryCode, stateCode) {
                                        fetch(`https://api.countrystatecity.in/v1/countries/${countryCode}/states/${stateCode}/cities`, requestOptions)
                                            .then(response => response.json())
                                            .then(cities => {
                                                const cityList = document.getElementById('cityList');
                                                cityList.innerHTML = ''; // Clear previous options
                                                
                                                cities.forEach(city => {
                                                    const option = document.createElement('option');
                                                    option.value = city.name;
                                                    cityList.appendChild(option);
                                                });
                                            })
                                            .catch(error => console.log('Error fetching cities:', error));
                                    }
                                </script>

                            </div>
                        </div>
                        <!-- <script src="../js/bootstrap.js"></script> -->

                    </div>
                    <!-- / Content -->
                    <?php include 'includes/footer.php';
                    if (isset($_POST['update_profile'])) {


                        // var_dump($_POST);
                        // exit;
                        // Retrieve and sanitize form data
                        $name = htmlspecialchars(trim($_POST['name']));
                        $email = htmlspecialchars(trim($_POST['email']));
                        $contact_number = htmlspecialchars(trim($_POST['contact_number']));
                        $company_name = htmlspecialchars(trim($_POST['company_name']));
                        $designation = htmlspecialchars(trim($_POST['designation']));
                        $company_description = htmlspecialchars(trim($_POST['company_description']));
                        $company_address = htmlspecialchars(trim($_POST['company_address']));
                        $city = htmlspecialchars(trim($_POST['city']));
                        $company_state = htmlspecialchars(trim($_POST['company_state']));
                        $company_country = htmlspecialchars(trim($_POST['company_country']));
                        $country_code = htmlspecialchars(trim($_POST['country_code']));
                        $company_pincode = htmlspecialchars(trim($_POST['company_pincode']));
                        $employer_id = $_SESSION['id']; // assuming 'id' holds the employer ID in the session

                        // Handling the logo upload
                        if (isset($_FILES['company_logo']) && $_FILES['company_logo']['error'] == 0) {
                            $logo_tmp_name = $_FILES['company_logo']['tmp_name'];
                            $logo_name = $_FILES['company_logo']['name'];
                            $logo_size = $_FILES['company_logo']['size'];
                            $logo_type = $_FILES['company_logo']['type'];

                            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                            $max_size = 5 * 1024 * 1024; // 5 MB limit

                            if (!in_array($logo_type, $allowed_types)) {
                                echo '<script>alert("Invalid file type. Only JPG, PNG, GIF allowed.");</script>';
                                exit;
                            }

                            if ($logo_size > $max_size) {
                                echo '<script>alert("File size too large. Max allowed size is 5MB.");</script>';
                                exit;
                            }

                            $logo_new_name = uniqid('logo_', true) . '.' . pathinfo($logo_name, PATHINFO_EXTENSION);
                            $upload_dir = '../uploads/company_logos/';
                            $upload_dir1 = 'uploads/company_logos/';

                            if (!is_dir($upload_dir)) {
                                mkdir($upload_dir, 0777, true);
                            }

                            if (move_uploaded_file($logo_tmp_name, $upload_dir . $logo_new_name)) {
                                $logo_path = $upload_dir1 . $logo_new_name;
                            } else {
                                echo '<script>alert("Error uploading file. Please try again.");</script>';
                                exit;
                            }
                        } else {
                            $logo_path = $_SESSION['company_logo']; // Keep the existing logo if no new one is uploaded
                        }

                        // Update employer profile in the database
                        try {
                            $update = $conn->prepare("UPDATE employer_tbl SET
            name = :name,
            email = :email,
            contact_number = :contact_number,
            company_name = :company_name,
            designation = :designation,
            company_description = :company_description,
            company_address = :company_address,
            city = :city,
            company_state = :company_state,
            company_country = :company_country,
            company_pincode = :company_pincode,
            company_logo = :company_logo,
            country_code = :country_code
            WHERE id = :id");

                            // Bind parameters
                            $update->bindParam(':name', $name);
                            $update->bindParam(':email', $email);
                            $update->bindParam(':contact_number', $contact_number);
                            $update->bindParam(':company_name', $company_name);
                            $update->bindParam(':designation', $designation);
                            $update->bindParam(':company_description', $company_description);
                            $update->bindParam(':company_address', $company_address);
                            $update->bindParam(':city', $city);
                            $update->bindParam(':company_state', $company_state);
                            $update->bindParam(':company_country', $company_country);
                            $update->bindParam(':company_pincode', $company_pincode);
                            $update->bindParam(':company_logo', $logo_path);
                            $update->bindParam(':country_code', $country_code); // Assuming $company_country is the country code
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
                                $_SESSION['country_code'] = $country_code;
                                $_SESSION['company_logo'] = $logo_path;
                                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><script>Swal.fire("Success", "Profile updated successfully.", "success").then(() => { window.location.href="./manage-profile.php"; });</script>';
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