<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Manage Clients</title>

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
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include 'includes/sidebar.php'; ?>
      <div class="layout-page">
        <?php include 'includes/top-bar.php'; ?>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Manage Clients</h4>
            <div class="d-flex justify-content-end mb-3">

            <?php if(isset($_SESSION['kenz_recruiter'])){ $disabled='disabled'; }else{ $disabled=''; ?>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clientModal">Add Client</button>
            <?php } ?>
            </div>

            <?php
            // Pagination and search setup
            $records_per_page = 10;
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($current_page - 1) * $records_per_page;
            $search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
            $sno = $offset + 1;

            $clients = [];
            $total_records = 0;
          $employer_id = $_SESSION['employer_id'];
          if (isset($_SESSION['kenz_recruiter'])) {
            try {
              // Fetch paginated results with search
              $query = "SELECT * FROM clients WHERE id in (select client_id from map_clients_recruiter where recruiter_id = :recruiter_id and employer_id=:employer_id) LIMIT :offset, :records_per_page";
              $stmt = $conn->prepare($query);
              $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
              $stmt->bindParam(':recruiter_id', $_SESSION['kenz_recruiter'], PDO::PARAM_INT);
              $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
              $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
              $stmt->execute();
              $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
          } else {
            try {
              // Total record count for pagination
              $count_query = "SELECT COUNT(*) FROM clients WHERE employer_id = :employer_id AND (first_name LIKE :search OR email LIKE :search)";
              $stmt = $conn->prepare($count_query);
              $search_term_wildcard = '%' . $search_term . '%';
              $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
              $stmt->bindParam(':search', $search_term_wildcard, PDO::PARAM_STR);
              $stmt->execute();
              $total_records = $stmt->fetchColumn();

              // Fetch paginated results with search
              $query = "SELECT * FROM clients WHERE employer_id = :employer_id AND (first_name LIKE :search OR email LIKE :search) LIMIT :offset, :records_per_page";
              $stmt = $conn->prepare($query);
              $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
              $stmt->bindParam(':search', $search_term_wildcard, PDO::PARAM_STR);
              $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
              $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
              $stmt->execute();
              $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
          }
            ?>

            <div class="card">
              <h5 class="card-header">Client List</h5>
              <form method="GET" action="">
                <div class="mb-3 px-4 d-flex align-items-center">
                  <input type="text" name="search" class="form-control me-2" placeholder="Search clients..." value="<?php echo htmlspecialchars($search_term); ?>">
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
                      <th>Phone</th>
                      <!-- <th>Country Code</th> -->
                      <th>Company</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($clients)): ?>
                      <?php foreach ($clients as $client): ?>
                        <tr>
                          <td><?php echo $sno++; ?></td>
                          <td><?php echo htmlspecialchars($client['first_name'] . ' ' . $client['last_name']); ?></td>
                          <td><?php echo htmlspecialchars($client['email']); ?></td>
                          <td>+<?php echo htmlspecialchars($client['country_code']); ?>-<?php echo htmlspecialchars($client['phone']); ?></td>
                          <!-- <td></td> -->
                          <td><?php echo htmlspecialchars($client['company']); ?></td>
                          <td><?php echo htmlspecialchars($client['address']); ?></td>
                          <td>
                            <span class="badge bg-label-<?php echo $client['status'] == '1' ? 'success' : 'danger'; ?>">
                              <?php echo ucfirst($client['status']) ? 'Active' : 'Inactive'; ?>
                            </span>
                          </td>
                          <td>
                          <button  <?= $disabled ?>
        type="button" 
        class="btn btn-sm btn-primary edit-client-btn" 
        data-bs-toggle="modal" 
        data-bs-target="#editClientModal" 
        data-id="<?php echo $client['id']; ?>" 
        data-first_name="<?php echo htmlspecialchars($client['first_name']); ?>" 
        data-last_name="<?php echo htmlspecialchars($client['last_name']); ?>" 
        data-email="<?php echo htmlspecialchars($client['email']); ?>" 
        data-country_code="<?php echo htmlspecialchars($client['country_code']); ?>" 
        data-phone="<?php echo htmlspecialchars($client['phone']); ?>" 
        data-company="<?php echo htmlspecialchars($client['company']); ?>" 
        data-address="<?php echo htmlspecialchars($client['address']); ?>" 
        data-status="<?php echo htmlspecialchars($client['status']); ?>">
        Edit
    </button>
    <?php if($disabled ){}else{?>
                            <a href="delete-client.php?id=<?php echo $client['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this client?');">Delete</a>
                          <?php } ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="9" class="text-center">No clients found</td>
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

            <!-- Add Client Modal -->
            <div class="modal fade" id="clientModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add New Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="POST" action="">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                          </div>


                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                          </div>

                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="tel" class="form-control" id="company" name="company" required>
                          </div>
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="country_code" class="form-label">Country Code</label>
                            <select class="form-select" id="country_code" name="country_code" required>
                              <option value="">Select country</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label for="address" class="form-label">Company Address</label>
                            <textarea name="address" class="form-control" id="address" placeholder="Company Address"></textarea>
                          </div>
                        </div>


                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="add_client" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Edit Client Modal -->
            <div class="modal fade" id="editClientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-client-id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-first-name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="edit-first-name" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-last-name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="edit-last-name" name="last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit-email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="edit-company" name="company" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-country-code" class="form-label">Country Code</label>
                                <select class="form-select" id="edit-country-code" name="country_code" required>
                                    <option value="">Select country</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="edit-phone" name="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-address" class="form-label">Company Address</label>
                                <textarea name="address" class="form-control" id="edit-address" placeholder="Company Address"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_client" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

            <script>
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
                      const select = document.getElementById('country_code');
                      current_country = country;
                      // console.log(current_country);
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


                fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
                .then(response => response.json())
                .then(countries => {
                  const countrySelect = document.getElementById('edit-country-code');
                  countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.phonecode; // Use phone code as value
                    option.setAttribute('data-countryCode', country.iso2); // Set ISO code as data attribute
                    option.textContent = `${country.name} (+${country.phonecode})`; // Display country name with phone code
                    countrySelect.appendChild(option);
                  });
                })
            </script>
            <div class="layout-overlay layout-menu-toggle"></div>
          </div>
        </div>
        <?php include 'includes/footer.php'; ?>
      </div>
    </div>
  </div>
 
