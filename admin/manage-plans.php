<?php include '../config.php'; 
include 'includes/header.php'; 
?>

<head>
  <!-- Add this in the head section after the existing CSS links -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
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
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home/</span> Manage Plans</h4>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPlanModal">
                Add Plan
              </button>
            </div>
            <!-- add plan modal -->
            <!-- Modal -->
            <div class="modal fade" id="addPlanModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add New Plan</h5>
                    <button
                      type="button" 
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <form action="" method="POST">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col mb-3">
                          <label for="planName" class="form-label">Plan Name</label>
                          <input
                            type="text"
                            id="planName"
                            name="plan_name" 
                            class="form-control"
                            placeholder="Enter Plan Name"
                            required
                          />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="price" class="form-label">Base Price (₹)</label>
                          <input
                            type="number"
                            id="price"
                            name="price"
                            class="form-control"
                            placeholder="Enter Base Price"
                            required
                          />
                          <small class="text-muted">Base price includes one recruiter</small>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="duration" class="form-label">Duration (Days)</label>
                          <input
                            type="number"
                            id="duration"
                            name="duration"
                            class="form-control"
                            placeholder="Enter Duration in Days"
                            required
                          />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="num_recruiter" class="form-label">Included Recruiters</label>
                          <input
                            type="number"
                            id="num_recruiter"
                            name="num_recruiter"
                            class="form-control"
                            value="1"
                            min="1"
                            required
                          />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="charge_per_recruiter" class="form-label">Additional Recruiter Charge (₹)</label>
                          <input
                            type="number"
                            id="charge_per_recruiter"
                            name="charge_per_recruiter"
                            class="form-control"
                            required
                          />
                          <small class="text-muted">Charge per additional recruiter beyond included recruiters</small>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                      </button>
                      <button type="submit" name="add_plan" class="btn btn-primary">Add Plan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Edit Plan Modal -->
            <div class="modal fade" id="editPlanModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Plan</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <form id="editPlanForm">
                    <div class="modal-body">
                      <input type="hidden" id="edit_plan_id" name="plan_id">
                      <div class="row">
                        <div class="col mb-3">
                          <label for="edit_plan_name" class="form-label">Plan Name</label>
                          <input
                            type="text"
                            id="edit_plan_name"
                            name="plan_name"
                            class="form-control"
                            placeholder="Enter Plan Name"
                            required
                          />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="edit_price" class="form-label">Base Price (₹)</label>
                          <input
                            type="number"
                            id="edit_price"
                            name="price"
                            class="form-control"
                            placeholder="Enter Base Price"
                            required
                          />
                          <small class="text-muted">Base price includes one recruiter</small>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="edit_duration" class="form-label">Duration (Days)</label>
                          <input
                            type="number"
                            id="edit_duration"
                            name="duration"
                            class="form-control"
                            placeholder="Enter Duration in Days"
                            required
                          />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="edit_num_recruiter" class="form-label">Included Recruiters</label>
                          <input
                            type="number"
                            id="edit_num_recruiter"
                            name="num_recruiter"
                            class="form-control"
                            min="1"
                            required
                          />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col mb-3">
                          <label for="edit_charge_per_recruiter" class="form-label">Additional Recruiter Charge (₹)</label>
                          <input
                            type="number"
                            id="edit_charge_per_recruiter"
                            name="charge_per_recruiter"
                            class="form-control"
                            required
                          />
                          <small class="text-muted">Charge per additional recruiter beyond included recruiters</small>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                      </button>
                      <button type="submit" class="btn btn-primary">Update Plan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php
            $db = new DbConnect();
            $connection = $db->connect();
            $sno = 1;
            
            if ($connection) {
              try {
                // Fetch plans data
                $query = "SELECT id, plan_name, price, duration, created_at, num_recruiter, charge_per_recruiter FROM plans ORDER BY created_at DESC";
                $stmt = $connection->prepare($query);
                $stmt->execute();
                $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);
              } catch (PDOException $e) {
                echo 'Query Error: ' . $e->getMessage();
              }
            } else {
              echo "Failed to connect to the database!";
            }
            ?>

            <div class="card">
              <h5 class="card-header">List of Plans</h5>
              <div class="card-body p-4">
                <div class="table-responsive text-nowrap">
                  <table id="plansTable" class="table table-hover dt-responsive nowrap w-100">
                    <thead>
                      <tr>
                        <th>SNo</th>
                        <th>Plan Name</th>
                        <th>Base Price</th>
                        <th>Duration (Days)</th>
                        <th>Included Recruiters</th>
                        <th>Additional Recruiter Charge</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!empty($plans)) {
                        foreach ($plans as $plan) {
                          echo '<tr>';
                          echo '<td>' . $sno++ . '</td>';
                          echo '<td>' . htmlspecialchars($plan['plan_name']) . '</td>';
                          echo '<td>₹' . number_format($plan['price']) . '</td>';
                          echo '<td>' . htmlspecialchars($plan['duration']) . ' days</td>';
                          echo '<td>' . htmlspecialchars($plan['num_recruiter']) . '</td>';
                          echo '<td>₹' . number_format($plan['charge_per_recruiter']) . '</td>';
                          echo '<td>' . htmlspecialchars(date('d M Y', strtotime($plan['created_at']))) . '</td>';
                          echo '<td>';
                          echo '<div class="dropdown">';
                          echo '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">';
                          echo '<i class="bx bx-dots-vertical-rounded"></i>';
                          echo '</button>';
                          echo '<div class="dropdown-menu">';
                          echo '<a class="dropdown-item edit-plan" href="#" data-bs-toggle="modal" data-bs-target="#editPlanModal" 
                              data-id="' . $plan['id'] . '"
                              data-name="' . htmlspecialchars($plan['plan_name']) . '"
                              data-price="' . htmlspecialchars($plan['price']) . '"
                              data-duration="' . htmlspecialchars($plan['duration']) . '"
                              data-recruiters="' . htmlspecialchars($plan['num_recruiter']) . '"
                              data-charge="' . htmlspecialchars($plan['charge_per_recruiter']) . '">
                              <i class="bx bx-edit-alt me-1"></i> Edit</a>';
                          echo '<a class="dropdown-item" href="#delete_plan.php?id=' . $plan['id'] . '"><i class="bx bx-trash me-1"></i> Delete</a>';
                          echo '</div>';
                          echo '</div>';
                          echo '</td>';
                          echo '</tr>';
                        }
                      } else {
                        echo '<tr><td colspan="6" class="text-center">No plans found</td></tr>';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- / Content -->
          <?php
          if(isset($_POST['add_plan'])) {
              $plan_name = htmlspecialchars(trim($_POST['plan_name']));
              $price = floatval($_POST['price']);
              $duration = intval($_POST['duration']);
              $num_recruiter = intval($_POST['num_recruiter']);
              $charge_per_recruiter = floatval($_POST['charge_per_recruiter']);
              
              try {
                  $query = "INSERT INTO plans (plan_name, price, duration, created_at, num_recruiter, charge_per_recruiter) 
                           VALUES (:plan_name, :price, :duration, NOW(), :num_recruiter, :charge_per_recruiter)";
                  $stmt = $connection->prepare($query);
                  $stmt->bindParam(':plan_name', $plan_name);
                  $stmt->bindParam(':price', $price);
                  $stmt->bindParam(':duration', $duration);
                  $stmt->bindParam(':num_recruiter', $num_recruiter);
                  $stmt->bindParam(':charge_per_recruiter', $charge_per_recruiter);
                  
                  if($stmt->execute()) {
                      echo "<script>
                              alert('Plan added successfully!');
                              window.location.href='manage-plans.php';
                          </script>";
                  } else {
                      echo "<script>alert('Failed to add plan!');</script>";
                  }
              } catch(PDOException $e) {
                  echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
              }
          }
          if(isset($_POST['update_plan'])) {
              $plan_id = intval($_POST['plan_id']);
              $plan_name = htmlspecialchars(trim($_POST['plan_name'])); 
              $price = floatval($_POST['price']);
              $duration = intval($_POST['duration']);
              $num_recruiter = intval($_POST['num_recruiter']);
              $charge_per_recruiter = floatval($_POST['charge_per_recruiter']);
              
              try {
                  $query = "UPDATE plans 
                           SET plan_name = :plan_name,
                               price = :price, 
                               duration = :duration,
                               num_recruiter = :num_recruiter,
                               charge_per_recruiter = :charge_per_recruiter,
                               updated_at = NOW()
                           WHERE id = :plan_id";
                           
                  $stmt = $connection->prepare($query);
                  $stmt->bindParam(':plan_id', $plan_id);
                  $stmt->bindParam(':plan_name', $plan_name);
                  $stmt->bindParam(':price', $price);
                  $stmt->bindParam(':duration', $duration);
                  $stmt->bindParam(':num_recruiter', $num_recruiter);
                  $stmt->bindParam(':charge_per_recruiter', $charge_per_recruiter);
                  
                  if($stmt->execute()) {
                      echo "<script>
                              alert('Plan updated successfully!');
                              window.location.href='manage-plans.php';
                          </script>";
                  } else {
                      echo "<script>alert('Failed to update plan!');</script>";
                  }
              } catch(PDOException $e) {
                  echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
              }
          }
          ?>

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
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
  <script>
  $(document).ready(function() {
      // Initialize DataTable
      var table = $('#plansTable').DataTable({
          responsive: true,
          dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
               '<"row"<"col-sm-12"tr>>' +
               '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          columns: [
              { data: 'sno' },
              { data: 'plan_name' },
              { data: 'price' },
              { data: 'duration' },
              { data: 'num_recruiter' },
              { data: 'charge_per_recruiter' },
              { data: 'created_at' },
              { data: 'actions', orderable: false, searchable: false }
          ],
          order: [[0, 'asc']],
          language: {
              search: "Search:",
              lengthMenu: "Show _MENU_ entries",
              info: "Showing _START_ to _END_ of _TOTAL_ entries",
              infoEmpty: "Showing 0 to 0 of 0 entries",
              infoFiltered: "(filtered from _MAX_ total entries)",
              paginate: {
                  first: "First",
                  last: "Last",
                  next: "Next",
                  previous: "Previous"
              }
          }
      });
      
      // Handle edit button click
      $('.edit-plan').click(function() {
          const plan = $(this).data();
          $('#edit_plan_id').val(plan.id);
          $('#edit_plan_name').val(plan.name);
          $('#edit_price').val(plan.price);
          $('#edit_duration').val(plan.duration);
          $('#edit_num_recruiter').val(plan.recruiters);
          $('#edit_charge_per_recruiter').val(plan.charge);
      });

      // Handle edit form submission
      $('#editPlanForm').on('submit', function(e) {
          e.preventDefault();
          
          $.ajax({
              url: 'process_plan.php',
              type: 'POST',
              data: {
                  action: 'edit',
                  plan_id: $('#edit_plan_id').val(),
                  plan_name: $('#edit_plan_name').val(),
                  price: $('#edit_price').val(),
                  duration: $('#edit_duration').val(),
                  num_recruiter: $('#edit_num_recruiter').val(),
                  charge_per_recruiter: $('#edit_charge_per_recruiter').val()
              },
              success: function(response) {
                  try {
                      const result = JSON.parse(response);
                      if(result.success) {
                          alert('Plan updated successfully!');
                          location.reload();
                      } else {
                          alert(result.message || 'Error updating plan');
                      }
                  } catch(e) {
                      alert('Error processing response');
                  }
              },
              error: function() {
                  alert('Error updating plan');
              }
          });
      });
  });
  </script>
</body>
</html>
