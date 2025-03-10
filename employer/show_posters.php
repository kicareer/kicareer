<?php
include '../config.php';
require_once('../classes/db.php');

if (!isset($_GET['id'])) {
    header("Location: manage-jobs.php");
    exit();
}

$job_id = $_GET['id'];
$sql = "SELECT * FROM post WHERE sno = :job_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
$stmt->execute();
$job = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$job) {
    header("Location: manage-jobs.php");
    exit();
}
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

    <title>Choose Poster Design - <?php echo $website_name; ?></title>

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

    <!-- Core CSS -->
    <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="./assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <style>
        .poster-container {
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .poster-preview {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .poster-preview:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .poster-preview img {
            width: 100%;
            height: auto;
        }
        .poster-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 15px 0 5px;
            border-top: 1px solid #eaeaea;
        }
        .preview-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #566a7f;
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eaeaea;
        }
        .poster-image {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            border: 1px solid #eaeaea;
        }
        .poster-image img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }
        .poster-preview:hover .poster-image img {
            transform: scale(1.02);
        }
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .btn-sm i {
            font-size: 1.1rem;
        }
        .btn-primary {
            background-color: #696cff;
            border-color: #696cff;
        }
        .btn-info {
            background-color: #03c3ec;
            border-color: #03c3ec;
            color: white;
        }
        .btn-success {
            background-color: #71dd37;
            border-color: #71dd37;
        }
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>

    <!-- Helpers -->
    <script src="./assets/vendor/js/helpers.js"></script>
    <script src="./assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include 'includes/sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include 'includes/top-bar.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Choose Poster Design</h4>

                        <div class="row">
                            <!-- Design 1 -->
                            <div class="col-md-6">
                                <div class="poster-preview">
                                    <div class="preview-title">Professional Design</div>
                                    <div class="poster-image">
                                        <img src="create_poster.php?id=<?php echo $job_id; ?>&preview=true" alt="Professional Design">
                                    </div>
                                    <div class="poster-actions">
                                        <a href="create_poster.php?id=<?php echo $job_id; ?>&download=true" class="btn btn-primary btn-sm">
                                            <i class="bx bx-download"></i> Download
                                        </a>
                                        <a href="create_poster.php?id=<?php echo $job_id; ?>" target="_blank" class="btn btn-info btn-sm">
                                            <i class="bx bx-show"></i> Preview
                                        </a>
                                        <a href="share_poster.php?id=<?php echo $job_id; ?>&design=classic" class="btn btn-success btn-sm">
                                            <i class="bx bx-share-alt"></i> Share
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Design 2 -->
                            <div class="col-md-6">
                                <div class="poster-preview">
                                    <div class="preview-title">Modern Design</div>
                                    <img src="create_poster_alt.php?id=<?php echo $job_id; ?>&preview=true" alt="Modern Design">
                                    <div class="poster-actions">
                                        <a href="share_poster.php?id=<?php echo $job_id; ?>&design=modern" class="btn btn-primary btn-sm">
                                            <i class="bx bx-share-alt"></i> Share
                                        </a>
                                        <a href="create_poster_alt.php?id=<?php echo $job_id; ?>" target="_blank" class="btn btn-secondary btn-sm">
                                            <i class="bx bx-show"></i> Preview
                                        </a>
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
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="./assets/vendor/js/menu.js"></script>

    <!-- Main JS -->
    <script src="./assets/js/main.js"></script>

    <!-- Page JS -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