<?php include 'includes/scripts.php'; ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-client-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Populate modal fields with client data
            document.getElementById('edit-client-id').value = this.getAttribute('data-id');
            document.getElementById('edit-first-name').value = this.getAttribute('data-first_name');
            document.getElementById('edit-last-name').value = this.getAttribute('data-last_name');
            document.getElementById('edit-email').value = this.getAttribute('data-email');
            document.getElementById('edit-country-code').value = this.getAttribute('data-country_code');
            document.getElementById('edit-phone').value = this.getAttribute('data-phone');
            document.getElementById('edit-company').value = this.getAttribute('data-company');
            document.getElementById('edit-address').value = this.getAttribute('data-address');
            document.getElementById('status').value = this.getAttribute('data-status');
        });
    });
});

</script>

</body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_client"])) {
  // Collect form data
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $country_code = $_POST['country_code'];
  $phone = $_POST['phone'];
  $company = $_POST['company'];
  $address = $_POST['address'];
  // $status = $_POST['status'];

  // Insert query using prepared statements
  $sql = "INSERT INTO clients (first_name, last_name, email, country_code, phone,employer_id, company, address, created_at, updated_at) 
            VALUES (:first_name, :last_name, :email, :country_code, :phone, :employer_id, :company, :address, NOW(), NOW())";

  try {
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ':first_name' => $first_name,
      ':last_name' => $last_name,
      ':email' => $email,
      ':country_code' => $country_code,
      ':phone' => $phone,
      ':employer_id' => $employer_id,
      ':company' => $company,
      ':address' => $address,
    ]);

    // Success message or redirection
    echo "<script>alert('Client added successfully!'); window.location.href='manage-clients.php';</script>";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_client"])) {
  // var_dump($_POST);
  // exit;
  $id = $_POST['id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $country_code = $_POST['country_code'];
  $phone = $_POST['phone'];
  $company = $_POST['company'];
  $address = $_POST['address'];
  $status = $_POST['status'];

  $sql = "UPDATE clients 
          SET first_name = ?, last_name = ?, email = ?, country_code = ?, phone = ?, company = ?, address = ?, status = ?, updated_at = NOW()
          WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$first_name, $last_name, $email, $country_code, $phone, $company, $address, $status, $id]);

  // Redirect with success message
  echo "<script>window.location.href='manage-clients.php';</script>";
}

if(isset($_GET['message'])){
  $message = $_GET['message'];
  echo "<script>alert('$message'); window.location.href='manage-clients.php';</script>";
  
}
?>

</html>