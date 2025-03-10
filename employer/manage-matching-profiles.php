<?php
// session_start();
require_once('../config.php');
require_once('../classes/db.php');

// Check if employer is logged in
if (!isset($_SESSION['employer_id'])) {
    header('Location: login.php');
    exit();
}

$employer_id = $_SESSION['employer_id'];
$job_id = $_GET['id'] ?? null;

if (!$job_id) {
    die('Job ID not provided');
}

$db = new DbConnect();
$conn = $db->connect();

// Fetch job details
$job_query = "SELECT * FROM post WHERE sno = :job_id AND employer_id = :employer_id";
$stmt = $conn->prepare($job_query);
$stmt->bindParam(':job_id', $job_id);
$stmt->bindParam(':employer_id', $employer_id);
$stmt->execute();
$job = $stmt->fetch(PDO::FETCH_ASSOC);

// echo  json_encode($job);
// exit;

if (!$job) {
    die('Job not found or access denied');
}

// Function to calculate match percentage
function calculateMatchPercentage($candidate_skills, $job_skills) {
    if (empty($job_skills) || empty($candidate_skills)) return 0;
    
    $job_skills_array = array_map('trim', explode(',', strtolower($job_skills)));
    $candidate_skills_array = array_map('trim', explode(',', strtolower($candidate_skills)));
    
    $matching_skills = array_intersect($job_skills_array, $candidate_skills_array);
    
    return round((count($matching_skills) / count($job_skills_array)) * 100);
}

// Fetch matching candidates based on experience and skills
$query = "SELECT e.*, s.skills_content,
          (
              CASE 
                  WHEN e.experience BETWEEN :min_exp AND :max_exp THEN 30
                  WHEN e.experience >= :min_exp THEN 20
                  ELSE 0
              END
          ) as exp_points
          FROM emp_tbl e
          LEFT JOIN skills_tbl s ON e.id = s.application_id
          WHERE e.status = 'active'
          ORDER BY exp_points DESC, e.experience DESC";

$stmt = $conn->prepare($query);
$stmt->bindParam(':min_exp', $job['exper_min']);
$stmt->bindParam(':max_exp', $job['exper_max']);
$stmt->execute();
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get job skills
$job_skills = $job['skills'];

// Include header
include('includes/header.php');
?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php include('includes/sidebar.php'); ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <?php include('includes/top-bar.php'); ?>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Jobs /</span> Matching Profiles
                    </h4>

                    <!-- Job Details Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Job Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Title:</strong> <?php echo htmlspecialchars($job['job_title']); ?></p>
                                    <p><strong>Experience Required:</strong> <?php echo $job['exper_min'] . '-' . $job['exper_max']; ?> years</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Skills Required:</strong> <?php echo htmlspecialchars($job['skills']); ?></p>
                                    <p><strong>Salary Range:</strong> ₹<?php echo number_format($job['salary_min']) . ' - ₹' . number_format($job['salary_max']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Matching Profiles Table -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Matching Profiles</h5>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Experience</th>
                                        <th>Match Percentage</th>
                                        <th>Professional Summary</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php foreach ($candidates as $candidate): 
                                        // Calculate total match score
                                        $exp_points = $candidate['exp_points'];
                                        $skills_match = calculateMatchPercentage($candidate['skills_content'] ?? '', $job_skills);
                                        $total_match = $exp_points + $skills_match;
                                        
                                        // Skip if total match is too low
                                        if ($total_match < 30) continue;
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if (!empty($candidate['profile_image'])): ?>
                                                <div class="avatar avatar-sm me-3">
                                                    <img src="../<?php echo htmlspecialchars($candidate['profile_image']); ?>" 
                                                         alt="Profile" class="rounded-circle">
                                                </div>
                                                <?php else: ?>
                                                <div class="avatar avatar-sm me-3">
                                                    <div class="avatar-initial rounded-circle bg-label-primary">
                                                        <?php echo strtoupper(substr($candidate['name'], 0, 1)); ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <div>
                                                    <strong><?php echo htmlspecialchars($candidate['name']); ?></strong>
                                                    <br>
                                                    <small class="text-muted"><?php echo htmlspecialchars($candidate['email']); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo $candidate['experience']; ?> years</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress w-100 me-2" style="height: 6px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: <?php echo $total_match; ?>%"
                                                         aria-valuenow="<?php echo $total_match; ?>" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100"></div>
                                                </div>
                                                <small class="text-muted"><?php echo $total_match; ?>%</small>
                                            </div>
                                            <small class="text-muted">
                                                Experience: <?php echo $exp_points; ?>% | 
                                                Skills: <?php echo $skills_match; ?>%
                                            </small>
                                        </td>
                                        <td>
                                            <?php if (!empty($candidate['skills_content'])): ?>
                                                <strong>Skills:</strong><br>
                                                <?php 
                                                    $skills = explode(',', $candidate['skills_content']);
                                                    foreach ($skills as $skill): 
                                                        $skill = trim($skill);
                                                        if (empty($skill)) continue;
                                                ?>
                                                    <span class="badge bg-label-primary me-1"><?php echo htmlspecialchars($skill); ?></span>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php if (!empty($candidate['professional_summary'])): ?>
                                                <br><br><strong>Summary:</strong><br>
                                                <?php echo nl2br(htmlspecialchars(substr($candidate['professional_summary'], 0, 100))); ?>...
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- <a class="dropdown-item" href="view_candidate.php?id=<?php echo $candidate['id']; ?>">
                                                        <i class="bx bx-show-alt me-1"></i> View Profile
                                                    </a> -->
                                                    <?php if (!empty($candidate['resume'])): ?>
                                                    <a class="dropdown-item" href="kenz-resume.php?uid=<?php echo $candidate['id']; ?>" target="_blank">
                                                        <i class="bx bx-file me-1"></i> View Resume
                                                    </a>
                                                    <?php endif; ?>
                                                    <?php if (!empty($candidate['whatsapp'])): ?>
                                                    <a class="dropdown-item" href="https://wa.me/<?php echo $candidate['country_code'].$candidate['whatsapp']; ?>" target="_blank">
                                                        <i class="bx bxl-whatsapp me-1"></i> WhatsApp
                                                    </a>
                                                    <?php endif; ?>
                                                    <a class="dropdown-item" href="mailto:<?php echo $candidate['email']; ?>">
                                                        <i class="bx bx-envelope me-1"></i> Email
                                                    </a>
                                                    <?php if (!empty($candidate['contact_number'])): ?>
                                                    <a class="dropdown-item" href="tel:<?php echo $candidate['country_code'].$candidate['contact_number']; ?>">
                                                        <i class="bx bx-phone me-1"></i> Call
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
                <!-- / Content -->

                <!-- Footer -->
                <?php include('includes/footer.php'); ?>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
</div>
<!-- / Layout wrapper -->

<?php include('includes/scripts.php'); ?>
