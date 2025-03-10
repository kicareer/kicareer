<?php include '../config.php'; 
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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home/</span> Manage Candidates</h4>
            
            <?php
            $db = new DbConnect();
            $connection = $db->connect();
            $sno = 1;
            
            if ($connection) {
              try {
                // Fetch employee data
                $query = "SELECT id, name, profile_image, contact_number, country_code, email, work_status, whatsapp, resume, experience, added_date, status FROM emp_tbl order by id desc";
                $stmt = $connection->prepare($query);
                $stmt->execute();
                $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
              } catch (PDOException $e) {
                echo 'Query Error: ' . $e->getMessage();
              }
            } else {
              echo "Failed to connect to the database!";
            }
            ?>

            <div class="card">
              <div class="card-body">
              <h5 class="card-header">List of Candidates</h5>
              <div class="table-responsive text-nowrap" style="min-height: 300px;">
                <table class="table table-hover" id="candidatesTable">
                  <thead>
                    <tr>
                      <th>Sno</th>
                      <!-- <th>Profile Image</th> -->
                      <th>Name</th>
                      <th>Contact</th>
                      <th>Email</th>
                      <!-- <th>Work Status</th> -->
                      <!-- <th>WhatsApp</th> -->
                      <th>Experience</th>
                      <th>Resume</th>
                      <!-- <th>Added Date</th> -->
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (!empty($employees)) {
                      foreach ($employees as $employee) {
                        $statusBadge = $employee['status'] == 'active' ? 'Active' : 'Inactive';
                        $badgeClass = $employee['status'] == 'active' ? 'bg-label-success' : 'bg-label-danger';
                        $profileImage = file_exists('../' . $employee['profile_image']) && !empty($employee['profile_image']) 
                        ? '../' . htmlspecialchars($employee['profile_image']) 
                        : '../uploads/profile/default.png';
                        echo '<tr>';
                        echo '<td>' . $sno++ . '</td>';
                       // echo '<td><img src="' . $profileImage . '" alt="Profile Image" class="rounded-circle" width="40"></td>';
                        echo '<td><strong>' . htmlspecialchars($employee['name']) . '</strong></td>';
                        echo '<td> +' . htmlspecialchars($employee['country_code']) . ' ' . htmlspecialchars($employee['contact_number']) . '</td>';
                        echo '<td>' . htmlspecialchars($employee['email']) . '</td>';
                        // echo '<td>' . htmlspecialchars($employee['work_status']) . '</td>';
                     //   echo '<td>' . ($employee['whatsapp'] ? '<i class="bx bxl-whatsapp text-success"></i> Yes' : 'No') . '</td>';
                        echo '<td>' . ($employee['experience'] > 0 ? htmlspecialchars($employee['experience']) . ' Years' : 'Fresher') . '</td>';
                        echo '<td><a href="../' . htmlspecialchars($employee['resume']) . '" target="_blank"><i class="bx bx-file me-1"></i> View</a></td>';
                       // echo '<td>' . htmlspecialchars($employee['added_date']) . '</td>';
                        echo '<td><span class="badge ' . $badgeClass . '">' . $statusBadge . '</span></td>';
                        echo '<td>';
                        echo '<div class="dropdown">';
                        echo '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">';
                        echo '<i class="bx bx-dots-vertical-rounded"></i>';
                        echo '</button>';
                        echo '<div class="dropdown-menu" style="z-index: 999;">';
                        echo '<a class="dropdown-item" href="#edit_employee.php?id=' . $employee['id'] . '"><i class="bx bx-edit-alt me-1"></i> Edit</a>';
                        echo '<a class="dropdown-item" href="#delete_employee.php?id=' . $employee['id'] . '"><i class="bx bx-trash me-1"></i> Delete</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                      }
                    } else {
                      echo '<tr><td colspan="12" class="text-center">No employees found</td></tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- / Content -->

          
        </div>

        <!-- Content wrapper -->
        <?php include 'includes/footer.php'; ?>
        <div class="content-backdrop fade"></div>
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
      $('#candidatesTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "responsive": true
      });
    });
  </script>
</body>
</html>
