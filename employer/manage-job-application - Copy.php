<?php 
include '../config.php'; 
// include('../classes/posts.php');
require_once '../vendor/autoload.php';
// require_once '../PHPMailer/PHPMailer.php';
// require_once '../PHPMailer/SMTP.php';
// require_once '../PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Create database connection first
$db = new DbConnect();
$connection = $db->connect();

if (!$connection) {
    echo "Failed to connect to the database!";
    exit;
}

$specific_job = false;
$job_details = null;

if (isset($_GET['postid'])) {
    $specific_job = true;
    // Get job details
    $stmt = $connection->prepare("SELECT post.*, clients.company 
                                FROM post 
                                JOIN clients ON post.client_id = clients.id 
                                WHERE post.sno = :postid AND post.employer_id = :employer_id");
    $stmt->bindParam(':postid', $_GET['postid']);
    $stmt->bindParam(':employer_id', $_SESSION['employer_id']);
    $stmt->execute();
    $job_details = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$job_details) {
        echo "<script>alert('Invalid job post!'); window.location.href='manage-jobs.php';</script>";
        exit;
    }
}

// Modify the existing query to filter by postid if specified
if ($connection) {
    try {
        $query = "SELECT distinct job_applications.id, applied_id, jobid, name, estimated_amount_paid, 
                 job_applications.email, job_applications.phone, job_applications.dob, city, state,
                 apply_position, job_city, job_applications.status, clients.company 
                 FROM job_applications 
                 JOIN post ON job_applications.jobid = post.sno
                 JOIN clients ON clients.id = post.client_id 
                 LEFT JOIN map_clients_recruiter ON post.employer_id = map_clients_recruiter.employer_id
                 WHERE post.employer_id = :employer_id";

        if ($specific_job) {
            $query .= " AND post.sno = :postid";
        }
        
        if (isset($_SESSION['kenz_recruiter'])) {
            $query .= " AND clients.id IN (SELECT client_id FROM map_clients_recruiter WHERE recruiter_id = :recruiter_id)";
        }
        
        $query .= " ORDER BY job_applications.id DESC";

        $stmt = $connection->prepare($query);
        $stmt->bindParam(':employer_id', $_SESSION['employer_id']);
        
        if ($specific_job) {
            $stmt->bindParam(':postid', $_GET['postid']);
        }
        
        if (isset($_SESSION['kenz_recruiter'])) {
            $stmt->bindParam(':recruiter_id', $_SESSION['kenz_recruiter']);
        }
        
        $stmt->execute();
        $applicants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Query Error: ' . $e->getMessage();
    }
}

