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
    <title>Manage Job Locations</title>
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
                            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Settings /</span> Job Locations</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                                Add Location
                            </button>
                        </div>

                        <!-- Location List Card -->
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Job Locations</h5>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
                                            <th>Location Name</th>
                                            <th>Created Date</th>
                                            <th>Last Updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM job_locations WHERE employer_id = :employer_id ORDER BY created_at DESC");
                                        $stmt->bindParam(':employer_id', $employer_id);
                                        $stmt->execute();
                                        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        $counter = 1;
                                        if (!empty($locations)):
                                            foreach ($locations as $location): ?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><?php echo htmlspecialchars($location['location_name']); ?></td>
                                                    <td><?php echo date('d M Y', strtotime($location['created_at'])); ?></td>
                                                    <td><?php echo $location['updated_at'] ? date('d M Y', strtotime($location['updated_at'])) : '-'; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary edit-location" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editLocationModal"
                                                            data-id="<?php echo $location['id']; ?>"
                                                            data-name="<?php echo htmlspecialchars($location['location_name']); ?>">
                                                            Edit
                                                        </button>
                                                        <a href="javascript:void(0);" onclick="deleteLocation(<?php echo $location['id']; ?>)" 
                                                           class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No locations found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Add Location Modal -->
                        <div class="modal fade" id="addLocationModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Location</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Location Name</label>
                                                <input type="text" name="location_name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="add_location" class="btn btn-primary">Add Location</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Location Modal -->
                        <div class="modal fade" id="editLocationModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Location</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" id="edit_location_id" name="location_id">
                                            <div class="mb-3">
                                                <label class="form-label">Location Name</label>
                                                <input type="text" id="edit_location_name" name="location_name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="edit_location" class="btn btn-primary">Update Location</button>
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
    // Handle edit location button
    document.querySelectorAll('.edit-location').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit_location_id').value = this.dataset.id;
            document.getElementById('edit_location_name').value = this.dataset.name;
        });
    });

    // Handle delete location
    function deleteLocation(locationId) {
        if(confirm('Are you sure you want to delete this location?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_location';
            input.value = locationId;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>

    <?php
    // Handle Add Location
    if(isset($_POST['add_location'])) {
        $location_name = htmlspecialchars(trim($_POST['location_name']));
        
        try {
            $stmt = $conn->prepare("INSERT INTO job_locations (location_name, employer_id, created_at) VALUES (:location_name, :employer_id, NOW())");
            $stmt->bindParam(':location_name', $location_name);
            $stmt->bindParam(':employer_id', $employer_id);
            
            if($stmt->execute()) {
                echo "<script>alert('Location added successfully!'); window.location.href='manage-locations.php';</script>";
            } else {
                echo "<script>alert('Failed to add location!');</script>";
            }
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    // Handle Edit Location
    if(isset($_POST['edit_location'])) {
        $location_id = $_POST['location_id'];
        $location_name = htmlspecialchars(trim($_POST['location_name']));
        
        try {
            $stmt = $conn->prepare("UPDATE job_locations SET location_name = :location_name, updated_at = NOW() WHERE id = :id AND employer_id = :employer_id");
            $stmt->bindParam(':location_name', $location_name);
            $stmt->bindParam(':id', $location_id);
            $stmt->bindParam(':employer_id', $employer_id);
            
            if($stmt->execute()) {
                echo "<script>alert('Location updated successfully!'); window.location.href='manage-locations.php';</script>";
            } else {
                echo "<script>alert('Failed to update location!');</script>";
            }
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }

    // Handle Delete Location
    if(isset($_POST['delete_location'])) {
        $location_id = $_POST['delete_location'];
        
        try {
            $stmt = $conn->prepare("DELETE FROM job_locations WHERE id = :id AND employer_id = :employer_id");
            $stmt->bindParam(':id', $location_id);
            $stmt->bindParam(':employer_id', $employer_id);
            
            if($stmt->execute()) {
                echo "<script>alert('Location deleted successfully!'); window.location.href='manage-locations.php';</script>";
            } else {
                echo "<script>alert('Failed to delete location!');</script>";
            }
        } catch(PDOException $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
    ?>
</body>
</html> 