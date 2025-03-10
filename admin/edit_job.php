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
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Manage Jobs</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

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
          
          <?php include 'includes/navbar.php'; ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home/</span> Edit Job</h4>
              <div class="d-flex justify-content-end mb-3">
              
              </div>
              <div class="card">
    <h5 class="card-header">Edit Form</h5>
    <div class="p-4" style="min-height: 300px;">
    <?php
// Include your database connection
// include 'db_connection.php';
if (isset($_GET['id'])) {
  $job_id = $_GET['id'];

  // Create an instance of the Posts class and get job data by ID
  $post = new Posts($conn);
  $job_data = $post->getJobById($job_id);

  if ($job_data) {
      // Extract data from $job_data array for easier form population
      extract($job_data);
      $location = explode(', ', $location); // Convert location string to array for multi-select
  } else {
      echo "Job not found.";
      exit;
  }
} else {
  echo "Invalid Job ID.";
  exit;
}
?>
<form method="post" action="">
        <input type="hidden" name="job_id" value="<?= htmlspecialchars($sno); ?>">
        <div class="row">
            <div class="col-md-6">
            <div class="mb-3">
            <label for="job_title" class="form-label">Job Title</label>
            <input type="text" class="form-control" name="job_title" id="job_title" value="<?= htmlspecialchars($job_title); ?>" required>
        </div>
            </div>
            <div class="col-md-6">
            <div class="mb-3">
                <label for="company_name" class="form-label">Select Client</label>
                <select class="form-select" name="client_id" id="client_id">
                    <option value="null">--SELECT CLIENT--</option>
                    <?php 
                    // Define the SQL query
                    $sql = "SELECT id, company FROM clients WHERE status = 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);    
                    foreach ($clients as $client) {
                        $selected = ($client['id'] == $client_id) ? 'selected' : '';
                        echo '<option value="' . $client['id'] . '" ' . $selected . '>' . $client['company'] . '</option>'; 
                    }
                    ?>
                </select>
                
            </div>
        </div>
        <!-- Job Title -->
        

        <!-- Job Description -->
        <div class="mb-3">
            <label for="job_description" class="form-label">Job Description</label>
            <textarea class="form-control" name="job_description" id="job_description" required><?= htmlspecialchars($job_description); ?></textarea>
        </div>

        <!-- Experience Min and Max -->
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="exper_min" class="form-label">Experience (Min)</label>
                <select class="form-select" name="exper_min" id="exper_min">
                    <option value="0" <?= $exper_min == '0' ? 'selected' : ''; ?>>Fresher</option>
                    <option value="1 Year" <?= $exper_min == '1 Year' ? 'selected' : ''; ?>>1 Year</option>
                    <option value="2 Years" <?= $exper_min == '2 Years' ? 'selected' : ''; ?>>2 Years</option>
                    <option value="3 Years" <?= $exper_min == '3 Years' ? 'selected' : ''; ?>>3 Years</option>
                    <option value="4 Years" <?= $exper_min == '4 Years' ? 'selected' : ''; ?>>4 Years</option>
                    <option value="5 Years" <?= $exper_min == '5 Years' ? 'selected' : ''; ?>>5 Years</option>
                    <option value="6 Years" <?= $exper_min == '6 Years' ? 'selected' : ''; ?>>6 Years</option>
                    <option value="7 Years" <?= $exper_min == '7 Years' ? 'selected' : ''; ?>>7 Years</option>
                    <option value="8 Years" <?= $exper_min == '8 Years' ? 'selected' : ''; ?>>8 Years</option>
                    <option value="9 Years" <?= $exper_min == '9 Years' ? 'selected' : ''; ?>>9 Years</option>
                    <option value="10+ Years" <?= $exper_min == '10+ Years' ? 'selected' : ''; ?>>10+ Years</option>
                    <!-- More options as needed -->
                </select>
            </div>
            <div class="col-md-6">
                <label for="exper_max" class="form-label">Experience (Max)</label>
                <select class="form-select" name="exper_max" id="exper_max">
                    <option value="0" <?= $exper_max == '0' ? 'selected' : ''; ?>>Fresher</option>
                    <option value="1 Year" <?= $exper_max == '1 Year' ? 'selected' : ''; ?>>1 Year</option>
                    <option value="2 Years" <?= $exper_max == '2 Years' ? 'selected' : ''; ?>>2 Years</option>
                    <option value="3 Years" <?= $exper_max == '3 Years' ? 'selected' : ''; ?>>3 Years</option>
                    <option value="4 Years" <?= $exper_max == '4 Years' ? 'selected' : ''; ?>>4 Years</option>
                    <option value="5 Years" <?= $exper_max == '5 Years' ? 'selected' : ''; ?>>5 Years</option>
                    <option value="6 Years" <?= $exper_max == '6 Years' ? 'selected' : ''; ?>>6 Years</option>
                    <option value="7 Years" <?= $exper_max == '7 Years' ? 'selected' : ''; ?>>7 Years</option>
                    <option value="8 Years" <?= $exper_max == '8 Years' ? 'selected' : ''; ?>>8 Years</option>
                    <option value="9 Years" <?= $exper_max == '9 Years' ? 'selected' : ''; ?>>9 Years</option>
                    <option value="10+ Years" <?= $exper_max == '10+ Years' ? 'selected' : ''; ?>>10+ Years</option>
                    <!-- More options as needed -->
                </select>
            </div>
        </div>

        <!-- Salary Min and Max -->
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="salary_min" class="form-label">Salary (Min)</label>
                <input type="text" class="form-control" name="salary_min" id="salary_min" value="<?= htmlspecialchars($salary_min); ?>" placeholder="Min">
            </div>
            <div class="col-md-6">
                <label for="salary_max" class="form-label">Salary (Max)</label>
                <input type="text" class="form-control" name="salary_max" id="salary_max" value="<?= htmlspecialchars($salary_max); ?>" placeholder="Max">
            </div>
        </div>

        <div class="row">
    <!-- Job Location -->
    <div class="col-md-6 mb-3">
            <label for="job_location" class="form-label">Preferred Job Location</label>
            <select class="form-select" name="job_location[]" id="job_location" multiple>
                <option value="">--SELECT--</option>
                <?php 
                    $locationlisting = new posts($conn);
                    $locationlist = $locationlisting->locationlist();
                    foreach($locationlist as $location) {
                        // Check if location is already selected
                        $selected = in_array($location['name'], $location) ? 'selected' : '';
                        echo "<option value='" . $location['name'] . "' $selected>" . $location['name'] . "</option>";
                    }
                ?>
            </select>
        </div>