// Modify the page title and header based on context
$page_title = $specific_job ? "Applications for " . htmlspecialchars($job_details['job_title']) : "Manage Job Applications";
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

    <title><?php echo $page_title; ?></title>

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
          
          <?php include 'includes/top-bar.php'; ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                  <span class="text-muted fw-light">Home/</span> 
                  <?php echo $page_title; ?>
              </h4>
              <div class="d-flex justify-content-end mb-3">
                  <?php if ($specific_job): ?>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addApplicantModal">
                          Add Applicant to <?php echo htmlspecialchars($job_details['job_title']); ?>
                      </button>
                  <?php else: ?>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addApplicantModal">
                          Add Applicant
                      </button>
                  <?php endif; ?>
              </div>

              <!-- Add Applicant Modal -->
              <div class="modal fade" id="addApplicantModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                          <?php echo $specific_job ? 
                              "Add Applicant to " . htmlspecialchars($job_details['job_title']) : 
                              "Add Applicant"; ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <?php if (!$specific_job): ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="client_id" class="form-label">Client</label>
                                        <select class="form-select" name="client_id" id="client_id" onchange="get_jobs_by_client(this.value)" required>
                                            <option value="">--SELECT CLIENT--</option>
                                            <?php 
                                            $sql = "SELECT distinct clients.id, company FROM clients left join map_clients_recruiter on clients.id = map_clients_recruiter.client_id WHERE clients.employer_id = $_SESSION[employer_id]";
                                            if(isset($_SESSION['kenz_recruiter'])){
                                              $sql .= " and map_clients_recruiter.recruiter_id = $_SESSION[kenz_recruiter]";
                                            }
                                           
                                            $stmt = $connection->prepare($sql);
                                            $stmt->execute();
                                            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);    
                                            foreach ($clients as $client) {
                                                echo '<option value="' . $client['id'] . '">' . $client['company'] . '</option>'; 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="job_id" class="form-label">Job</label>
                                        <select class="form-select" name="job_id" id="job_id" required>
                                            <option value="">--SELECT JOB--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="client_id" value="<?php echo htmlspecialchars($job_details['client_id']); ?>">
                            <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($_GET['postid']); ?>">
                            <?php endif; ?>

                            <script>
                                function get_jobs_by_client(client_id) {
                                  console.log(client_id)
                                    var url = "get_jobs_by_client.php?client_id="+client_id;
                                    fetch(url)
                                        .then(response => response.text())
                                        .then(data => {
                                          var jobs = JSON.parse(data);
                                          console.log(jobs);
                                            var options = `<option value="null">--SELECT JOB--</option>`;
                                            jobs.forEach(job => {
                                                options += `<option value="${job.sno}">${job.job_title}</option>`;
                                            });
                                            document.getElementById("job_id").innerHTML = options;
                                        });
                                }
                            </script>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="profile_image" class="form-label">Profile Image</label>
                                        <input type="file" class="form-control" id="profile_image" name="profile_image" aria-describedby="profile_imageHelp">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="country_code" class="form-label">Country Code</label>
                                        <select class="form-select" id="country_code" name="country_code" aria-describedby="country_codeHelp" required>
                                            <option value="+91">+91 (India)</option>
                                            <option value="+1">+1 (United States)</option>
                                            <option value="+44">+44 (United Kingdom)</option>
                                            <option value="+61">+61 (Australia)</option>
                                            <option value="+65">+65 (Singapore)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_number" class="form-label">Contact Number</label>
                                        <input type="number" class="form-control" id="contact_number" onchange="this.value=this.value.replace(/^0+/, '')" name="contact_number" aria-describedby="contact_numberHelp" required>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" aria-describedby="dobHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="apply_position" class="form-label">Role Applied For</label>
                                        <input type="text" class="form-control" id="apply_position" name="apply_position" aria-describedby="apply_positionHelp" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="work_status" class="form-label">Work Status</label>
                                        <select class="form-select" id="work_status" name="work_status" aria-describedby="work_statusHelp" required>
                                            <option value="">Select Work Status</option>
                                            <option value="Fresher">Fresher</option>
                                            <option value="Experience">Experience</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="resume" class="form-label">Resume</label>
                                        <input type="file" class="form-control" id="resume" name="resume" aria-describedby="resumeHelp" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="experience" class="form-label">Total Experience</label>
                                        <input type="number" class="form-control" id="experience" name="experience" aria-describedby="experienceHelp" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
        
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="professional_summary" class="form-label">Professional Summary</label>
                                        <textarea class="form-control" id="professional_summary" name="professional_summary" aria-describedby="professional_summaryHelp"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Education Details -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5>Education Details</h5>
                                    <div id="education_fields">
                                        <div class="education-entry mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Degree</label>
                                                    <input type="text" name="education[0][degree]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">University/Institution</label>
                                                    <input type="text" name="education[0][university]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Start Date</label>
                                                    <input type="date" name="education[0][start_date]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">End Date</label>
                                                    <input type="date" name="education[0][end_date]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="education[0][description]" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="addEducationField()">Add More Education</button>
                                </div>
                            </div>

                            <!-- Skills -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5>Skills</h5>
                                    <div id="skills_fields">
                                        <div class="skill-entry mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Skill Name</label>
                                                    <input type="text" name="skills[0][name]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Skill Level</label>
                                                    <select name="skills[0][level]" class="form-control" required>
                                                        <option value="Beginner">Beginner</option>
                                                        <option value="Intermediate">Intermediate</option>
                                                        <option value="Expert">Expert</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="addSkillField()">Add More Skills</button>
                                </div>
                            </div>

                            <!-- Work Experience -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5>Work Experience</h5>
                                    <div id="experience_fields">
                                        <div class="experience-entry mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Job Title</label>
                                                    <input type="text" name="experience[0][job_title]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Company Name</label>
                                                    <input type="text" name="experience[0][company_name]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Start Date</label>
                                                    <input type="date" name="experience[0][start_date]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">End Date</label>
                                                    <input type="date" name="experience[0][end_date]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="experience[0][description]" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="addExperienceField()">Add More Experience</button>
                                </div>
                            </div>

                            <!-- Projects -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5>Projects</h5>
                                    <div id="project_fields">
                                        <div class="project-entry mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Project Name</label>
                                                    <input type="text" name="projects[0][name]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Client</label>
                                                    <input type="text" name="projects[0][client]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Role</label>
                                                    <input type="text" name="projects[0][role]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Technologies</label>
                                                    <input type="text" name="projects[0][technologies]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Start Date</label>
                                                    <input type="date" name="projects[0][start_date]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">End Date</label>
                                                    <input type="date" name="projects[0][end_date]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="projects[0][description]" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="addProjectField()">Add More Projects</button>
                                </div>
                            </div>

                            <!-- Certificates -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5>Certificates</h5>
                                    <div id="certificate_fields">
                                        <div class="certificate-entry mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Certificate Name</label>
                                                    <input type="text" name="certificates[0][certificate_name]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Issued By</label>
                                                    <input type="text" name="certificates[0][issued_by]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label class="form-label">Issue Date</label>
                                                    <input type="date" name="certificates[0][issue_date]" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Valid Till</label>
                                                    <input type="date" name="certificates[0][valid_till]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="certificates[0][description]" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="addCertificateField()">Add More Certificates</button>
                                </div>
                            </div>

                            <!-- Additional Documents -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <h5>Additional Documents</h5>
                                    <div id="document_fields">
                                        <div class="document-entry mb-3">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label class="form-label">Document Type</label>
                                                    <select name="documents[0][type]" class="form-control" required>
                                                        <option value="">Select Document Type</option>
                                                        <option value="Offer Letter">Offer Letter</option>
                                                        <option value="ID Proof">ID Proof</option>
                                                        <option value="Address Proof">Address Proof</option>
                                                        <option value="Experience Letter">Experience Letter</option>
                                                        <option value="Salary Slip">Salary Slip</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Document File</label>
                                                    <input type="file" name="documents[0][file]" class="form-control" required>
                                                    <small class="text-muted">Allowed formats: PDF, DOC, DOCX, JPG, JPEG, PNG (Max size: 2MB)</small>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">&nbsp;</label>
                                                    <button type="button" class="btn btn-danger remove-document" onclick="this.closest('.document-entry').remove()">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="addDocumentField()">Add More Documents</button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" name="add_applicant" class="btn btn-primary center mt-2">Add Applicant</button>

                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              
              if (isset($_POST['add_applicant'])) {
                  try {
                      $connection->beginTransaction();

                      // Handle profile image upload
                      $profile_image = '';
                      if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                          $upload_dir = '../uploads/profile/';
                          $upload_dir1 = 'uploads/profile/';
                          if (!file_exists($upload_dir)) {
                              mkdir($upload_dir, 0777, true);
                          }
                          $profile_image = time() . '_' . $_FILES['profile_image']['name'];
                          $profile_image_path = $upload_dir . $profile_image;
                          if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image_path)) {
                              $profile_image = $upload_dir1 . $profile_image;
                          }
                      }

                      // Handle resume upload
                      $resume = '';
                      if(isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
                          $upload_dir = '../uploads/resumes/';
                          $upload_dir1 = 'uploads/resumes/';
                          if (!file_exists($upload_dir)) {
                              mkdir($upload_dir, 0777, true);
                          }
                          $resume = time() . '_' . $_FILES['resume']['name'];
                          $resume_path = $upload_dir . $resume;
                          if(move_uploaded_file($_FILES['resume']['tmp_name'], $resume_path)) {
                              $resume = $upload_dir1 . $resume;
                          }
                      }

                      // Basic applicant details insertion
                      $stmt = $connection->prepare("INSERT INTO emp_tbl (name, profile_image, contact_number, country_code, 
                          email, professional_summary, resume, added_date,status) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, NOW(),'active')");
                      $stmt->execute([
                          $_POST['name'], 
                          $profile_image, 
                          $_POST['contact_number'], 
                          $_POST['country_code'], 
                          $_POST['email'], 
                          $_POST['professional_summary'],
                          $resume
                      ]);
                      
                      $emp_id = $connection->lastInsertId();

                      // Generate temporary password and update emp_tbl
                      $temp_password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                      $hashed_password = hash('sha256', $temp_password);

                      // Update the password in emp_tbl
                      $update_pwd = $connection->prepare("UPDATE emp_tbl SET password = ? WHERE id = ?");
                      $update_pwd->execute([$hashed_password, $emp_id]);

                      // Insert Education Details
                      if (isset($_POST['education']) && is_array($_POST['education'])) {
                          $edu_stmt = $connection->prepare("INSERT INTO education_tbl (emp_id, degree, university_name, 
                              start_date, end_date, description, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
                          
                          foreach ($_POST['education'] as $education) {
                              $edu_stmt->execute([
                                  $emp_id,
                                  $education['degree'],
                                  $education['university'],
                                  $education['start_date'],
                                  $education['end_date'],
                                  $education['description']
                              ]);
                          }
                      }

                      // Insert Skills
                      if (isset($_POST['skills']) && is_array($_POST['skills'])) {
                          $skill_stmt = $connection->prepare("INSERT INTO employee_skills_tbl (emp_id, skill_name, 
                              skill_level, created_at) VALUES (?, ?, ?, NOW())");
                          
                          foreach ($_POST['skills'] as $skill) {
                              $skill_stmt->execute([
                                  $emp_id,
                                  $skill['name'],
                                  $skill['level']
                              ]);
                          }
                      }

                      // Insert Work Experience
                      if (isset($_POST['experience']) && is_array($_POST['experience'])) {
                          $exp_stmt = $connection->prepare("INSERT INTO experience_tbl (emp_id, job_title, 
                              company_name, start_date, end_date, description, created_at) 
                              VALUES (?, ?, ?, ?, ?, ?, NOW())");
                          
                          foreach ($_POST['experience'] as $experience) {
                              $exp_stmt->execute([
                                  $emp_id,
                                  $experience['job_title'],
                                  $experience['company_name'],
                                  $experience['start_date'],
                                  $experience['end_date'],
                                  $experience['description']
                              ]);
                          }
                      }

                      // Insert Projects
                      if (isset($_POST['projects']) && is_array($_POST['projects'])) {
                          $proj_stmt = $connection->prepare("INSERT INTO projects_tbl (emp_id, project_name, 
                              client, role, description, start_date, end_date, technologies, created_at) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                          
                          foreach ($_POST['projects'] as $project) {
                              $proj_stmt->execute([
                                  $emp_id,
                                  $project['name'],
                                  $project['client'],
                                  $project['role'],
                                  $project['description'],
                                  $project['start_date'],
                                  $project['end_date'],
                                  $project['technologies']
                              ]);
                          }
                      }

                      // Insert Certificates
                      if (isset($_POST['certificates']) && is_array($_POST['certificates'])) {
                          $cert_stmt = $connection->prepare("INSERT INTO certificates_tbl (emp_id, certificate_name, 
                              issued_by, issue_date, valid_till, description, created_at) 
                              VALUES (:emp_id, :certificate_name, :issued_by, :issue_date, :valid_till, :description, NOW())");
                          
                          foreach ($_POST['certificates'] as $certificate) {
                              $cert_stmt->execute([
                                  ':emp_id' => $emp_id,
                                  ':certificate_name' => $certificate['certificate_name'],
                                  ':issued_by' => $certificate['issued_by'],
                                  ':issue_date' => $certificate['issue_date'],
                                  ':valid_till' => $certificate['valid_till'],
                                  ':description' => $certificate['description']
                              ]);
                          }
                      }

                      // Handle document uploads
                      if (isset($_FILES['documents'])) {
                          $upload_dir = '../uploads/candidate_documents/';
                          $upload_dir1 = 'uploads/candidate_documents/';
                          if (!file_exists($upload_dir)) {
                              mkdir($upload_dir, 0777, true);
                          }

                          $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
                          $max_size = 2 * 1024 * 1024; // 2MB

                          $doc_stmt = $connection->prepare("INSERT INTO candidate_documents (emp_id, document_type, document_path) 
                              VALUES (:emp_id, :document_type, :document_path)");

                          foreach ($_FILES['documents']['name'] as $key => $value) {
                              if ($_FILES['documents']['error'][$key]['file'] == 0) {
                                  $file_tmp = $_FILES['documents']['tmp_name'][$key]['file'];
                                  $file_type = strtolower(pathinfo($_FILES['documents']['name'][$key]['file'], PATHINFO_EXTENSION));
                                  $file_size = $_FILES['documents']['size'][$key]['file'];

                                  // Validate file
                                  if (!in_array($file_type, $allowed_types)) {
                                      error_log("Invalid file type: " . $file_type);
                                      continue;
                                  }

                                  if ($file_size > $max_size) {
                                      error_log("File too large: " . $file_size);
                                      continue;
                                  }

                                  // Generate unique filename
                                  $file_name = time() . '_' . $emp_id . '_' . preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['documents']['name'][$key]['file']);
                                  $file_path = $upload_dir . $file_name;

                                  if (move_uploaded_file($file_tmp, $file_path)) {
                                      try {
                                          $doc_stmt->execute([
                                              ':emp_id' => $emp_id,
                                              ':document_type' => $_POST['documents'][$key]['type'],
                                              ':document_path' => $upload_dir1 . $file_name
                                          ]);
                                      } catch (PDOException $e) {
                                          error_log("Error saving document to database: " . $e->getMessage());
                                      }
                                  } else {
                                      error_log("Failed to move uploaded file: " . $file_tmp . " to " . $file_path);
                                  }
                              } else {
                                  error_log("File upload error code: " . $_FILES['documents']['error'][$key]['file']);
                              }
                          }
                      }

                      // Insert into job_applications table
                      $app_stmt = $connection->prepare("INSERT INTO job_applications (
                          applied_id, 
                          jobid, 
                          name, 
                          email, 
                          phone,
                          dob,
                          apply_position,
                          status, 
                          profile_image, 
                          resume_file
                      ) VALUES (
                          ?, ?, ?, ?, ?, ?, ?, 'in process', ?, ?
                      )");
                      $app_stmt->execute([
                          $emp_id,
                          $_POST['job_id'],
                          $_POST['name'],
                          $_POST['email'],
                          $_POST['contact_number'],
                          $_POST['dob'],
                          $_POST['apply_position'],
                          $profile_image,
                          $resume
                      ]);

                      // Send email before commit
                      $mail = new PHPMailer(true);

                      try {
                          // Server settings
                          $mail->isSMTP();
                          $mail->Host = 'smtp.gmail.com';
                          $mail->SMTPAuth = true;
                          $mail->Username = 'kicareer01@gmail.com';
                          $mail->Password = 'myen caef fslf jiyw';
                          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                          $mail->Port = 587;

                          // Recipients
                          $mail->setFrom('kicareer01@gmail.com', 'KI Careers');
                          $mail->addAddress($_POST['email'], $_POST['name']);

                          // Content
                          $mail->isHTML(true);
                          $mail->Subject = 'Welcome to KI Careers Portal - Your Account Details';
                          $mail->Body = '
                              <p>Dear ' . htmlspecialchars($_POST['name']) . ',</p>
                              <p>Your account has been created successfully in KI Careers Portal, you can now login to your account. Below are your login credentials:</p>
                              <p><strong>Email:</strong> ' . htmlspecialchars($_POST['email']) . '</p>
                              <p><strong>Temporary Password:</strong> ' . $temp_password . '</p>
                              <p>Please login and change your password for security purposes.</p>
                              <p>Login URL: <a href="https://ki-careers.com/login.php">https://ki-careers.com/login.php</a></p>
                              <p>Best regards,<br>KI Careers Team</p>
                          ';

                          $mail->send();
                          error_log("Email sent successfully to: " . $_POST['email']);
                          $_SESSION['mail_sent'] = true;

                      } catch (Exception $e) {
                          error_log("Email sending failed. Mailer Error: {$mail->ErrorInfo}");
                          $_SESSION['mail_error'] = "Account created but email couldn't be sent. Error: " . $mail->ErrorInfo;
                      }

                      // If everything is successful, commit the transaction
                      $connection->commit();
                      echo "<script>alert('Applicant added successfully!'); window.location.href='manage-job-application.php';</script>";
                      
                  } catch (PDOException $e) {
                      $connection->rollBack();
                      echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
                  }
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

                // Fetch and populate countries with the specified format
                fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
                    .then(response => response.json())
                    .then(countries => {
                        const countrySelect = document.getElementById('country_code');
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
                            })
                            .catch(error => console.log('Error fetching countries:', error));

                    })

    </script>

