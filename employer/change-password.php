<?php 
include '../config.php';

// Check if either employer or recruiter is logged in
if (!isset($_SESSION['kenz_employer']) && !isset($_SESSION['kenz_recruiter'])) {
    header("Location: ../employer-login.php");
    exit;
}

// Handle password change
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $current_password = hash('sha256', $_POST['current_password']);
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Determine if it's an employer or recruiter
        if(isset($_SESSION['kenz_recruiter'])) {
            $user_id = $_SESSION['kenz_recruiter'];
            $table = "recruiter_tbl";
        } else {
            $user_id = $_SESSION['kenz_employer'];
            $table = "employer_tbl";
        }


        // Verify current password
        $stmt = $conn->prepare("SELECT id FROM $table WHERE id = :user_id AND password = :current_password");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':current_password', $current_password);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $_SESSION['error'] = "Current password is incorrect!";
        } else if ($new_password !== $confirm_password) {
            $_SESSION['error'] = "New passwords do not match!";
        } else if (strlen($new_password) < 5) {
            $_SESSION['error'] = "Password must be at least 5 characters long!";
        } else {
            // Update password
            $hashed_new_password = hash('sha256', $new_password);
            $update_stmt = $conn->prepare("UPDATE $table SET password = :new_password WHERE id = :user_id");
            $update_stmt->bindParam(':new_password', $hashed_new_password);
            $update_stmt->bindParam(':user_id', $user_id);
            
            if ($update_stmt->execute()) {
                // $_SESSION['success'] = "Password changed successfully!";
                echo "<script>alert('Password changed successfully!'); window.location.href = 'index.php';</script>";
                
                exit;
            } else {
                $_SESSION['error'] = "Failed to update password. Please try again.";
            }
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Change Password</title>
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Change Password</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Change Password</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="">
                                            <div class="mb-3">
                                                <label class="form-label" for="current_password">Current Password</label>
                                                <input type="password" class="form-control" id="current_password" 
                                                    name="current_password" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="new_password">New Password</label>
                                                <input type="password" class="form-control" id="new_password" 
                                                    name="new_password" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="confirm_password">Confirm New Password</label>
                                                <input type="password" class="form-control" id="confirm_password" 
                                                    name="confirm_password" required />
                                            </div>
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/popper/popper.js"></script>
    <script src="./assets/vendor/js/bootstrap.js"></script>
    <script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="./assets/vendor/js/menu.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html> 