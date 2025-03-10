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

  <title>Manage Jobs</title>

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
  <style>
    td {
      text-align: left;
      /* Ensure text wraps properly */
      word-wrap: break-word;
      /* For older browsers */
      word-break: break-word;
      /* Ensures text wraps mid-word if necessary */
      white-space: normal;
      /* Allows text wrapping */
    }
  </style>
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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home/</span> Manage Jobs</h4>
            <div class="d-flex justify-content-end mb-3">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobPostModal">
                Create an Opening
              </button>
            </div>
            <?php
            // Include the DbConnect class file
            // require_once 'DbConnect.php';

            // Instantiate the DbConnect class
            $db = new DbConnect();
            $connection = $db->connect();

            // Pagination variables
            $records_per_page = 10; // Number of jobs per page
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($current_page - 1) * $records_per_page;

            // Search variable
            $search_term = isset($_GET['search']) ? trim($_GET['search']) : '';

            $sno = $offset + 1; // Adjust sno for pagination
            $jobs = [];
            $total_records = 0;

            if ($connection) {
              try {
                // Count total records for pagination
                $count_query = "SELECT COUNT(*) FROM post 
                        JOIN employer_tbl ON post.employer_id = employer_tbl.id 
                        WHERE employer_id = :employer_id 
                        AND (job_title LIKE :search OR location LIKE :search OR employer_tbl.company_name LIKE :search) order by post.sno desc";
                $stmt = $connection->prepare($count_query);
                $search_term_wildcard = '%' . $search_term . '%';
                $stmt->bindParam(':employer_id', $_SESSION['employer_id'], PDO::PARAM_INT);
                $stmt->bindParam(':search', $search_term_wildcard, PDO::PARAM_STR);
                $stmt->execute();
                $total_records = $stmt->fetchColumn();

                // Fetch paginated results with search
                if (isset($_SESSION['kenz_recruiter'])) {
                  $query = "SELECT 
                    post.sno, 
                    post.employer_id, 
                    post.job_title, 
                    post.location, 
                    post.status, 
                    COALESCE(clients.company, employer_tbl.company_name) AS company_name
                FROM 
                    post
                JOIN 
                    employer_tbl ON post.employer_id = employer_tbl.id
                LEFT JOIN 
                    clients ON post.client_id = clients.id

                  WHERE post.employer_id = :employer_id 
                  and recruiter_id = :recruiter_id
                  AND (job_title LIKE :search OR location LIKE :search OR employer_tbl.company_name LIKE :search)  order by post.sno desc
                  LIMIT :offset, :records_per_page";
                  $stmt = $connection->prepare($query);
                  $recruiter_id = isset($_SESSION['kenz_recruiter']) ? $_SESSION['kenz_recruiter'] : $_SESSION['employer_id'];
                  $stmt->bindParam(':recruiter_id', $recruiter_id, PDO::PARAM_INT);
                  $stmt->bindParam(':employer_id', $_SESSION['employer_id'], PDO::PARAM_INT);
                  $stmt->bindParam(':search', $search_term_wildcard, PDO::PARAM_STR);
                  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                  $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
                  $stmt->execute();
                } else {
                  $query = "SELECT 
          post.sno, 
          post.employer_id, 
          post.job_title, 
          post.location, 
          post.status, 
          COALESCE(clients.company, employer_tbl.company_name) AS company_name
                FROM 
                    post
                JOIN 
                    employer_tbl ON post.employer_id = employer_tbl.id
                LEFT JOIN 
                    clients ON post.client_id = clients.id

                  WHERE post.employer_id = :employer_id
                  AND (job_title LIKE :search OR location LIKE :search OR employer_tbl.company_name LIKE :search) order by post.sno desc
                  LIMIT :offset, :records_per_page ";
                  $stmt = $connection->prepare($query);
                  $stmt->bindParam(':employer_id', $_SESSION['employer_id'], PDO::PARAM_INT);
                  $stmt->bindParam(':search', $search_term_wildcard, PDO::PARAM_STR);
                  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                  $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
                  $stmt->execute();
                }
                $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
              } catch (PDOException $e) {
                echo 'Query Error: ' . $e->getMessage();
              }
            } else {
              echo "Failed to connect to the database!";
            }
            ?>
            <div class="card">
              <h5 class="card-header">List of Openings</h5>
              <form method="GET" action="">
                <div class="mb-3 px-4 d-flex align-items-center justify-content-between">
                  <input type="text" name="search" class="form-control" placeholder="Search jobs..." value="<?php echo htmlspecialchars($search_term); ?>">
                  <button type="submit" class="btn btn-primary ml-1">Search</button>
                </div>
              </form>
              <div class="table-responsive text-nowrap" style="min-height: 300px;">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Sno</th>
                      <th>Job Title</th>
                      <th>Employer</th>
                      <th width="30%">Location</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-1">
                    <?php
                    if (!empty($jobs)) {
                      foreach ($jobs as $job) {
                        $status = ucfirst(htmlspecialchars($job['status']));
                        echo '<tr>';
                        echo '<td>' . $sno++ . '</td>';
                        echo '<td><strong>' . htmlspecialchars($job['job_title']) . '</strong></td>';
                        echo '<td>' . htmlspecialchars($job['company_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($job['location']) . '</td>';
                        echo '<td><span class="badge bg-label-primary me-1">' . $status . '</span></td>';
                        echo '<td>';
                        echo '<div class="dropdown">';
                        echo '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">';
                        echo '<i class="bx bx-dots-vertical-rounded"></i>';
                        echo '</button>';
                        echo '<div class="dropdown-menu">';
                        echo '<a class="dropdown-item" href="javascript:void(0);" onclick="previewJob(' . $job['sno'] . ')"><i class="bx bx-show me-1"></i> Preview</a>';
                        echo '<a class="dropdown-item" href="edit_job.php?id=' . $job['sno'] . '"><i class="bx bx-edit-alt me-1"></i> Edit</a>';
                        echo '<a class="dropdown-item" href="manage-job-application.php?postid=' . $job['sno'] . '"><i class="bx bx-user me-1"></i> View Applications</a>';
                        echo '<a class="dropdown-item" href="manage-matching-profiles.php?id=' . $job['sno'] . '"><i class="bx bx-user-check me-1"></i> Manage Matching Profiles</a>';
                        echo '<a class="dropdown-item" href="show_posters.php?id=' . $job['sno'] . '"><i class="bx bx-images me-1"></i> Choose Poster</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                      }
                    } else {
                      echo '<tr><td colspan="6" class="text-center">No jobs found</td></tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <nav class="d-flex justify-content-center mt-2">
                <ul class="pagination">
                  <?php
                  $total_pages = ceil($total_records / $records_per_page);
                  for ($i = 1; $i <= $total_pages; $i++) {
                    $active_class = ($i == $current_page) ? 'active' : '';
                    echo '<li class="page-item ' . $active_class . '">';
                    echo '<a class="page-link" href="?page=' . $i . '&search=' . urlencode($search_term) . '">' . $i . '</a>';
                    echo '</li>';
                  }
                  ?>
                </ul>
              </nav>
            </div>


            <!-- The Modal -->
            <div class="modal fade" id="jobPostModal" tabindex="-1" aria-labelledby="jobPostModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h5 class="modal-title" id="jobPostModalLabel">Job Post Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <!-- Modal Body with Form -->
                  <div class="modal-body">
                    <form method="post" action="" enctype="multipart/form-data">
                      <div class="container">
                        <div class="post_form">
                          <div class="row">
                            <div class="col-md-6">
                              <!-- Job Title -->
                              <div class="mb-3">
                                <label class="form-label">Job Title <sup>*</sup></label>
                                <input type="text" required class="form-control" name="job_title" id="job_title">
                              </div>

                            </div>
                            <div class="col-md-6">
                              <label class="form-label">Select Client <sup>*</sup></label>
                              <select class="form-control" required name="client_id" id="client_d">
                                <option value="null">--SELECT CLIENT--</option>
                                <?php
                                // Define the SQL query
                                $employer_id = $_SESSION['employer_id'];
                                $recruiter_id = $_SESSION['kenz_recruiter'];
                                // var_dump($_SESSION);
                                // exit;
                                $sql = "SELECT id, company FROM clients WHERE status = 1 and employer_id='$employer_id'";

                                if(isset($_SESSION['kenz_recruiter'])){
                                  $sql = "SELECT id, company FROM clients WHERE id in (select client_id from map_clients_recruiter where recruiter_id = $recruiter_id and employer_id=$employer_id)";
                                }
                                // Prepare the SQL statement
                                $stmt = $connection->prepare($sql);

                                // Execute the query
                                $stmt->execute();

                                // Fetch all rows as an associative array
                                $clientlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                // Iterate through the list of clients and generate <option> tags
                                foreach ($clientlist as $client) {
                                  echo "<option value='" . $client['id'] . "'>" . $client['company'] . "</option>";
                                }
                                ?>

                              </select>
                            </div>
                          </div>
                          <!-- Job Description -->
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Job Description <sup>*</sup></label>
                                <textarea class="form-control" required name="job_description" id="job_description"></textarea>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Preferred Job Location</label>
                                <select class="form-control" name="job_location[]" id="job_location" multiple>
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
                          </div>

                          <!-- Experience -->
                          <div class="col-md-12">
                          <div class="row">
                           
                             
                              <div class="col-md-6">
                              <label class="form-label">Experience</label>
                                <div class="d-flex">

                                  <!-- <label class="form-label text-muted"><small>Min</small></label> -->
                                  <select class="form-select me-4 exper-min" name="exper_min" id="exper_min">
                                    <option value="">Min Experience</option>
                                    <option value="0">Fresher</option>
                                    <option value="1">1 Year</option>
                                    <option value="2">2 Years</option>
                                    <option value="3">3 Years</option>
                                    <option value="4">4 Years</option>
                                    <option value="5">5 Years</option>
                                    <option value="6">6 Years</option>
                                    <option value="7">7 Years</option>
                                    <option value="8">8 Years</option>
                                    <option value="9">9 Years</option>
                                    <option value="10">10+ Years</option>
                                    <!-- More options... -->
                                  </select>

                                  <!-- <label class="form-label text-muted"><small>Max</small></label> -->
                                  <select class="form-select form-control exper-max" name="exper_max" id="exper_max">
                                    <option value="">Max Experience</option>
                                    <option value="0">Fresher</option>
                                    <option value="1">1 Year</option>
                                    <option value="2">2 Years</option>
                                    <option value="3">3 Years</option>
                                    <option value="4">4 Years</option>
                                    <option value="5">5 Years</option>
                                    <option value="6">6 Years</option>
                                    <option value="7">7 Years</option>
                                    <option value="8">8 Years</option>
                                    <option value="9">9 Years</option>
                                    <option value="10">10+ Years</option>
                                    <!-- More options... -->
                                  </select>

                                </div>
                              </div>

                              <div class="col-md-6">
                                <label class="form-label">Client's Budget</label>
                                <div class="d-flex">
                                  <div class="input-group me-4">
                                    <select class="form-select currency" name="client_budget_currency" id="client_budget_currency">
                                      <option value="">Select Currency</option>
                                      <option value="INR">INR</option>
                                      <option selected value="USD">USD</option>
                                      <option value="EUR">EUR</option>
                                      <option value="GBP">GBP</option>
                                      <option value="AUD">AUD</option>
                                      <option value="CAD">CAD</option>
                                      <option value="SGD">SGD</option>
                                      <option value="HKD">HKD</option>
                                      <option value="CNY">CNY</option>
                                      <option value="JPY">JPY</option>
                                      <option value="KRW">KRW</option>
                                      <option value="THB">THB</option>
                                      <option value="IDR">IDR</option>
                                      <option value="PHP">PHP</option>
                                      <option value="MYR">MYR</option>
                                      <option value="VND">VND</option>
                                      <option value="CZK">CZK</option>
                                      <option value="SEK">SEK</option>
                                      <option value="NOK">NOK</option>
                                      <option value="DKK">DKK</option>
                                      <option value="ZAR">ZAR</option>
                                      <option value="MXN">MXN</option>
                                      <option value="ARS">ARS</option>
                                      <option value="CLP">CLP</option>
                                      <option value="COP">COP</option>
                                      <option value="CUP">CUP</option>
                                      <option value="PEN">PEN</option>
                                      <option value="VEF">VEF</option>
                                      <option value="BOB">BOB</option>
                                      <option value="UYU">UYU</option>
                                      <option value="PAB">PAB</option>
                                      <option value="HNL">HNL</option>
                                      <option value="CRC">CRC</option>
                                      <option value="PTE">PTE</option>
                                      <option value="GNF">GNF</option>
                                      <option value="XOF">XOF</option>
                                      <option value="XAF">XAF</option>
                                      <option value="XPF">XPF</option>
                                      <option value="GHS">GHS</option>
                                      <option value="ZMW">ZMW</option>
                                      <option value="TZS">TZS</option>
                                      <option value="BIF">BIF</option>
                                      <option value="RWF">RWF</option>
                                      <option value="MGA">MGA</option>
                                      <option value="UGX">UGX</option>
                                      <option value="KES">KES</option>
                                      <option value="SSP">SSP</option>
                                      <option value="AOA">AOA</option>
                                      <option value="GMD">GMD</option>
                                      <option value="KMF">KMF</option>
                                      <option value="SOS">SOS</option>
                                      <option value="ZWL">ZWL</option>
                                      <option value="VEZ">VEZ</option>
                                      <option value="BOV">BOV</option>
                                      <option value="CLF">CLF</option>
                                      <option value="CVE">CVE</option>
                                      <option value="GQE">GQE</option>
                                      <option value="GNQ">GNQ</option>
                                      <option value="KWD">KWD</option>
                                      <option value="LSL">LSL</option>
                                      <option value="MZN">MZN</option>
                                      <option value="RSD">RSD</option>
                                      <option value="SRG">SRG</option>
                                      <option value="STD">STD</option>
                                      <option value="XCD">XCD</option>
                                      <option value="ZAL">ZAL</option>
                                      <option value="ZWL">ZWL</option>
                                      <option value="VEZ">VEZ</option>
                                      <option value="BOV">BOV</option>
                                      <option value="CLF">CLF</option>
                                      <option value="CVE">CVE</option>
                                      <option value="GQE">GQE</option>
                                      <option value="GNQ">GNQ</option>
                                      <!-- More options... -->
                                    </select>
                                    <!-- <input type="text" class="form-control" name="client_budget_min" id="client_budget_min" placeholder="Min Budget"> -->
                                  </div>
                                  <input type="text" class="form-control" name="client_budget_max" id="client_budget_max" placeholder="Max Budget">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Salary -->
                          <div class="col-md-12 mt-3">
                            <label class="form-label">Job Salary</label>
                            <div class="d-flex">
                              <input type="text" class="form-control me-4" name="salary_min" id="salary_min" placeholder="Min">
                              <input type="text" class="form-control" name="salary_max" id="salary_max" placeholder="Max">
                            </div>
                          </div>
                        </div>

                        <!-- Job Location -->


                        <!-- Role Category and Openings in One Row -->
                        <div class="row">
                          <!-- Role Category -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Role Category <sup>*</sup></label>
                            <select class="form-control" required name="role_category" id="role_category">
                              <option value="">--SELECT--</option>
                              <?php
                              $rolelisting = new posts($conn);
                              $rolelist = $rolelisting->rolelist();
                              foreach ($rolelist as $role) {
                                echo "<option value='" . $role['name'] . "'>" . $role['name'] . "</option>";
                              }
                              ?>
                            </select>
                          </div>

                          <!-- Openings -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Total Openings</label>
                            <input type="text" name="openings" class="form-control" id="openings">
                          </div>
                        </div>

                        <!-- Industry Type and Functional Area in One Row -->
                        <div class="row">
                          <!-- Industry Type -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Industry Type</label>
                            <input type="text" class="form-control" name="industry_type" id="industry_type">
                          </div>

                          <!-- Functional Area -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Functional Area</label>
                            <input type="text" class="form-control" name="function_area" id="function_area">
                          </div>
                        </div>

                        <!-- Employment Type and Role in One Row -->
                        <div class="row">
                          <!-- Employment Type -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Employment Type</label>
                            <select name="emp_type" class="form-control" id="emp_type">
                              <option value="">--SELECT--</option>
                              <option value="Full Time">Full Time</option>
                              <option value="Part Time">Part Time</option>
                              <option value="Contractual">Contractual</option>
                            </select>
                          </div>

                          <!-- Role -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" name="role" class="form-control" id="role">
                          </div>
                        </div>

                        <!-- Education and Key Skills in One Row -->
                        <div class="row">
                          <!-- Education -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Education</label>
                            <input type="text" name="education" class="form-control" id="education" placeholder="Ex. B.Tech, B.Sc">
                          </div>

                          <!-- Key Skills -->
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Key Skills</label>
                            <input type="text" name="skills" class="form-control" id="skills" placeholder="Ex. Java, SQL">
                          </div>
                        </div>


                        <!-- Hidden Field for Added By -->
                        <input type="hidden" name="added_by" value="<?= $_SESSION['employer_id'] ?>">
                        <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="save_data" class="btn btn-primary">Submit</button>
                </div>
                      </div>
                  </div>
                </div>

                <!-- Modal Footer -->
               
                </form>
              </div>
            </div>
          </div>


          <?php
          if (isset($_POST['save_data'])) {
            // var_dump($_POST);
            // exit;
            $job_title = $_POST['job_title'];
            $job_description = $_POST['job_description'];
            $exper_min = $_POST['exper_min'];
            $exper_max = $_POST['exper_max'];
            $salary_min = $_POST['salary_min'];
            $salary_max = $_POST['salary_max'];
            $location = $_POST['job_location'];
            $client_id = $_POST['client_id']=='null'? null: $_POST['client_id'];
            if (isset($_SESSION['kenz_recruiter'])) {
              $recruiter_id = $_SESSION['kenz_recruiter'];
            } else {
              $recruiter_id = null;
            }

            $joblocation = '';

            foreach ($location as $a) {
              // echo $a;
              if ($joblocation == '') {
                $joblocation = $a;
              } else {
                $joblocation .= ', ' . $a;
              }
            }
            // echo $joblocation;
            $seq = mt_rand(1, 1000);
            $role = $_POST['role'];
            $openings = $_POST['openings'];
            $industry_type = $_POST['industry_type'];
            $function_area = $_POST['function_area'];
            $emp_type = $_POST['emp_type'];
            $role_category = $_POST['role_category'];
            $education = $_POST['education'];
            $skills = $_POST['skills'];
            $employeer_id = $_POST['added_by'];
            $currency = $_POST['client_budget_currency'];
            $client_budget_max = $_POST['client_budget_max'];

            // Check if client_id is not selected, set it to employer_id for self
            if (empty($client_id)) {
              $client_id = $employeer_id;
            }

            $sql = "INSERT INTO `post` 
(`employer_id`, `job_title`, `job_description`, `exper_min`, `exper_max`, `currency`, `client_budget_max`, `salary_min`,  `salary_max`, `location`, `role`, `openings`, `industry_type`, `function_area`, `emp_type`, `role_category`, `education`, `skills`, `status`, `seq`, `client_id`, `recruiter_id`) 
VALUES 
(:employer_id, :job_title, :job_description, :exper_min, :exper_max, :currency, :client_budget_max, :salary_min, :salary_max, :location, :role, :openings, :industry_type, :function_area, :emp_type, :role_category, :education, :skills, :status, :seq, :client_id, :recruiter_id)";

            $addpost = $conn->prepare($sql);
            $add_post = $addpost->execute([
              ':employer_id' => $employeer_id,
              ':job_title' => $job_title,
              ':job_description' => $job_description,
              ':exper_min' => $exper_min,
              ':exper_max' => $exper_max,
              ':currency' => $currency,
              ':client_budget_max' => $client_budget_max,
              ':salary_min' => $salary_min,
              ':salary_max' => $salary_max,
              ':location' => $joblocation,
              ':role' => $role,
              ':openings' => $openings,
              ':industry_type' => $industry_type,
              ':function_area' => $function_area,
              ':emp_type' => $emp_type,
              ':role_category' => $role_category,
              ':education' => $education,
              ':skills' => $skills,
              ':status' => 1, // Default active status
              ':seq' => $seq,
              ':client_id' => $client_id,
              ':recruiter_id' => $recruiter_id,
            ]);

            if ($add_post) {
              echo '<script>alert("Job Posted Successfully");</script>';
              echo '<script>window.location.href="manage-jobs.php"</script>';
            } else {
              echo '<script>alert("Failed to Post Job");</script>';
            }
          }
          ?>
          <!-- <script src="../js/bootstrap.js"></script> -->

        </div>
        <!-- / Content -->
        <?php include 'includes/footer.php'; ?>

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

  <!-- Job Preview Modal -->
  <div class="modal fade" id="previewJobModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Job Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="job-preview-frame" style="width: 100%; height: 80vh; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add this before </body> tag -->
<script>
function previewJob(jobId) {
  console.log(jobId);
    // Set the iframe source to the view-job.php page
    document.getElementById('job-preview-frame').src = '../preview-job.php?id=' + jobId;
    
    // Show the modal
    var previewModal = new bootstrap.Modal(document.getElementById('previewJobModal'));
    previewModal.show();
}
</script>
</body>

</html>