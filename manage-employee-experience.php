<?php
include('config.php');

// Validate and secure session values
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirect if session is not set
    exit;
}

$id = htmlspecialchars(trim($_SESSION['id']));
$key = $_SESSION;

$query = $conn->prepare("SELECT * FROM experience_tbl WHERE emp_id = :emp_id ORDER BY start_date DESC");
$query->execute([':emp_id' => $id]);
$experiences = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Manage Experience</title>
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
                    <div class="col-md-8" >
                        <div class="card card-article mt-4" style="min-height: 50vh">
                            <div class="d-flex justify-content-between align-items-center mb-3 p-3">
                                <h2>Manage Experience</h2>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExperienceModal">Add Experience</button>
                            </div>
                            <!-- Experience Table -->
                            <div class="table-responsive px-3">
                            <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Job Title</th>
            <th>Company Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($experiences)) : ?>
            <?php foreach ($experiences as $index => $experience) : ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($experience['job_title']); ?></td>
                    <td><?= htmlspecialchars($experience['company_name']); ?></td>
                    <td><?= htmlspecialchars($experience['start_date']); ?></td>
                    <td><?= htmlspecialchars($experience['end_date'] ?: 'Present'); ?></td>
                    <td><?= htmlspecialchars($experience['description']); ?></td>
                    <td>
                        <button 
                            class="btn btn-warning btn-sm edit-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editExperienceModal"
                            data-id="<?= $experience['id']; ?>"
                            data-job-title="<?= htmlspecialchars($experience['job_title']); ?>"
                            data-company-name="<?= htmlspecialchars($experience['company_name']); ?>"
                            data-start-date="<?= htmlspecialchars($experience['start_date']); ?>"
                            data-end-date="<?= htmlspecialchars($experience['end_date']); ?>"
                            data-description="<?= htmlspecialchars($experience['description']); ?>"
                        >
                            Edit
                        </button>
                        <a href="delete-experience.php?id=<?= $experience['id']; ?>" class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure you want to delete this experience?');">Delete</a>
                    
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="7" class="text-center">No experiences found.</td>
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

    <!-- Add Experience Modal -->
    <div class="modal fade" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="add_experience.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addExperienceModalLabel">Add Experience</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="job_title" name="job_title" required>
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date (Leave empty if current)</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_experience" class="btn btn-primary">Save Experience</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Experience Modal -->
<div class="modal fade" id="editExperienceModal" tabindex="-1" aria-labelledby="editExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editExperienceForm" method="POST" action="edit-experience.php">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editExperienceModalLabel">Edit Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_job_title" class="form-label">Job Title</label>
                        <input type="text" class="form-control" id="edit_job_title" name="job_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="edit_company_name" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_end_date" class="form-label">End Date (Leave empty if current)</label>
                        <input type="date" class="form-control" id="edit_end_date" name="end_date">
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const editForm = document.getElementById('editExperienceForm');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Populate modal fields
                document.getElementById('edit_id').value = this.getAttribute('data-id');
                document.getElementById('edit_job_title').value = this.getAttribute('data-job-title');
                document.getElementById('edit_company_name').value = this.getAttribute('data-company-name');
                document.getElementById('edit_start_date').value = this.getAttribute('data-start-date');
                document.getElementById('edit_end_date').value = this.getAttribute('data-end-date') || '';
                document.getElementById('edit_description').value = this.getAttribute('data-description');
            });
        });
    });
</script>

<!-- include footer -->
<?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
