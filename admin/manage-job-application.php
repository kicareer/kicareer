  <?php include '../config.php'; 
  // include('../classes/posts.php');
  include 'includes/header.php'; 
  ?>
  
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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home/</span> Manage Job Applications</h4>
                <div class="d-flex justify-content-end mb-3">
    </div>

    <?php

  $db = new DbConnect();
  // var_dump($_SESSION);
  // exit;
  // Get the PDO connection
  $connection = $db->connect();
  $sno = 1;
  if ($connection) {
      try {
          // Prepare and execute the query
          $query = "SELECT job_applications.id, applied_id, jobid, name, email, phone, dob, city, state,apply_position, job_city, job_applications.status FROM job_applications join post on job_applications.jobid=post.sno";
          $stmt = $connection->prepare($query);
          $stmt->execute();

          // Fetch all rows
          $applicants = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
          echo 'Query Error: ' . $e->getMessage();
      }
  } else {
      echo "Failed to connect to the database!";
  }
  ?>

  <div class="card p-4">
      <h5 class="card-header">List of Applications</h5>
      <div class="table-responsive text-nowrap" style="min-height: 300px;">
          <table class="table table-hover" id="applicationsTable">
              <thead>
                  <tr>
                      <th>Sno</th>
                      <th>Applicant Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>KI Resume</th>
                      <th>Residence</th>
                      <th>DOB</th>
                      <th>Position Applied</th>
                      <th>City</th>
                      <th>Status</th>
                      <!-- <th>Actions</th> -->
                  </tr>
              </thead>
              <tbody class="table-border-bottom-1">
                  <?php
                  if (!empty($applicants)) {
                      foreach ($applicants as $applicant) {
                          $status = $applicant['status'];
                          echo '<tr>';
                          echo '<td>' . $sno++ . '</td>';
                          echo '<td><strong>' . htmlspecialchars($applicant['name']) . '</strong></td>';
                          echo '<td>' . htmlspecialchars($applicant['email']) . '</td>';
                          echo '<td>' . htmlspecialchars($applicant['phone']) . '</td>';
                          echo '<td> <a href="kenz-resume.php?uid='. htmlspecialchars($applicant['applied_id']) . '" target="_blank"><i class="bx bx-file me-1"></i></a> <a href="generate_resume.php?post_id='. htmlspecialchars($applicant['id']) . '" target="_blank"><!--<i class="bx bx-download me-1"></i>--></a></td>';
                          echo '<td>' . htmlspecialchars($applicant['city']) . '</td>';
                          echo '<td>' . htmlspecialchars($applicant['dob']) . '</td>';
                          echo '<td>' . htmlspecialchars($applicant['apply_position']) . '</td>';
                          echo '<td>' . htmlspecialchars($applicant['job_city']) . '</td>';
                          echo '<td><button type="button" class="btn btn-sm badge bg-label-primary" data-bs-toggle="modal" data-bs-target="#statusModal' . $applicant['id'] . '">' . $status . '</button></td>';
                          echo '</tr>';

                          // Status Update Modal
                          echo '<div class="modal fade" id="statusModal' . $applicant['id'] . '" tabindex="-1" aria-hidden="true">';
                          echo '<div class="modal-dialog">';
                          echo '<div class="modal-content">';
                          echo '<div class="modal-header">';
                          echo '<h5 class="modal-title">Update Application Status</h5>';
                          echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                          echo '</div>';
                          echo '<div class="modal-body">';
                          echo '<form method="POST">';
                          echo '<input type="hidden" name="application_id" value="' . $applicant['id'] . '">';
                          echo '<div class="mb-3">';
                          echo '<label class="form-label">Status</label>';
                          echo '<select class="form-select" name="status">';
                          echo '<option value="in process" ' . ($status == 'in process' ? 'selected' : '') . '>In Process</option>';
                          echo '<option value="on hold" ' . ($status == 'on hold' ? 'selected' : '') . '>On Hold</option>';
                          echo '<option value="selected" ' . ($status == 'selected' ? 'selected' : '') . '>Selected</option>';
                          echo '<option value="rejected" ' . ($status == 'rejected' ? 'selected' : '') . '>Rejected</option>';
                          echo '</select>';
                          echo '</div>';
                          echo '<button type="submit" name="update_status" class="btn btn-primary">Update Status</button>';
                          echo '</form>';
                          
                          // Handle status update
                          if(isset($_POST['update_status'])) {
                              $application_id = $_POST['application_id'];
                              $new_status = $_POST['status'];
                              
                              $stmt = $connection->prepare("UPDATE job_applications SET status = :status WHERE id = :id");
                              $stmt->bindParam(':status', $new_status);
                              $stmt->bindParam(':id', $application_id);
                              
                              if($stmt->execute()) {
                                  echo "<script>window.location.href='manage-job-application.php';</script>";
                              } else {
                                  echo "<div class='alert alert-danger'>Error updating status</div>";
                              }
                          }
                          
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                      }
                  } else {
                      echo '<tr><td colspan="10" class="text-center">No applicants found</td></tr>';
                  }
                  ?>
              </tbody>
          </table>
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
                <!-- Job Title -->
                <div class="mb-3">
                  <label class="form-label">Job Title <sup>*</sup></label>
                  <input type="text" required class="form-control" name="job_title" id="job_title">
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
                          <option value="1 Year">1 Year</option>
                          <option value="2 Years">2 Years</option>
                          <option value="3 Years">3 Years</option>
                          <option value="4 Years">4 Years</option>
                          <option value="5 Years">5 Years</option>
                          <option value="6 Years">6 Years</option>
                          <option value="7 Years">7 Years</option>
                          <option value="8 Years">8 Years</option>
                          <option value="9 Years">9 Years</option>
                          <option value="10 Years">10+ Years</option>
                          <!-- More options... -->
                        </select>
                      </div>
                      <div class="exp">
                        <!-- <label class="form-label text-muted"><small>Max</small></label> -->
                        <select class="form-select exper-max" name="exper_max" id="exper_max">
                        <option value="">Max Experience</option>
                          <option value="0">Fresher</option>
                          <option value="1 Year">1 Year</option>
                          <option value="2 Years">2 Years</option>
                          <option value="3 Years">3 Years</option>
                          <option value="4 Years">4 Years</option>
                          <option value="5 Years">5 Years</option>
                          <option value="6 Years">6 Years</option>
                          <option value="7 Years">7 Years</option>
                          <option value="8 Years">8 Years</option>
                          <option value="9 Years">9 Years</option>
                          <option value="10 Years">10+ Years</option>
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
    $add_post = $addpost->post_insert($employeer_id, $job_title, $job_description, $exper_min, $exper_max, $salary_min, $salary_max, $joblocation, $role_category, $openings, $industry_type, $function_area, $emp_type, $role, $education, $skills, 1, $seq);

    if($addpost){
      echo '<script>window.location.href="?success"</script>';
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

      <!-- Add these in the header section, after the existing CSS -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

      <!-- Add these before the closing </body> tag, after the existing scripts -->
      <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#applicationsTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "responsive": true
          });
        });
      </script>
    </body>
  </html>
