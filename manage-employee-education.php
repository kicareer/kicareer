<?php
include('config.php');

// Validate and secure session values
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirect if session is not set
    exit;
}

$id = htmlspecialchars(trim($_SESSION['id']));

// Fetch the education details of the logged-in user
$query = $conn->prepare("SELECT * FROM education_tbl WHERE emp_id = :emp_id ORDER BY start_date DESC");
$query->execute([':emp_id' => $id]);
$educations = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Manage Education</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link href="webcss/plugins.css" rel="stylesheet">
    <link href="webcss/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="body-inner">
        <!-- Header -->
        <?php include 'header.php'; ?>
        <!-- Page Content -->
        <section class="p-b-0" style="background: url(gplay.png); background-repeat: repeat-x;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">  <?php include_once 'sidebar.php'; ?></div>
                    <div class="col-md-8">
                        <div class="card card-article mt-4" style="min-height: 50vh">
                            <div class="d-flex justify-content-between align-items-center mb-3 p-3">
                                <h2>Manage Education</h2>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">Add Education</button>
                            </div>
                            <!-- Education Table -->
                            <div class="table-responsive px-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Degree</th>
                                            <th>University Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($educations)) : ?>
                                            <?php foreach ($educations as $index => $education) : ?>
                                                <tr>
                                                    <td><?= $index + 1; ?></td>
                                                    <td><?= htmlspecialchars($education['degree']); ?></td>
                                                    <td><?= htmlspecialchars($education['university_name']); ?></td>
                                                    <td><?= htmlspecialchars($education['start_date']); ?></td>
                                                    <td><?= htmlspecialchars($education['end_date'] ?: 'Present'); ?></td>
                                                    <td><?= htmlspecialchars($education['description']); ?></td>
                                                    <td>
                                                        <button 
                                                            class="btn btn-warning btn-sm edit-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editEducationModal"
                                                            data-id="<?= $education['id']; ?>"
                                                            data-degree="<?= htmlspecialchars($education['degree']); ?>"
                                                            data-university-name="<?= htmlspecialchars($education['university_name']); ?>"
                                                            data-start-date="<?= htmlspecialchars($education['start_date']); ?>"
                                                            data-end-date="<?= htmlspecialchars($education['end_date']); ?>"
                                                            data-description="<?= htmlspecialchars($education['description']); ?>"
                                                        >
                                                            Edit
                                                        </button>
                                                        <a href="delete-education.php?id=<?= $education['id']; ?>" class="btn btn-danger btn-sm" 
                                                           onclick="return confirm('Are you sure you want to delete this education record?');">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No education records found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add Education Modal -->
    <div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="add_education.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEducationModalLabel">Add Education</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="degree" class="form-label">Degree</label>
                            <input type="text" class="form-control" id="degree" name="degree" required>
                        </div>
                        <div class="mb-3">
                            <label for="university_name" class="form-label">University Name</label>
                            <input type="text" class="form-control" id="university_name" name="university_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date (Leave empty if ongoing)</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_education" class="btn btn-primary">Save Education</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Education Modal -->
    <div class="modal fade" id="editEducationModal" tabindex="-1" aria-labelledby="editEducationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editEducationForm" method="POST" action="edit-education.php">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEducationModalLabel">Edit Education</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_degree" class="form-label">Degree</label>
                            <input type="text" class="form-control" id="edit_degree" name="degree" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_university_name" class="form-label">University Name</label>
                            <input type="text" class="form-control" id="edit_university_name" name="university_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_end_date" class="form-label">End Date (Leave empty if ongoing)</label>
                            <input type="date" class="form-control" id="edit_end_date" name="end_date">
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_education" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const data = e.target.dataset;
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_degree').value = data.degree;
                document.getElementById('edit_university_name').value = data.universityName;
                document.getElementById('edit_start_date').value = data.startDate;
                document.getElementById('edit_end_date').value = data.endDate;
                document.getElementById('edit_description').value = data.description;
            });
        });
    </script>
</body>

</html>
