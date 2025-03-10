<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../config.php'; 
include 'includes/header.php'; 
?>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

<style>
    td {
        text-align: left;
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }
</style>

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
                        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
                            <h4 class="fw-bold mb-0">
                                <span class="text-muted fw-light">Home/</span> Manage Jobs
                            </h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobPostModal">
                                Create an Opening
                            </button>
                        </div>

                        <?php
                        $db = new DbConnect();
                        $connection = $db->connect();
                        $search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
                        $sno = 1;
                        $jobs = [];

                        if ($connection) {
                            try {
                                $query = "SELECT 
                                            post.sno, 
                                            post.employer_id, 
                                            post.job_title, 
                                            post.location, 
                                            post.status, 
                                            COALESCE(clients.company, employer_tbl.company_name) AS company_name
                                        FROM post
                                        JOIN employer_tbl ON post.employer_id = employer_tbl.id
                                        LEFT JOIN clients ON post.client_id = clients.id
                                        ORDER BY post.sno DESC";
                                
                                $stmt = $connection->prepare($query);
                                $stmt->execute();
                                $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                echo 'Query Error: ' . $e->getMessage();
                            }
                        } else {
                            echo "Failed to connect to the database!";
                        }
                        ?>

                        <!-- Jobs List Card -->
                        <div class="card">
                            <h5 class="card-header">List of Openings</h5>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap" style="min-height: 300px;">
                                    <table class="table table-hover" id="jobsTable">
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
                                            <?php if (!empty($jobs)): ?>
                                                <?php foreach ($jobs as $job): ?>
                                                    <tr>
                                                        <td><?php echo $sno++; ?></td>
                                                        <td>
                                                            <strong><?php echo htmlspecialchars($job['job_title']); ?></strong>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($job['company_name']); ?></td>
                                                        <td><?php echo htmlspecialchars($job['location']); ?></td>
                                                        <td>
                                                            <span class="badge bg-label-primary me-1">
                                                                <?php echo ucfirst(htmlspecialchars($job['status'])); ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="edit_job.php?id=<?php echo $job['sno']; ?>">
                                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No jobs found</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    $sql = "SELECT id, company FROM clients WHERE status = 1";

    // Prepare the SQL statement
    $stmt = $connection->prepare($sql);

    // Execute the query
    $stmt->execute();

    // Fetch all rows as an associative array
    $clientlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Iterate through the list of clients and generate <option> tags
    foreach($clientlist as $client) { 
        echo "<option value='" . $client['id'] . "'>" . $client['company'] . "</option>";
    }
?>

              </select>
              </div>
              </div>
             

              <!-- Job Description -->
              <div class="mb-3">
                <label class="form-label">Job Description <sup>*</sup></label>
                <textarea class="form-control" required name="job_description" id="job_description"></textarea>
              </div>

              <!-- Experience -->
              <div class="row">
                <div class="col-md-6">
                  <label class="form-label">Experience</label>
                  <div class="d-flex">
                    <div class="exp me-4">
                      <!-- <label class="form-label text-muted"><small>Min</small></label> -->
                      <select class="form-select exper-min" name="exper_min" id="exper_min">
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
                    </div>
                    <div class="exp">
                      <!-- <label class="form-label text-muted"><small>Max</small></label> -->
                      <select class="form-select exper-max" name="exper_max" id="exper_max">
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
                </div>

                <!-- Salary -->
                <div class="col-md-6">
                  <label class="form-label">Job Salary</label>
                  <div class="d-flex">
                    <input type="text" class="form-control me-4" name="salary_min" id="salary_min" placeholder="Min">
                    <input type="text" class="form-control" name="salary_max" id="salary_max" placeholder="Max">
                  </div>
                </div>
              </div>

              <!-- Job Location -->
              <div class="mb-3 mt-3">
                <label class="form-label">Preferred Job Location</label>
                <select class="form-control" name="job_location[]" id="job_location" multiple>
                  <option value="">--SELECT--</option>
                  <?php 
                    $locationlisting = new posts($conn);
                    $locationlist = $locationlisting->locationlist();
                    foreach($locationlist as $location) { 
                      echo "<option value='" . $location['name'] . "'>" . $location['name'] . "</option>";
                    } 
                  ?>
                </select>
              </div>

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
        foreach($rolelist as $role) { 
          echo "<option value='" . $role['name'] . "'>" . $role['name'] . "</option>";
        }
      ?>
    </select>
  </div>

  <!-- Openings -->
  <div class="col-md-6 mb-3">
    <label class="form-label">Openings</label>
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
              <input type="hidden" name="added_by" value="<?=$_SESSION['id']?>">
            </div>
          </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="save_data" class="btn btn-primary">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php
if(isset($_POST['save_data'])) {
  // var_dump($_POST);
  // exit;
  $job_title = $_POST['job_title']; 
  $job_description = $_POST['job_description']; 
  $exper_min = $_POST['exper_min']; 
  $exper_max = $_POST['exper_max']; 
  $salary_min = $_POST['salary_min']; 
  $salary_max = $_POST['salary_max']; 
  $location = $_POST['job_location']; 
  $client_id = $_POST['client_id'];
  $joblocation='';
  
  foreach ($location as $a){
    // echo $a;
    if ($joblocation=='') {
      $joblocation = $a;
    }else{
      $joblocation .= ', '.$a;
    }
  }
  // echo $joblocation;
  $seq=mt_rand(1, 1000);
  $role = $_POST['role']; 
  $openings = $_POST['openings']; 
  $industry_type = $_POST['industry_type']; 
  $function_area = $_POST['function_area']; 
  $emp_type = $_POST['emp_type']; 
  $role_category = $_POST['role_category']; 
  $education = $_POST['education']; 
  $skills = $_POST['skills']; 
  $employeer_id = $_POST['added_by']; 

  $addpost = new posts($conn);
  $add_post = $addpost->post_insert($employeer_id, $job_title, $job_description, $exper_min, $exper_max, $salary_min, $salary_max, $joblocation, $role, $openings, $industry_type, $function_area, $emp_type, $role_category, $education, $skills, 1, $seq,$client_id);

  if($addpost){
    echo '<script>alert("Job Created Successfully");</script>';
  }
  
}
?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="./assets/vendor/js/menu.js"></script>
    <script src="./assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- DataTables Scripts -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#jobsTable').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'asc']],
                language: {
                    search: "Search jobs:",
                    lengthMenu: "Show _MENU_ jobs per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ jobs",
                    infoEmpty: "Showing 0 to 0 of 0 jobs",
                    infoFiltered: "(filtered from _MAX_ total jobs)"
                }
            });
        });
    </script>
</body>
</html>
