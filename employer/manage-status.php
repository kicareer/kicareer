<?php 
include '../config.php';

// Check if employer is logged in
if (!isset($_SESSION['kenz_employer'])) {
    header("Location: ../employer-login.php");
    exit;
}

$employer_id = $_SESSION['kenz_employer'];
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Manage Status</title>
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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Settings /</span> Candidate Status</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                                Add Status
                            </button>
                        </div>

                        <!-- Status List Card -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Status List</h5>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
                                            <th>Status Name</th>
                                            <th>Created Date</th>
                                            <th>Last Updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM candidate_status WHERE employer_id = :employer_id ORDER BY created_at DESC");
                                        $stmt->bindParam(':employer_id', $employer_id);
                                        $stmt->execute();
                                        $statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        $counter = 1;

                                        if (!empty($statuses)):
                                            foreach ($statuses as $status): ?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><?php echo htmlspecialchars($status['status_name']); ?></td>
                                                    <td><?php echo date('d M Y', strtotime($status['created_at'])); ?></td>
                                                    <td><?php echo $status['updated_at'] ? date('d M Y', strtotime($status['updated_at'])) : '-'; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary edit-status" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editStatusModal"
                                                            data-id="<?php echo $status['id']; ?>"
                                                            data-name="<?php echo htmlspecialchars($status['status_name']); ?>">
                                                            Edit
                                                        </button>
                                                        <a href="javascript:void(0);" onclick="deleteStatus(<?php echo $status['id']; ?>)" 
                                                           class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No status found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Add Status Modal -->
                        <div class="modal fade" id="addStatusModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Status Name</label>
                                                <input type="text" name="status_name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="add_status" class="btn btn-primary">Add Status</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Status Modal -->
                        <div class="modal fade" id="editStatusModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" id="edit_status_id" name="status_id">
                                            <div class="mb-3">
                                                <label class="form-label">Status Name</label>
                                                <input type="text" id="edit_status_name" name="status_name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="edit_status" class="btn btn-primary">Update Status</button>
                                        </div>
                                    </form>
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

    <script>
    // Handle edit status button
    document.querySelectorAll('.edit-status').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit_status_id').value = this.dataset.id;
            document.getElementById('edit_status_name').value = this.dataset.name;
        });
    });

    // Handle delete status
    function deleteStatus(statusId) {
        if(confirm('Are you sure you want to delete this status?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_status';
            input.value = statusId;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>

    <?php
    // Handle Add Status
    if(isset($_POST['add_status'])) {
        $status_name = htmlspecialchars(trim($_POST['status_name']));
        
        try {
            $stmt = $conn->prepare("INSERT INTO candidate_status (status_name, employer_id, created_at) VALUES (:status_name, :employer_id, NOW())");
            $stmt->bindParam(':status_name', $status_name);
            $stmt->bindParam(':employer_id', $employer_id);
            
            if($stmt->execute()) {
                echo "<script>alert('Status added successfully!'); window.location.href='manage-status.php';</script>";
            } else {
                echo "<script>alert('Failed to add status!');</script>";
            }
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    // Handle Edit Status
    if(isset($_POST['edit_status'])) {
        $status_id = $_POST['status_id'];
        $status_name = htmlspecialchars(trim($_POST['status_name']));
        
        try {
            $stmt = $conn->prepare("UPDATE candidate_status SET status_name = :status_name, updated_at = NOW() WHERE id = :id AND employer_id = :employer_id");
            $stmt->bindParam(':status_name', $status_name);
            $stmt->bindParam(':id', $status_id);
            $stmt->bindParam(':employer_id', $employer_id);
            
            if($stmt->execute()) {
                echo "<script>alert('Status updated successfully!'); window.location.href='manage-status.php';</script>";
            } else {
                echo "<script>alert('Failed to update status!');</script>";
            }
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    // Handle Delete Status
    if(isset($_POST['delete_status'])) {
        $status_id = $_POST['delete_status'];
        
        try {
            $stmt = $conn->prepare("DELETE FROM candidate_status WHERE id = :id AND employer_id = :employer_id");
            $stmt->bindParam(':id', $status_id);
            $stmt->bindParam(':employer_id', $employer_id);
            
            if($stmt->execute()) {
                echo "<script>alert('Status deleted successfully!'); window.location.href='manage-status.php';</script>";
            } else {
                echo "<script>alert('Failed to delete status!');</script>";
            }
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
    ?>
</body>
</html> 