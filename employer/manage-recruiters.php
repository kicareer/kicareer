<?php include '../config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // Adjust path as needed

// Add this at the top after config.php include
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// This will show you where errors are being logged
// echo "Error log location: " . ini_get('error_log');

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Manage Recruiters</title>
  <meta name="description" content="" />
  <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="./assets/css/demo.css" />
  <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <script src="./assets/vendor/js/helpers.js"></script>
  <script src="./assets/js/config.js"></script>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include 'includes/sidebar.php'; ?>
      <div class="layout-page">
        <?php include 'includes/top-bar.php'; ?>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Manage Recruiters</h4>
            <div class="d-flex justify-content-end mb-3">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recruiterModal">Add Recruiter</button>
            </div>

            <?php
            // Pagination and search setup
            $records_per_page = 10;
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($current_page - 1) * $records_per_page;
            $search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
            $sno = $offset + 1;

            $recruiters = [];
            $total_records = 0;

            try {
              // Get the employer_id from the session
              $employer_id = $_SESSION['kenz_employer'];

              // Total record count for pagination
              $count_query = "SELECT COUNT(*) FROM recruiter_tbl WHERE employer_id = :employer_id AND (name LIKE :search OR email LIKE :search)";
              $stmt = $conn->prepare($count_query);
              $search_term_wildcard = '%' . $search_term . '%';
              $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
              $stmt->bindParam(':search', $search_term_wildcard, PDO::PARAM_STR);
              $stmt->execute();
              $total_records = $stmt->fetchColumn();

              // Fetch paginated results with search
              $query = "SELECT * FROM recruiter_tbl WHERE employer_id = :employer_id AND (name LIKE :search OR email LIKE :search) ORDER BY added_date DESC LIMIT :offset, :records_per_page";
              $stmt = $conn->prepare($query);
              $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
              $stmt->bindParam(':search', $search_term_wildcard, PDO::PARAM_STR);
              $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
              $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
              $stmt->execute();
              $recruiters = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
            ?>

            <div class="card">
              <h5 class="card-header">Recruiter List</h5>
              <form method="GET" action="">
                <div class="mb-3 px-4 d-flex align-items-center">
                  <input type="text" name="search" class="form-control me-2" placeholder="Search recruiters..." value="<?php echo htmlspecialchars($search_term); ?>">
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </form>

              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Sno</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact Number</th>
                      <th>Designation</th>
                      <th>Status</th>
                      <th>Added Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($recruiters)): ?>
                      <?php foreach ($recruiters as $recruiter): ?>
                        <tr>
                          <td><?php echo $sno++; ?></td>
                          <td><?php echo htmlspecialchars($recruiter['name']); ?></td>
                          <td><?php echo htmlspecialchars($recruiter['email']); ?></td>
                          <td><?php echo htmlspecialchars($recruiter['contact_number']); ?></td>
                          <td><?php echo htmlspecialchars($recruiter['designation']); ?></td>
                          <td>
                            <span class="badge bg-label-<?php echo $recruiter['status'] == 'active' ? 'success' : 'danger'; ?>">
                              <?php echo ucfirst($recruiter['status']); ?>
                            </span>
                          </td>
                          <td><?php echo date('d M Y', strtotime($recruiter['added_date'])); ?></td>
                          <td>
                            <button type="button" class="btn btn-sm btn-warning assign-client-btn" 
                              data-bs-toggle="modal" 
                              data-bs-target="#assignClientModal<?php echo $recruiter['id']; ?>"
                              data-id="<?php echo $recruiter['id']; ?>"
                              data-name="<?php echo htmlspecialchars($recruiter['name']); ?>"
                            >Assign Client</button>
                            <button type="button" class="btn btn-sm btn-info" 
                              data-bs-toggle="modal" 
                              data-bs-target="#viewClientsModal<?php echo $recruiter['id']; ?>"
                            >View Clients</button>

                            <!-- Assign Client Modal -->
                            <div class="modal fade" id="assignClientModal<?php echo $recruiter['id']; ?>" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Assign Clients to <?php echo htmlspecialchars($recruiter['name']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="" method="POST">
                                      <div class="mb-3">
                                        <label class="form-label">Select Clients</label>
                                        <div class="table-responsive">
                                          <table class="table table-hover">
                                            <thead>
                                              <tr>
                                                <th>
                                                  <input type="checkbox" class="select-all-clients" 
                                                         data-recruiter="<?php echo $recruiter['id']; ?>">
                                                </th>
                                                <th>Name</th>
                                                <th>Company</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php 
                                              $stmt = $conn->prepare("SELECT * FROM clients 
                                                  WHERE id NOT IN (
                                                      SELECT client_id 
                                                      FROM map_clients_recruiter 
                                                      WHERE recruiter_id = :recruiter_id 
                                                      AND employer_id = :employer_id
                                                  ) and employer_id = :employer_id");
                                              $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
                                              $stmt->bindParam(':recruiter_id', $recruiter['id'], PDO::PARAM_INT);
                                              $stmt->execute();
                                              $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                              
                                              foreach ($clients as $client): ?>
                                                  <tr>
                                                      <td>
                                                          <input type="checkbox" name="client_ids[]" 
                                                                 value="<?php echo $client['id']; ?>" 
                                                                 class="client-checkbox-<?php echo $recruiter['id']; ?>">
                                                      </td>
                                                      <td><?php echo htmlspecialchars($client['first_name'] . ' ' . $client['last_name']); ?></td>
                                                      <td><?php echo htmlspecialchars($client['company']); ?></td>
                                                  </tr>
                                              <?php endforeach; ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <input type="hidden" name="recruiter_id" value="<?php echo $recruiter['id']; ?>">
                                        <input type="hidden" name="employer_id" value="<?php echo $_SESSION['kenz_employer']; ?>">
                                        <button type="submit" name="assign_client" class="btn btn-primary">Assign Selected Clients</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- View Clients Modal -->
                            <div class="modal fade" id="viewClientsModal<?php echo $recruiter['id']; ?>" tabindex="-1" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Assigned Clients - <?php echo htmlspecialchars($recruiter['name']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST">
                                      <div class="table-responsive">
                                        <table class="table table-hover">
                                          <thead>
                                            <tr>
                                              <th>
                                                <input type="checkbox" class="select-all-unassign" 
                                                       data-recruiter="<?php echo $recruiter['id']; ?>">
                                              </th>
                                              <th>Name</th>
                                              <th>Company</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php 
                                            $stmt = $conn->prepare("
                                                SELECT c.*, mcr.id as mapping_id 
                                                FROM clients c 
                                                INNER JOIN map_clients_recruiter mcr ON c.id = mcr.client_id 
                                                WHERE mcr.recruiter_id = :recruiter_id 
                                                AND mcr.employer_id = :employer_id
                                            ");
                                            $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
                                            $stmt->bindParam(':recruiter_id', $recruiter['id'], PDO::PARAM_INT);
                                            $stmt->execute();
                                            $assigned_clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            
                                            if (!empty($assigned_clients)):
                                                foreach ($assigned_clients as $client): ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="mapping_ids[]" 
                                                                   value="<?php echo $client['mapping_id']; ?>" 
                                                                   class="unassign-checkbox-<?php echo $recruiter['id']; ?>">
                                                        </td>
                                                        <td><?php echo htmlspecialchars($client['first_name'] . ' ' . $client['last_name']); ?></td>
                                                        <td><?php echo htmlspecialchars($client['company']); ?></td>
                                                    </tr>
                                                <?php endforeach; 
                                            else: ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">No clients assigned</td>
                                                </tr>
                                            <?php endif; ?>
                                          </tbody>
                                        </table>
                                      </div>
                                      <?php if (!empty($assigned_clients)): ?>
                                        <div class="mt-3">
                                          <input type="hidden" name="recruiter_id" value="<?php echo $recruiter['id']; ?>">
                                          <button type="submit" name="unassign_multiple_clients" 
                                                  class="btn btn-danger"
                                                  onclick="return confirm('Are you sure you want to unassign the selected clients?');">
                                              Unassign Selected Clients
                                          </button>
                                        </div>
                                      <?php endif; ?>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-primary edit-recruiter-btn" 
                              data-bs-toggle="modal" 
                              data-bs-target="#editRecruiterModal" 
                              data-id="<?php echo $recruiter['id']; ?>"
                              data-name="<?php echo htmlspecialchars($recruiter['name']); ?>"
                              data-email="<?php echo htmlspecialchars($recruiter['email']); ?>"
                              data-contact="<?php echo htmlspecialchars($recruiter['contact_number']); ?>"
                              data-designation="<?php echo htmlspecialchars($recruiter['designation']); ?>"
                              data-status="<?php echo htmlspecialchars($recruiter['status']); ?>">
                              Edit
                            </button>
                            <a href="delete-recruiter.php?id=<?php echo $recruiter['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this recruiter?');">Delete</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="8" class="text-center">No recruiters found</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <nav class="mt-3">
                <ul class="pagination justify-content-center">
                  <?php
                  $total_pages = ceil($total_records / $records_per_page);
                  for ($i = 1; $i <= $total_pages; $i++) {
                    $active = ($i == $current_page) ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' href='?page=$i&search=" . urlencode($search_term) . "'>$i</a></li>";
                  }
                  ?>
                </ul>
              </nav>
            </div>


            <!-- Add Recruiter Modal -->
            <div class="modal fade" id="recruiterModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add New Recruiter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="POST" action="">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_number" name="contact_number" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="add_recruiter" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Edit Recruiter Modal -->
            <div class="modal fade" id="editRecruiterModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Recruiter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="POST" action="">
                    <div class="modal-body">
                      <input type="hidden" name="id" id="edit-recruiter-id">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="edit-contact" name="contact_number" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="edit-designation" name="designation" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-status" class="form-label">Status</label>
                            <select class="form-select" id="edit-status" name="status" required>
                              <option value="active">Active</option>
                              <option value="inactive">Inactive</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="new_password" class="form-label">New Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="update_recruiter" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <?php

            // Update the assign_client handler
            if(isset($_POST['assign_client'])) {
                try {
                    $client_ids = $_POST['client_ids'] ?? [];
                    $recruiter_id = $_POST['recruiter_id'];
                    $employer_id = $_POST['employer_id'];

                    if (empty($client_ids)) {
                        echo "<script>alert('Please select at least one client!');</script>";
                        echo "<script>window.location.href='manage-recruiters.php';</script>";
                        exit;
                    }

                    $stmt = $conn->prepare("INSERT INTO map_clients_recruiter (client_id, recruiter_id, employer_id) VALUES (:client_id, :recruiter_id, :employer_id)");
                    
                    $success = true;
                    foreach ($client_ids as $client_id) {
                        $stmt->bindParam(':client_id', $client_id);
                        $stmt->bindParam(':recruiter_id', $recruiter_id);
                        $stmt->bindParam(':employer_id', $employer_id);
                        if (!$stmt->execute()) {
                            $success = false;
                            break;
                        }
                    }

                    if ($success) {
                        echo "<script>alert('Clients assigned successfully!');</script>";
                    } else {
                        echo "<script>alert('Error assigning some clients!');</script>";
                    }
                    echo "<script>window.location.href='manage-recruiters.php';</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
                    echo "<script>window.location.href='manage-recruiters.php';</script>";
                }
            }

            // Handle Add Recruiter
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_recruiter"])) {
              try {
                if ($_POST['password'] !== $_POST['confirm_password']) {
                  echo "<script>alert('Passwords do not match!');</script>";
                  exit;
                }

                $name = htmlspecialchars(trim($_POST['name']));
                $email = htmlspecialchars(trim($_POST['email']));
                $contact_number = htmlspecialchars(trim($_POST['contact_number']));
                $designation = htmlspecialchars(trim($_POST['designation']));
                $password = $_POST['password']; // Store original password for email
                $hashed_password = hash('sha256', $password);
                $employer_id = $_SESSION['kenz_employer'];

                $check_email = $conn->prepare("SELECT id FROM recruiter_tbl WHERE email = :email");
                $check_email->bindParam(':email', $email);
                $check_email->execute();

                if ($check_email->rowCount() > 0) {
                  echo "<script>alert('Email already exists!');</script>";
                  exit;
                }

                $query = "INSERT INTO recruiter_tbl (employer_id, name, email, password, contact_number, designation, status) 
                         VALUES (:employer_id, :name, :email, :password, :contact_number, :designation, 'active')";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':employer_id', $employer_id);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':contact_number', $contact_number);
                $stmt->bindParam(':designation', $designation);
                
                if ($stmt->execute()) {

                  
                  
                  
                  // Debug employer data
                  // error_log("Employer data: " . print_r($employer, true));
                  // var_dump($_SESSION);
                  // exit;

                  // Create a new PHPMailer instance
                  $mail = new PHPMailer(true);

                  try {
                    // Enable debug output
                    $mail->SMTPDebug = 2;  // More detailed debug output
                    ob_start(); // Start output buffering to capture debug output
                    
                    // Gmail SMTP server configuration
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'kicareer01@gmail.com';
                    $mail->Password   = 'myen caef fslf jiyw';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    // Additional SMTP options for debugging
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    // Set timeout
                    $mail->Timeout = 60;
                    $mail->SMTPKeepAlive = true;

                    // Recipients
                    $mail->setFrom('kicareer01@gmail.com', 'KI Careers');
                    $mail->addAddress($email, $name);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Your Recruiter Account Has Been Created';
                    $mail->Body    = '
                        <html>
                          <body>
                          <div style="background-color: #F0F0F0; padding:20px; border-radius:4px">
                              <div style="background-color: #fff; border-radius: 10px; padding:20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                  <div style="color:black;">
                                    <span>Hi ' . $name . ',<br><br>
                                    Your recruiter account has been created at ' . $_SESSION['company_name'] . '.<br><br>
                                    Here are your login credentials:<br>
                                    Email: ' . $email . '<br>
                                    Password: ' . $password . '<br><br>
                                    Link: https://ki-careers.com/recruiter-login.php
                                    Please login and change your password for security purposes.<br><br>
                                    <h3>Regards,</h3>
                                    <p>' . $_SESSION['company_name'] . ' Team</p>
                                  </div>
                              </div>
                          </div>
                          </body>
                        </html>';
                    $mail->AltBody = 'Your recruiter account has been created';
                    // var_dump($mail);
                    // exit;
                    // Send the email
                    $result = $mail->send();
                  

                    if($result) {
                        echo "<script>
                            console.log('Email sent successfully');
                            alert('Recruiter added successfully and email notification sent!');
                            window.location.href='manage-recruiters.php';
                        </script>";
                    }
                    else {
                        echo "<script>
                            console.log('Email not sent');
                            alert('Recruiter added successfully but failed to send email notification. Check error logs for details.');
                            // window.location.href='manage-recruiters.php';
                        </script>";
                        // var_dump($mail);
                        // exit;
                    }
                  } catch (Exception $e) {
                    
                    echo "<script>
                        
                        alert('Recruiter added successfully but failed to send email notification. Check error logs for details.');
                        window.location.href='manage-recruiters.php';
                    </script>";
                  }
                }
              } catch (PDOException $e) {
                echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
              }
            }

            // Handle Update Recruiter
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_recruiter"])) {
              try {
                $id = $_POST['id'];
                $name = htmlspecialchars(trim($_POST['name']));
                $email = htmlspecialchars(trim($_POST['email']));
                $contact_number = htmlspecialchars(trim($_POST['contact_number']));
                $designation = htmlspecialchars(trim($_POST['designation']));
                $status = $_POST['status'];
                $employer_id = $_SESSION['kenz_employer'];

                // Check if email exists for other recruiters
                $check_email = $conn->prepare("SELECT id FROM recruiter_tbl WHERE email = :email AND id != :id");
                $check_email->bindParam(':email', $email);
                $check_email->bindParam(':id', $id);
                $check_email->execute();

                if ($check_email->rowCount() > 0) {
                  echo "<script>alert('Email already exists!');</script>";
                  exit;
                }

                $query = "UPDATE recruiter_tbl SET name = :name, email = :email, contact_number = :contact_number, 
                         designation = :designation, status = :status";

                // Add password update if new password is provided
                if (!empty($_POST['new_password'])) {
                  $password = hash('sha256', $_POST['new_password']);
                  $query .= ", password = :password";
                }

                $query .= " WHERE id = :id AND employer_id = :employer_id";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':employer_id', $employer_id);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':contact_number', $contact_number);
                $stmt->bindParam(':designation', $designation);
                $stmt->bindParam(':status', $status);

                if (!empty($_POST['new_password'])) {
                  $stmt->bindParam(':password', $password);
                }
                
                if ($stmt->execute()) {
                  echo "<script>alert('Recruiter updated successfully!'); window.location.href='manage-recruiters.php';</script>";
                }
              } catch (PDOException $e) {
                echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
              }
            }

            // Add this handler for unassigning multiple clients
            if(isset($_POST['unassign_multiple_clients'])) {
                try {
                    $mapping_ids = $_POST['mapping_ids'] ?? [];
                    $recruiter_id = $_POST['recruiter_id'];

                    if (empty($mapping_ids)) {
                        echo "<script>alert('Please select at least one client to unassign!');</script>";
                        echo "<script>window.location.href='manage-recruiters.php';</script>";
                        exit;
                    }

                    $stmt = $conn->prepare("DELETE FROM map_clients_recruiter WHERE id = :mapping_id");
                    
                    $success = true;
                    foreach ($mapping_ids as $mapping_id) {
                        $stmt->bindParam(':mapping_id', $mapping_id);
                        if (!$stmt->execute()) {
                            $success = false;
                            break;
                        }
                    }

                    if ($success) {
                        echo "<script>alert('Selected clients unassigned successfully!');</script>";
                    } else {
                        echo "<script>alert('Error unassigning some clients!');</script>";
                    }
                    echo "<script>window.location.href='manage-recruiters.php';</script>";
                } catch (PDOException $e) {
                    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
                    echo "<script>window.location.href='manage-recruiters.php';</script>";
                }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a id="scrollTop">
    <i class="icon-chevron-up"></i>
    <i class="icon-chevron-up"></i>
  </a>
  <script src="./assets/vendor/libs/jquery/jquery.js"></script>
  <script src="./assets/vendor/libs/popper/popper.js"></script>
  <script src="./assets/vendor/js/bootstrap.js"></script>
  <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="./assets/vendor/js/menu.js"></script>

  <!-- Main JS -->
  <script src="./assets/js/main.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all modals
        var modals = document.querySelectorAll('.modal');
        modals.forEach(function(modal) {
            new bootstrap.Modal(modal);
        });

        // Handle edit recruiter button click
        document.querySelectorAll('.edit-recruiter-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const contact = this.getAttribute('data-contact');
                const designation = this.getAttribute('data-designation');
                const status = this.getAttribute('data-status');

                document.getElementById('edit-recruiter-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-email').value = email;
                document.getElementById('edit-contact').value = contact;
                document.getElementById('edit-designation').value = designation;
                document.getElementById('edit-status').value = status;
            });
        });

        // Handle "Select All" checkboxes
        document.querySelectorAll('.select-all-clients').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const recruiterId = this.getAttribute('data-recruiter');
                const clientCheckboxes = document.querySelectorAll('.client-checkbox-' + recruiterId);
                clientCheckboxes.forEach(function(clientCheckbox) {
                    clientCheckbox.checked = checkbox.checked;
                });
            });
        });

        // Handle "Select All" checkboxes for unassigning
        document.querySelectorAll('.select-all-unassign').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const recruiterId = this.getAttribute('data-recruiter');
                const unassignCheckboxes = document.querySelectorAll('.unassign-checkbox-' + recruiterId);
                unassignCheckboxes.forEach(function(unassignCheckbox) {
                    unassignCheckbox.checked = checkbox.checked;
                });
            });
        });
    });
  </script>
</body>
</html>
