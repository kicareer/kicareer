<?php
require_once('../config.php');
require_once('../classes/db.php');

$job_id = $_GET['id'] ?? null;
if (!$job_id) {
    die('Job ID not provided');
}

// Fetch job details for meta tags
$query = "SELECT j.*, e.company_name FROM post j 
          LEFT JOIN employer_tbl e ON j.employer_id = e.id 
          WHERE j.sno = :job_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':job_id', $job_id);
$stmt->execute();
$job = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$job) {
    die('Job not found');
}

// Get the selected poster design (classic or modern)
$design = $_GET['design'] ?? 'classic';
$poster_script = $design === 'modern' ? 'create_poster_alt.php' : 'create_poster.php';

// Generate absolute URL for the poster
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$poster_url = $protocol . $host . dirname($_SERVER['PHP_SELF']) . '/' . $poster_script . '?id=' . $job_id;

// Prepare sharing text
$share_title = $job['job_title'] . ' at ' . $job['company_name'];
$share_text = 'New job opening: ' . $share_title;
$share_url = $protocol . $host . '/job/' . $job_id;

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
                        <span class="text-muted fw-light">Jobs /</span> Share Job Poster
                    </h4>

                    <!-- Share Container -->
                    <div class="card">
                        <div class="card-body">
                            <div class="poster-preview mb-4">
                                <div class="poster-container">
                                    <img src="<?php echo htmlspecialchars($poster_script . '?id=' . $job_id); ?>" 
                                         alt="<?php echo htmlspecialchars($share_title); ?>"
                                         class="img-fluid rounded">
                                </div>
                            </div>
                            
                            <div class="share-buttons">
                                <a href="<?php echo htmlspecialchars($poster_script . '?id=' . $job_id . '&download=true'); ?>" 
                                   class="share-button download">
                                    <i class="fas fa-download"></i> Download
                                </a>
                                
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($share_url); ?>" 
                                   target="_blank" class="share-button facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                
                                <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($share_text); ?>&url=<?php echo urlencode($share_url); ?>" 
                                   target="_blank" class="share-button twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($share_url); ?>&title=<?php echo urlencode($share_title); ?>" 
                                   target="_blank" class="share-button linkedin">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                                
                                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($share_text . ' ' . $share_url); ?>" 
                                   target="_blank" class="share-button whatsapp">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                            
                            <div class="copy-link mt-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="poster-url" 
                                           value="<?php echo htmlspecialchars($poster_url); ?>" readonly>
                                    <button class="btn btn-primary" onclick="copyLink()">Copy Link</button>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- / Share Container -->
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

<!-- Core JS -->
<?php include('includes/scripts.php'); ?>

<style>
.share-container {
    max-width: 800px;
    margin: 0 auto;
}
.poster-preview {
    display: flex;
    justify-content: center;
    align-items: center;
}
.poster-container {
    max-width: 500px;
    margin: 0 auto;
}
.poster-preview img {
    width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
.share-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 30px;
    flex-wrap: wrap;
}
.share-button {
    padding: 10px 20px;
    border-radius: 5px;
    color: #fff !important;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: transform 0.2s;
    min-width: 120px;
    justify-content: center;
}
.share-button:hover {
    transform: translateY(-2px);
    text-decoration: none;
}
.facebook { background: #3b5998; }
.twitter { background: #1da1f2; }
.linkedin { background: #0077b5; }
.whatsapp { background: #25d366; }
.download { background: #28a745; }
</style>

<script>
function copyLink() {
    var copyText = document.getElementById("poster-url");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    var button = document.querySelector('.copy-link button');
    var originalText = button.innerHTML;
    button.innerHTML = 'Copied!';
    setTimeout(function() {
        button.innerHTML = originalText;
    }, 2000);
}
</script>
</body>
</html>