<div class="card">
    <h5 class="card-header">List of Applications</h5>
    <div class="table-responsive text-nowrap" style="min-height: 300px;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Applicant Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>KI Resume</th>
                    <!-- <th>Residence</th> -->
                    <th>DOB</th>
                    <th>Position Applied</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-1">
                <?php
                $sno = 1;
                if (!empty($applicants)) {
                    foreach ($applicants as $applicant) {
                        $status = $applicant['status'];
                        echo '<tr>';
                        echo '<td>' . $sno++ . '</td>';
                        echo '<td><strong>' . htmlspecialchars($applicant['name']) . '</strong></td>';
                        echo '<td>' . htmlspecialchars($applicant['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($applicant['phone']) . '</td>';
                        echo '<td> <a href="kenz-resume.php?uid='. htmlspecialchars($applicant['applied_id']) . '" target="_blank"><i class="bx bx-file me-1"></i></a> <a href="generate_resume.php?uid='. htmlspecialchars($applicant['applied_id']) . '" target="_blank"><!-- <i class="bx bx-download me-1"></i> --></a></td>';
                        // echo '<td>' . htmlspecialchars($applicant['city']) . '</td>';
                        echo '<td>' . htmlspecialchars($applicant['dob']) . '</td>';
                        echo '<td>' . htmlspecialchars($applicant['apply_position']) . '</td>';
                        echo '<td>' . htmlspecialchars($applicant['company']) . '</td>';
                        echo '<td><span class="badge bg-label-primary me-1">' . $status . '</span></td>';
                        echo '<td>';
                        echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#update_status_modal_' . $applicant['id'] . '">Edit</button>';
                        echo '</td>';

                        echo '<div class="modal fade" id="update_status_modal_' . $applicant['id'] . '" tabindex="-1" aria-labelledby="update_status_modal_Label" aria-hidden="true">';
                        echo '<div class="modal-dialog">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="update_status_modal_Label">Update Status</h5>';
                        echo '<button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                        echo '<form method="post" action="">';
                        echo '<div class="mb-3">';
                        echo '<label class="form-label">Status</label>';
                        echo '<select class="form-control" name="status">';
                        echo '<option value="in process" ' . (($status == 'in process') ? 'selected' : '') . '>In Process</option>';
                        echo '<option value="on hold" ' . (($status == 'on hold') ? 'selected' : '') . '>On Hold</option>';
                        echo '<option value="selected" ' . (($status == 'selected') ? 'selected' : '') . '>Selected</option>';
                        echo '<option value="rejected" ' . (($status == 'rejected') ? 'selected' : '') . '>Rejected</option>';
                        echo '</select>';
                        echo '</div>';
                        echo '<div class="mb-3">';
                        echo '<label class="form-label">Estimated Amount Paid</label>';
                        echo '<input type="number" class="form-control" name="estimated_amount_paid" value="' . $applicant['estimated_amount_paid'] . '">';
                        echo '</div>';
                        

                        echo '<input type="hidden" name="id" value="' . $applicant['id'] . '">';
                        echo '<button type="submit" name="update_status" class="btn btn-primary">Update</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</tr>';
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
              <input type="hidden" name="added_by" value="<?=$_SESSION['employer_id']?>">
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

if (isset($_POST['update_status'])) {
  // var_dump($_POST);
  // exit;
  $id = $_POST['id'];
  $status = $_POST['status'];
  $estimated_amount_paid = $_POST['estimated_amount_paid'];
  $query = "UPDATE job_applications SET status = ?, estimated_amount_paid= ? WHERE id = ?";
  $stmt = $connection->prepare($query);
  if ($stmt->execute([$status, $estimated_amount_paid,$id])) {
      // header("Location: manage-job-application.php");
      echo '<script>alert("Status updated successfully!");</script>';
      echo  '<script>window.location.href="manage-job-application.php";</script>';
      exit;
  } else {
      echo "Error updating record: " . $stmt->error;
  }
}
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

    <!-- Add this JavaScript for dynamic field addition -->
    <script>
    let educationCount = 1;
    let skillCount = 1;
    let projectCount = 1;
    let experienceCount = 1;
    let certificateCount = 1;
    let documentCount = 1;

    function addEducationField() {
        const html = `
            <div class="education-entry mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Degree</label>
                        <input type="text" name="education[${educationCount}][degree]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">University/Institution</label>
                        <input type="text" name="education[${educationCount}][university]" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="education[${educationCount}][start_date]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <input type="date" name="education[${educationCount}][end_date]" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="education[${educationCount}][description]" class="form-control"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="this.parentElement.remove()">Remove</button>
            </div>
        `;
        document.getElementById('education_fields').insertAdjacentHTML('beforeend', html);
        educationCount++;
    }

    function addSkillField() {
        const html = `
            <div class="skill-entry mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Skill Name</label>
                        <input type="text" name="skills[${skillCount}][name]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Skill Level</label>
                        <select name="skills[${skillCount}][level]" class="form-control" required>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="this.parentElement.remove()">Remove</button>
            </div>
        `;
        document.getElementById('skills_fields').insertAdjacentHTML('beforeend', html);
        skillCount++;
    }

    function addProjectField() {
        const html = `
            <div class="project-entry mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Project Name</label>
                        <input type="text" name="projects[${projectCount}][name]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Client</label>
                        <input type="text" name="projects[${projectCount}][client]" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <input type="text" name="projects[${projectCount}][role]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Technologies</label>
                        <input type="text" name="projects[${projectCount}][technologies]" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="projects[${projectCount}][start_date]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <input type="date" name="projects[${projectCount}][end_date]" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="projects[${projectCount}][description]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="this.parentElement.remove()">Remove</button>
            </div>
        `;
        document.getElementById('project_fields').insertAdjacentHTML('beforeend', html);
        projectCount++;
    }

    function addExperienceField() {
        const html = `
            <div class="experience-entry mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Job Title</label>
                        <input type="text" name="experience[${experienceCount}][job_title]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="experience[${experienceCount}][company_name]" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="experience[${experienceCount}][start_date]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Date</label>
                        <input type="date" name="experience[${experienceCount}][end_date]" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="experience[${experienceCount}][description]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="this.parentElement.remove()">Remove</button>
            </div>
        `;
        document.getElementById('experience_fields').insertAdjacentHTML('beforeend', html);
        experienceCount++;
    }

    function addCertificateField() {
        const html = `
            <div class="certificate-entry mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Certificate Name</label>
                        <input type="text" name="certificates[${certificateCount}][certificate_name]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Issued By</label>
                        <input type="text" name="certificates[${certificateCount}][issued_by]" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Issue Date</label>
                        <input type="date" name="certificates[${certificateCount}][issue_date]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Valid Till</label>
                        <input type="date" name="certificates[${certificateCount}][valid_till]" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="certificates[${certificateCount}][description]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="this.parentElement.remove()">Remove</button>
            </div>
        `;
        document.getElementById('certificate_fields').insertAdjacentHTML('beforeend', html);
        certificateCount++;
    }

    function addDocumentField() {
        const html = `
            <div class="document-entry mb-3">
                <div class="row">
                    <div class="col-md-5">
                        <label class="form-label">Document Type</label>
                        <select name="documents[${documentCount}][type]" class="form-control" required>
                            <option value="">Select Document Type</option>
                            <option value="Offer Letter">Offer Letter</option>
                            <option value="ID Proof">ID Proof</option>
                            <option value="Address Proof">Address Proof</option>
                            <option value="Experience Letter">Experience Letter</option>
                            <option value="Salary Slip">Salary Slip</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Document File</label>
                        <input type="file" name="documents[${documentCount}][file]" class="form-control" required>
                        <small class="text-muted">Allowed formats: PDF, DOC, DOCX, JPG, JPEG, PNG (Max size: 2MB)</small>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-danger remove-document" onclick="this.closest('.document-entry').remove()">Remove</button>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('document_fields').insertAdjacentHTML('beforeend', html);
        documentCount++;
    }
    </script>

<?php if (isset($_SESSION['mail_sent'])): ?>
    <div class="alert alert-success">
        Account created and login credentials sent to the applicant's email.
    </div>
    <?php unset($_SESSION['mail_sent']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['mail_error'])): ?>
    <div class="alert alert-warning">
        <?php echo $_SESSION['mail_error']; ?>
    </div>
    <?php unset($_SESSION['mail_error']); ?>
<?php endif; ?>

  </body>
</html>
