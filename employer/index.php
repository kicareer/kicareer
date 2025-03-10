<?php 
include('../config.php'); 
// var_dump($_SESSION);
// exit;
// Check if user is logged in
if (!isset($_SESSION['kenz_employer']) && !isset($_SESSION['kenz_recruiter'])) {
    header("Location: ../employer-login.php");
    exit();
}

// Initialize database connection
$db = new DbConnect();
$connection = $db->connect();
// var_dump($_SESSION);
// exit;
// Check subscription status
function checkSubscriptionStatus($employer_id, $connection) {
    $stmt = $connection->prepare("
        SELECT s.*, p.plan_name, p.duration 
        FROM subscriptions s
        LEFT JOIN plans p ON s.plan_id = p.id
        WHERE s.employer_id = :employer_id 
        AND s.status = 'active'
        AND (s.end_date >= CURRENT_DATE OR s.end_date IS NULL)
        ORDER BY s.id DESC 
        LIMIT 1
    ");
    $stmt->bindParam(':employer_id', $employer_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Check trial eligibility
function checkTrialEligibility($employer_id, $connection) {
    $stmt = $connection->prepare("
        SELECT COUNT(*) as trial_count 
        FROM subscriptions 
        WHERE employer_id = :employer_id 
        AND plan_id IS NULL
    ");
    $stmt->bindParam(':employer_id', $employer_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['trial_count'] == 0;
}

$subscription = checkSubscriptionStatus($_SESSION['employer_id'], $connection);
$show_subscription_modal = false;
$trial_eligible = false;
$_SESSION['is_subscribed'] = $subscription !== false;
// If no active subscription, check for trial eligibility   
if (!$subscription) {
    $trial_eligible = checkTrialEligibility($_SESSION['employer_id'], $connection);
    $show_subscription_modal = true;
}


// Get employer_id from session
$employer_id = isset($_SESSION['employer_id']) ? $_SESSION['employer_id'] : 0;

// Fetch total job posts by this employer
$stmt = $connection->prepare("
    SELECT COUNT(*) as total_posts 
    FROM post 
    WHERE employer_id = :employer_id
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$total_posts = $stmt->fetch(PDO::FETCH_ASSOC)['total_posts'];

// Fetch active job posts
$stmt = $connection->prepare("
    SELECT COUNT(*) as active_posts 
    FROM post 
    WHERE employer_id = :employer_id 
    AND status = 'active'
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$active_posts = $stmt->fetch(PDO::FETCH_ASSOC)['active_posts'];

// Fetch total applications received
$stmt = $connection->prepare("
    SELECT COUNT(*) as total_applications 
    FROM job_applications ja
    JOIN post p ON ja.jobid = p.sno
    WHERE p.employer_id = :employer_id
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$total_applications = $stmt->fetch(PDO::FETCH_ASSOC)['total_applications'];

// Fetch monthly application statistics
$stmt = $connection->prepare("
    SELECT 
        MONTH(ja.apply_date) as month,
        COUNT(*) as application_count
    FROM job_applications ja
    JOIN post p ON ja.jobid = p.sno
    WHERE p.employer_id = :employer_id
    AND YEAR(ja.apply_date) = YEAR(CURRENT_DATE())
    GROUP BY MONTH(ja.apply_date)
    ORDER BY month
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$monthly_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare monthly data for chart
$months = array_fill(1, 12, 0); // Initialize all months with 0
foreach ($monthly_stats as $stat) {
    $months[$stat['month']] = $stat['application_count'];
}
$monthly_data = array_values($months);

// Calculate growth percentage
$stmt = $connection->prepare("
    SELECT 
        COUNT(*) as current_month
    FROM job_applications ja
    JOIN post p ON ja.jobid = p.sno
    WHERE p.employer_id = :employer_id
    AND MONTH(ja.apply_date) = MONTH(CURRENT_DATE())
    AND YEAR(ja.apply_date) = YEAR(CURRENT_DATE())
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$current_month = $stmt->fetch(PDO::FETCH_ASSOC)['current_month'];

$stmt = $connection->prepare("
    SELECT 
        COUNT(*) as last_month
    FROM job_applications ja
    JOIN post p ON ja.jobid = p.sno
    WHERE p.employer_id = :employer_id
    AND MONTH(ja.apply_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
    AND YEAR(ja.apply_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$last_month = $stmt->fetch(PDO::FETCH_ASSOC)['last_month'];

$growth_percentage = $last_month > 0 ? (($current_month - $last_month) / $last_month) * 100 : 0;

// Fetch recent applications
$stmt = $connection->prepare("
    SELECT 
        ja.*,
        p.job_title,
        e.name as candidate_name,
        e.email as candidate_email,
        e.contact_number as candidate_phone
    FROM job_applications ja
    JOIN post p ON ja.jobid = p.sno
    JOIN emp_tbl e ON ja.applied_id = e.id
    WHERE p.employer_id = :employer_id
    ORDER BY ja.apply_date DESC
    LIMIT 5
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$recent_applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch total revenue from client budgets
$stmt = $connection->prepare("
    SELECT COALESCE(SUM(CAST(REPLACE(REPLACE(salary_max, ',', ''), 'K', '000') AS DECIMAL(10,2))), 0) as total_budget
    FROM post 
    WHERE employer_id = :employer_id 
    AND status = 'active'
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$total_revenue = $stmt->fetch(PDO::FETCH_ASSOC)['total_budget'];

// Fetch application statistics by status
$stmt = $connection->prepare("
    SELECT 
        ja.status,
        COUNT(*) as count
    FROM job_applications ja
    JOIN post p ON ja.jobid = p.sno
    WHERE p.employer_id = :employer_id
    GROUP BY ja.status
");
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$application_stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$status_counts = array(
    'pending' => 0,
    'selected' => 0,
    'rejected' => 0,
    'shortlisted' => 0
);

foreach ($application_stats as $stat) {
    $status_counts[$stat['status']] = $stat['count'];
}

// Calculate selection rate
$total_processed = $status_counts['selected'] + $status_counts['rejected'];
$selection_rate = $total_processed > 0 ? 
    round(($status_counts['selected'] / $total_processed) * 100, 1) : 0;
?>
<?php include 'includes/header.php'; ?>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include 'includes/sidebar.php'; ?>

            <div class="layout-page">
                <?php include 'includes/top-bar.php'; ?>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Welcome Card -->
                        <div class="row">
                            <div class="col-lg-8 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Welcome <?= $_SESSION['name']; ?> 🎉</h5>
                                                <p class="mb-4">
                                                    You have <span class="fw-bold"><?php echo $total_applications; ?></span> total applications
                                                    and <span class="fw-bold"><?php echo $active_posts; ?></span> active job posts.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src="./assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Growth Card -->
                            <div class="col-lg-4 col-md-4 order-1">
                                <div class="card">
                                    <div class="card-body px-0">
                                        <div class="card-title d-flex align-items-start justify-content-between px-3">
                                            <div>
                                                <h5 class="mb-0">Growth Rate</h5>
                                                <small class="text-muted">Monthly Applications</small>
                                            </div>
                                        </div>
                                        <div id="growthChart"></div>
                                        <div class="text-center fw-semibold pt-3 mb-2">
                                            <?php echo $growth_percentage >= 0 ? '+' : ''; ?><?php echo number_format($growth_percentage, 1); ?>% Growth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics Cards Row -->
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Total Jobs</span>
                                        <h3 class="card-title mb-2"><?php echo $total_posts; ?></h3>
                                        <small class="text-success fw-semibold">
                                            <i class="bx bx-up-arrow-alt"></i> Active: <?php echo $active_posts; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/wallet-info.png" alt="Applications" class="rounded" />
                                            </div>
                                        </div>
                                        <span>Total Applications</span>
                                        <h3 class="card-title text-nowrap mb-1"><?php echo $total_applications; ?></h3>
                                        <small class="text-<?php echo $growth_percentage >= 0 ? 'success' : 'danger'; ?> fw-semibold">
                                            <i class="bx bx-<?php echo $growth_percentage >= 0 ? 'up' : 'down'; ?>-arrow-alt"></i>
                                            Monthly Growth: <?php echo number_format(abs($growth_percentage), 1); ?>%
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/cc-warning.png" alt="Pending" class="rounded" />
                                            </div>
                                        </div>
                                        <span>Pending Applications</span>
                                        <h3 class="card-title text-nowrap mb-1"><?php 
                                            $pending = array_filter($recent_applications, function($app) {
                                                return $app['status'] == 'pending';
                                            });
                                            echo count($pending);
                                        ?></h3>
                                        <small class="text-warning fw-semibold">
                                            <i class="bx bx-time"></i> Needs Review
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="./assets/img/icons/unicons/cc-success.png" alt="Approved" class="rounded" />
                                            </div>
                                        </div>
                                        <span>Approved Applications</span>
                                        <h3 class="card-title text-nowrap mb-1"><?php 
                                            $approved = array_filter($recent_applications, function($app) {
                                                return $app['status'] == 'approved';
                                            });
                                            echo count($approved);
                                        ?></h3>
                                        <small class="text-success fw-semibold">
                                            <i class="bx bx-check"></i> Processed
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="card-info">
                                                <p class="card-text">Total Revenue Potential</p>
                                                <div class="d-flex align-items-end mb-2">
                                                    <h4 class="card-title mb-0">₹<?= number_format($total_revenue/1000, 1) ?>K</h4>
                                                </div>
                                                <small>Based on maximum budget</small>
                                            </div>
                                            <div class="card-icon">
                                                <span class="badge bg-label-success rounded p-2">
                                                    <i class="bx bx-money bx-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="card-info">
                                                <p class="card-text">Selection Rate</p>
                                                <div class="d-flex align-items-end mb-2">
                                                    <h4 class="card-title mb-0"><?= $selection_rate ?>%</h4>
                                                </div>
                                                <small>Of processed applications</small>
                                            </div>
                                            <div class="card-icon">
                                                <span class="badge bg-label-primary rounded p-2">
                                                    <i class="bx bx-check-circle bx-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Application Status Statistics -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">Application Status Overview</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-6 mb-4">
                                                <div class="card shadow-none bg-label-warning h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="avatar">
                                                                <span class="avatar-initial rounded bg-label-warning">
                                                                    <i class="bx bx-time"></i>
                                                                </span>
                                                            </div>
                                                            <h6 class="mb-0 ms-2">Pending</h6>
                                                        </div>
                                                        <h4 class="mb-1"><?= $status_counts['pending'] ?></h4>
                                                        <small>Applications</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-6 mb-4">
                                                <div class="card shadow-none bg-label-success h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="avatar">
                                                                <span class="avatar-initial rounded bg-label-success">
                                                                    <i class="bx bx-check-circle"></i>
                                                                </span>
                                                            </div>
                                                            <h6 class="mb-0 ms-2">Selected</h6>
                                                        </div>
                                                        <h4 class="mb-1"><?= $status_counts['selected'] ?></h4>
                                                        <small>Candidates</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-6 mb-4">
                                                <div class="card shadow-none bg-label-danger h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="avatar">
                                                                <span class="avatar-initial rounded bg-label-danger">
                                                                    <i class="bx bx-x-circle"></i>
                                                                </span>
                                                            </div>
                                                            <h6 class="mb-0 ms-2">Rejected</h6>
                                                        </div>
                                                        <h4 class="mb-1"><?= $status_counts['rejected'] ?></h4>
                                                        <small>Applications</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-6 mb-4">
                                                <div class="card shadow-none bg-label-info h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="avatar">
                                                                <span class="avatar-initial rounded bg-label-info">
                                                                    <i class="bx bx-list-check"></i>
                                                                </span>
                                                            </div>
                                                            <h6 class="mb-0 ms-2">Shortlisted</h6>
                                                        </div>
                                                        <h4 class="mb-1"><?= $status_counts['shortlisted'] ?></h4>
                                                        <small>Candidates</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Row -->
                        <div class="row">
                            <!-- Application Statistics Chart -->
                            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="m-0 me-2">Application Statistics</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button">
                                                <?php echo date('Y'); ?>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="applicationChart"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Activity -->
                            <div class="col-12 col-lg-4 order-3">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title m-0 me-2">Recent Activity</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="p-0 m-0">
                                            <?php foreach (array_slice($recent_applications, 0, 3) as $app): ?>
                                            <li class="d-flex mb-4 pb-1 px-4">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-<?php 
                                                        echo $app['status'] == 'pending' ? 'warning' : 
                                                            ($app['status'] == 'approved' ? 'success' : 'danger'); 
                                                    ?>">
                                                        <i class="bx bx-user"></i>
                                                    </span>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0"><?php echo htmlspecialchars($app['candidate_name']); ?></h6>
                                                        <small class="text-muted">Applied for <?php echo htmlspecialchars($app['job_title']); ?></small>
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold"><?php echo date('M d', strtotime($app['apply_date'])); ?></small>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Applications Table -->
                        <div class="row">
                            <div class="col-12 order-3">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Recent Applications</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary">
                                                View All
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Candidate</th>
                                                    <th>Job Title</th>
                                                    <th>Applied Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php foreach ($recent_applications as $app): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-sm me-3">
                                                                <span class="avatar-initial rounded-circle bg-label-<?php 
                                                                    echo $app['status'] == 'pending' ? 'warning' : 
                                                                        ($app['status'] == 'approved' ? 'success' : 'danger'); 
                                                                ?>">
                                                                    <?php echo strtoupper(substr($app['candidate_name'], 0, 1)); ?>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <strong><?php echo htmlspecialchars($app['candidate_name']); ?></strong>
                                                                <br>
                                                                <small class="text-muted"><?php echo htmlspecialchars($app['candidate_email']); ?></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($app['job_title']); ?></td>
                                                    <td><?php echo date('d M Y', strtotime($app['apply_date'])); ?></td>
                                                    <td>
                                                        <span class="badge bg-label-<?php 
                                                            echo $app['status'] == 'pending' ? 'warning' : 
                                                                ($app['status'] == 'approved' ? 'success' : 'danger'); 
                                                        ?>">
                                                            <?php echo ucfirst($app['status']); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="manage-job-application.php?id=<?php echo $app['id']; ?>">
                                                                    <i class="bx bx-show-alt me-1"></i> View
                                                                </a>
                                                                <?php if($app['status'] == 'pending'): ?>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i class="bx bx-check me-1"></i> Approve
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i class="bx bx-x me-1"></i> Reject
                                                                </a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
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

                    <?php include 'includes/footer.php'; ?>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <?php include 'includes/scripts.php'; ?>

    <script>
    // Application Statistics Chart
    let applicationOptions = {
        series: [{
            name: 'Applications',
            data: <?php echo json_encode($monthly_data); ?>
        }],
        chart: {
            height: 350,
            type: 'area',
            toolbar: { show: false }
        },
        grid: {
            show: true,
            padding: {
                left: 0,
                right: 0
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
        yaxis: {
            title: {
                text: 'Applications'
            }
        },
        tooltip: {
            x: {
                format: 'MM'
            }
        }
    };

    let applicationChart = new ApexCharts(document.querySelector("#applicationChart"), applicationOptions);
    applicationChart.render();

    // Growth Chart
    let growthOptions = {
        series: [<?php echo number_format($growth_percentage, 1); ?>],
        chart: {
            height: 200,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                hollow: {
                    size: '70%',
                },
                track: {
                    background: "#e7e7e7",
                    strokeWidth: '97%',
                    margin: 5,
                },
                dataLabels: {
                    show: true,
                    name: {
                        show: true,
                        fontSize: '16px',
                        fontFamily: undefined,
                        color: '#697a8d',
                        offsetY: 120
                    },
                    value: {
                        offsetY: 76,
                        fontSize: '22px',
                        fontWeight: 500,
                        formatter: function (val) {
                            return val + '%';
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        labels: ['Growth'],
        colors: ['<?php echo $growth_percentage >= 0 ? '#28c76f' : '#ea5455'; ?>']
    };

    let growthChart = new ApexCharts(document.querySelector("#growthChart"), growthOptions);
    growthChart.render();
    </script>

    <!-- Subscription Modal -->
    <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscriptionModalLabel">
                        <?php echo $trial_eligible ? 'Start Your Free Trial' : 'Subscribe to Continue'; ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($trial_eligible): ?>
                        <p>Start your 14-day free trial to access all features:</p>
                        <ul class="list-unstyled">
                            <li>✓ Post unlimited jobs</li>
                            <li>✓ Access to candidate database</li>
                            <li>✓ Advanced analytics</li>
                            <li>✓ Priority support</li>
                        </ul>
                        <form action="process_subscription.php" method="POST">
                            <input type="hidden" name="activate_trial" value="1">
                            <button type="button" class="btn btn-primary w-100" onclick="confirmTrial(this.form)">Start Free Trial</button>
                            <script>
                            function confirmTrial(form) {
                                if (confirm('Are you sure you want to start your 14-day free trial?')) {
                                    form.submit();
                                }
                            }
                            </script>
                        </form>
                    <?php else: ?>
                        <p>Your trial period has ended. Choose a subscription plan to continue posting jobs and accessing all features.</p>
                        <a href="subscription.php" class="btn btn-primary w-100">View Subscription Plans</a>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show subscription modal if needed
        <?php if ($show_subscription_modal): ?>
        document.addEventListener('DOMContentLoaded', function() {
            var subscriptionModal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
            subscriptionModal.show();
        });
        <?php endif; ?>
    </script>
</body>
</html>
