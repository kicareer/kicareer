<?php include '../config.php'; 
include 'includes/header.php'; 
?>
 <style>
      td {
      text-align: left;
      /* Ensure text wraps properly */
      word-wrap: break-word; /* For older browsers */
      word-break: break-word; /* Ensures text wraps mid-word if necessary */
      white-space: normal; /* Allows text wrapping */
    }
    </style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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
              <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Home/</span> Manage Employers</h4>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployerModal">Add Employer</button>
            </div>

            <?php
            $db = new DbConnect();
            $connection = $db->connect();
            $sno = 1;

            if ($connection) {
                try {
                    // Fetch employers from `employer_tbl`
                    $query = "SELECT `id`, `name`, `country_code`, `contact_number`, `email`, `company_name`, `company_logo`, `designation`, `status` FROM `employer_tbl` WHERE 1";
                    $stmt = $connection->prepare($query);
                    $stmt->execute();

                    // Fetch all rows
                    $employers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo 'Query Error: ' . $e->getMessage();
                }
            } else {
                echo "Failed to connect to the database!";
            }
            ?>

            <div class="card p-4">
              <h5 class="card-header">List of Employers</h5>
              <div class="table-responsive text-nowrap" style="min-height: 300px;">
                <table class="table table-hover" id="employersTable">
                  <thead>
                    <tr>
                      <th>Sno</th>
                      <th>Employer Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Company</th>
                      <th>Designation</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-1">
                    <?php
                    if (!empty($employers)) {
                        foreach ($employers as $employer) {
                            echo '<tr>';
                            echo '<td>' . $sno++ . '</td>';
                            echo '<td><strong>' . htmlspecialchars($employer['name']) . '</strong></td>';
                            echo '<td>' . htmlspecialchars($employer['email']) . '</td>';
                            echo '<td>' . htmlspecialchars($employer['country_code']) . ' ' . htmlspecialchars($employer['contact_number']) . '</td>';
                            echo '<td>' . htmlspecialchars($employer['company_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($employer['designation']) . '</td>';
                            echo '<td><span class="badge bg-label-' . ($employer['status'] ? 'success' : 'danger') . '">' . ($employer['status'] ? 'Active' : 'Inactive') . '</span></td>';
                            echo '<td>';
                            echo '<div class="dropdown">';
                            echo '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">';
                            echo '<i class="bx bx-dots-vertical-rounded"></i>';
                            echo '</button>';
                            echo '<div class="dropdown-menu" style="z-index: 999;">';
                            // echo '<a class="dropdown-item" href="#view_employer.php?id=' . $employer['id'] . '"><i class="bx bx-show me-1"></i> View</a>';
                            echo '<a class="dropdown-item" href="#edit_employer.php?id=' . $employer['id'] . '"><i class="bx bx-edit-alt me-1"></i> Edit</a>';
                            echo '<a class="dropdown-item" href="#delete_employer.php?id=' . $employer['id'] . '"><i class="bx bx-trash me-1"></i> Delete</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8" class="text-center">No employers found</td></tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Add Employer Modal -->
            <div class="modal fade" id="addEmployerModal" tabindex="-1" aria-labelledby="addEmployerModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addEmployerModalLabel">Add New Employer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="">
                      <div class="mb-3">
                        <label for="employer_name" class="form-label">Employer Name</label>
                        <input type="text" class="form-control" id="employer_name" name="employer_name" required>
                      </div>
                      <div class="mb-3">
                        <label for="employer_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="employer_email" name="employer_email" required>
                      </div>
                      <div class="mb-3">
                        <label for="employer_contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="employer_contact" name="employer_contact" required>
                      </div>
                      <div class="mb-3">
                        <label for="employer_company" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="employer_company" name="employer_company" required>
                      </div>
                      <div class="mb-3">
                        <label for="employer_designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="employer_designation" name="employer_designation">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Employer</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

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
  <script src="./assets/vendor/libs/jquery/jquery.js"></script>
  <script src="./assets/vendor/libs/popper/popper.js"></script>
  <script src="./assets/vendor/js/bootstrap.js"></script>
  <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="./assets/vendor/js/menu.js"></script>
  <script src="./assets/js/main.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#employersTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "responsive": true
      });
    });
  </script>
</body>
</html>
