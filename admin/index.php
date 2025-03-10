<?php include '../config.php'; 
// include('../classes/posts.php');
include 'includes/header.php'; 

// Initialize database connection
$db = new DbConnect();
$connection = $db->connect();

// Fetch total employers
$stmt = $connection->prepare("SELECT COUNT(*) as total_employers FROM employer_tbl");
$stmt->execute();
$employer_count = $stmt->fetch(PDO::FETCH_ASSOC)['total_employers'];

// Fetch total employees
$stmt = $connection->prepare("SELECT COUNT(*) as total_employees FROM emp_tbl");
$stmt->execute();
$employee_count = $stmt->fetch(PDO::FETCH_ASSOC)['total_employees'];

// Fetch total applications
$stmt = $connection->prepare("SELECT COUNT(*) as total_applications FROM job_applications");
$stmt->execute();
$application_count = $stmt->fetch(PDO::FETCH_ASSOC)['total_applications'];

// Fetch total active jobs
$stmt = $connection->prepare("SELECT COUNT(*) as total_jobs FROM post WHERE status = 'active'");
$stmt->execute();
$active_jobs = $stmt->fetch(PDO::FETCH_ASSOC)['total_jobs'];

// Fetch recent job posts
$stmt = $connection->prepare("
    SELECT p.*, 
           COALESCE(c.company, e.company_name) as company_name,
           COUNT(ja.id) as application_count
    FROM post p
    LEFT JOIN employer_tbl e ON p.employer_id = e.id
    LEFT JOIN clients c ON p.client_id = c.id
    LEFT JOIN job_applications ja ON p.sno = ja.jobid
    GROUP BY p.sno
    ORDER BY p.created_at DESC
    LIMIT 5
");
$stmt->execute();
$recent_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly application statistics for the current year
$stmt = $connection->prepare("
    SELECT 
        MONTH(apply_date) as month,
        COUNT(*) as application_count
    FROM job_applications
    WHERE YEAR(apply_date) = YEAR(CURRENT_DATE())
    GROUP BY MONTH(apply_date)
    ORDER BY month
");
$stmt->execute();
$monthly_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare monthly data for chart
$months = array_fill(1, 12, 0); // Initialize all months with 0
foreach ($monthly_stats as $stat) {
    $months[$stat['month']] = $stat['application_count'];
}
$monthly_data = array_values($months);

// Fetch application status distribution
$stmt = $connection->prepare("
    SELECT 
        status,
        COUNT(*) as count
    FROM job_applications
    GROUP BY status
");
$stmt->execute();
$status_distribution = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate growth percentages
$stmt = $connection->prepare("
    SELECT 
        COUNT(*) as current_month_count
    FROM job_applications
    WHERE MONTH(apply_date) = MONTH(CURRENT_DATE())
    AND YEAR(apply_date) = YEAR(CURRENT_DATE())
");
$stmt->execute();
$current_month = $stmt->fetch(PDO::FETCH_ASSOC)['current_month_count'];

$stmt = $connection->prepare("
    SELECT 
        COUNT(*) as last_month_count
    FROM job_applications
    WHERE MONTH(apply_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
    AND YEAR(apply_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
");
$stmt->execute();
$last_month = $stmt->fetch(PDO::FETCH_ASSOC)['last_month_count'];

$growth_percentage = $last_month > 0 ? (($current_month - $last_month) / $last_month) * 100 : 0;
?>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
       <?php include 'includes/sidebar.php'; ?>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php include 'includes/navbar.php'; ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Application Statistics 🎉</h5>
                          <p class="mb-4">
                            You have <span class="fw-bold"><?php echo $growth_percentage > 0 ? '+' : ''; ?><?php echo number_format($growth_percentage, 1); ?>%</span> more applications
                            this month compared to last month.
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="./assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="./assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total Employers</span>
                          <h3 class="card-title mb-2"><?php echo $employer_count; ?></h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="./assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span>Total Candidates</span>
                          <h3 class="card-title text-nowrap mb-1"><?php echo $employee_count; ?></h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between">
                            <div>
                              <h4 class="card-title m-0 me-2">Active Jobs</h4>
                              <small class="text-muted">Currently open positions</small>
                            </div>
                            <div class="avatar flex-shrink-0">
                              <img src="./assets/img/icons/unicons/briefcase.png" alt="Active Jobs" class="rounded" />
                            </div>
                          </div>
                          <h3 class="card-title mb-0"><?php echo $active_jobs; ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Application Statistics -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Application Statistics</h5>
                        <div id="totalApplicationsChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                            <div class="dropdown">
                              <button
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="growthReportId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <?php echo date('Y'); ?>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">
                          <?php echo $growth_percentage > 0 ? '+' : ''; ?><?php echo number_format($growth_percentage, 1); ?>% Application Growth
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Status Distribution -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Application Status</h5>
                        <small class="text-muted">Distribution of application statuses</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2"><?php echo $application_count; ?></h2>
                          <span>Total Applications</span>
                        </div>
                        <div id="applicationStatusChart"></div>
                      </div>
                      <ul class="p-0 m-0">
                        <?php foreach ($status_distribution as $status): ?>
                        <li class="d-flex mb-4 pb-1">
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0"><?php echo ucfirst($status['status']); ?></h6>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold"><?php echo $status['count']; ?></small>
                            </div>
                          </div>
                        </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- New Recent Job Posts Section -->
                <div class="col-12 order-5">
                  <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0">Recent Job Posts</h5>
                      <button class="btn btn-primary btn-sm" onclick="window.location.href='manage-jobs.php'">View All</button>
                    </div>
                    <div class="table-responsive text-nowrap">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Location</th>
                            <th>Experience</th>
                            <th>Applications</th>
                            <th>Posted Date</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          <?php foreach ($recent_posts as $post): ?>
                          <tr>
                            <td><strong><?php echo htmlspecialchars($post['job_title']); ?></strong></td>
                            <td><?php echo htmlspecialchars($post['company_name']); ?></td>
                            <td><?php echo htmlspecialchars($post['location']); ?></td>
                            <td>
                              <?php 
                              echo $post['exper_min'] . '-' . $post['exper_max'] . ' years';
                              ?>
                            </td>
                            <td>
                              <span class="badge bg-label-info">
                                <?php echo $post['application_count']; ?> applications
                              </span>
                            </td>
                            <td><?php echo date('d M Y', strtotime($post['created_at'])); ?></td>
                            <td>
                              <span class="badge bg-label-<?php echo $post['status'] === 'active' ? 'success' : 'warning'; ?>">
                                <?php echo ucfirst($post['status']); ?>
                              </span>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php include 'includes/footer.php'; ?>
            <!-- / Footer -->

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
    <script src="./assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="./assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="./assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
    // Application Statistics Chart
    let applicationOptions = {
        series: [{
            name: 'Applications',
            data: <?php echo json_encode($monthly_data); ?>
        }],
        chart: {
            height: 350,
            type: 'line',
            toolbar: { show: false }
        },
        grid: {
            show: false,
            padding: {
                left: 0,
                right: 0
            }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
        yaxis: {
            title: {
                text: 'Number of Applications'
            }
        }
    };

    let applicationChart = new ApexCharts(document.querySelector("#totalApplicationsChart"), applicationOptions);
    applicationChart.render();

    // Growth Chart
    let growthOptions = {
        series: [<?php echo $growth_percentage; ?>],
        chart: {
            height: 200,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                }
            },
        },
        labels: ['Growth'],
    };

    let growthChart = new ApexCharts(document.querySelector("#growthChart"), growthOptions);
    growthChart.render();

    // Application Status Distribution Chart
    let statusData = <?php echo json_encode(array_column($status_distribution, 'count')); ?>;
    let statusLabels = <?php echo json_encode(array_column($status_distribution, 'status')); ?>;

    let statusOptions = {
        series: statusData,
        chart: {
            type: 'donut',
            height: 200
        },
        labels: statusLabels,
        legend: {
            show: false
        }
    };

    let statusChart = new ApexCharts(document.querySelector("#applicationStatusChart"), statusOptions);
    statusChart.render();
    </script>
  </body>
</html>