<!-- Status -->
<div class="col-md-6 mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" name="status" id="status">
            <option value="">--SELECT--</option>
            <option value="active" <?= ($status == 'active') ? 'selected' : ''; ?>>Active</option>
            <option value="inactive" <?= ($status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
            <option value="on hold" <?= ($status == 'on hold') ? 'selected' : ''; ?>>On Hold</option>
        </select>
    </div>
</div>
        <!-- Role, Openings, Industry Type, Functional Area, and Employment Type -->
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" name="role" id="role" value="<?= htmlspecialchars($role); ?>">
            </div>
            <div class="col-md-6">
                <label for="openings" class="form-label">Openings</label>
                <input type="text" class="form-control" name="openings" id="openings" value="<?= htmlspecialchars($openings); ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="industry_type" class="form-label">Industry Type</label>
                <input type="text" class="form-control" name="industry_type" id="industry_type" value="<?= htmlspecialchars($industry_type); ?>">
            </div>
            <div class="col-md-6">
                <label for="function_area" class="form-label">Functional Area</label>
                <input type="text" class="form-control" name="function_area" id="function_area" value="<?= htmlspecialchars($function_area); ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="emp_type" class="form-label">Employment Type</label>
                <select class="form-select" name="emp_type" id="emp_type">
                    <option value="Full Time" <?= $emp_type == 'Full Time' ? 'selected' : ''; ?>>Full Time</option>
                    <option value="Part Time" <?= $emp_type == 'Part Time' ? 'selected' : ''; ?>>Part Time</option>
                    <option value="Contractual" <?= $emp_type == 'Contractual' ? 'selected' : ''; ?>>Contractual</option>
                    <!-- More options as needed -->
                </select>
            </div>
            <div class="col-md-6 mb-3">
            <label for="role_category" class="form-label">Role Category <sup>*</sup></label>
            <select class="form-select" required name="role_category" id="role_category">
                <option value="">--SELECT--</option>
                <?php 
                    $rolelisting = new posts($conn);
                    $rolelist = $rolelisting->rolelist();
                    foreach($rolelist as $role) {
                        $selected = ($role['name'] == $role_category) ? 'selected' : ''; 
                        echo "<option value='" . $role['name'] . "' $selected>" . $role['name'] . "</option>";
                    }
                ?>
            </select>
        </div>
        </div>

        <!-- Education and Key Skills -->
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="education" class="form-label">Education</label>
                <input type="text" class="form-control" name="education" id="education" value="<?= htmlspecialchars($education); ?>">
            </div>
            <div class="col-md-6">
                <label for="skills" class="form-label">Key Skills</label>
                <input type="text" class="form-control" name="skills" id="skills" value="<?= htmlspecialchars($skills); ?>">
            </div>
        </div>
        <div class="mb-3 row justify-content-center">
        <button type="submit" style="max-width: 250px;" name="update_data" class="btn btn-primary">Update Job</button>
        </div>
        <!-- Submit Button -->
        
    </form>

    </div>
              </div>
<!-- <script src="../js/bootstrap.js"></script> -->

            </div>
            <!-- / Content -->
<?php include 'includes/footer.php'; 

if (isset($_POST['update_data'])) {
  // Get the job ID from the hidden input
  $job_id = $_POST['job_id'];

  // Get the other form data
  $job_title = $_POST['job_title'];
  $job_description = $_POST['job_description'];
  $exper_min = $_POST['exper_min'];
  $exper_max = $_POST['exper_max'];
  $salary_min = $_POST['salary_min'];
  $salary_max = $_POST['salary_max'];
  $job_location = implode(', ', $_POST['job_location']); // Convert array to comma-separated string
  $role_category = $_POST['role_category'];
  $role = $_POST['role'];
  $openings = $_POST['openings'];
  $industry_type = $_POST['industry_type'];
  $function_area = $_POST['function_area'];
  $emp_type = $_POST['emp_type'];
  $education = $_POST['education'];
  $skills = $_POST['skills'];
  $status = $_POST['status']; // Get the status field
  $client_id = $_POST['client_id']; // Get the client ID from the session

  // Create an instance of the 'posts' class to interact with the database
  $post = new posts($conn);

  // Call the method to update the job details
  $updateStatus = $post->updateJob($job_id, $job_title, $job_description, $exper_min, $exper_max, $salary_min, $salary_max, $job_location, $role_category, $role, $openings, $industry_type, $function_area, $emp_type, $education, $skills, $status,$client_id);

  if ($updateStatus) {
      // If the update is successful, redirect to the job listing page or show a success message
      echo '<script>alert("Job updated successfully!"); window.location.href="manage-jobs.php";</script>';
  } else {
      // If there is an error, display an error message
      echo '<script>alert("Error updating job. Please try again."); window.history.back();</script>';
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
