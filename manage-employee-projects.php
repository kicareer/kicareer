<?php
include('config.php');

// Validate and secure session values
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirect if session is not set
    exit;
}

$id = htmlspecialchars(trim($_SESSION['id']));

// Fetch projects related to the logged-in employee
$query = $conn->prepare("SELECT * FROM projects_tbl WHERE emp_id = :emp_id ORDER BY start_date DESC");
$query->execute([':emp_id' => $id]);
$projects = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Manage Projects</title>
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
                                <h2>Manage Projects</h2>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">Add Project</button>
                            </div>
                            <!-- Projects Table -->
                            <div class="table-responsive px-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project Name</th>
                                            <th width="15%">Client</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Role</th>
                                            <th width="25%">Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($projects)) : ?>
                                            <?php foreach ($projects as $index => $project) : ?>
                                                <tr>
                                                    <td><?= $index + 1; ?></td>
                                                    <td><?= htmlspecialchars($project['project_name']); ?></td>
                                                    <td><?= htmlspecialchars($project['client']); ?></td>
                                                    <td><?= htmlspecialchars($project['start_date']); ?></td>
                                                    <td><?= htmlspecialchars($project['end_date'] ?: 'Ongoing'); ?></td>
                                                    <td><?= htmlspecialchars($project['role']); ?></td>
                                                    <td><?= htmlspecialchars($project['description']); ?></td>
                                                    <td>
                                                        <button 
                                                            class="btn btn-warning btn-sm edit-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editProjectModal"
                                                            data-id="<?= $project['id']; ?>"
                                                            data-project-name="<?= htmlspecialchars($project['project_name']); ?>"
                                                            data-client="<?= htmlspecialchars($project['client']); ?>"
                                                            data-start-date="<?= htmlspecialchars($project['start_date']); ?>"
                                                            data-end-date="<?= htmlspecialchars($project['end_date']); ?>"
                                                            data-role="<?= htmlspecialchars($project['role']); ?>"
                                                            data-description="<?= htmlspecialchars($project['description']); ?>"
                                                        >
                                                            Edit
                                                        </button>
                                                        <a href="delete-project.php?id=<?= $project['id']; ?>" class="btn btn-danger btn-sm" 
                                                           onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="8" class="text-center">No projects found.</td>
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

    <!-- Add Project Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="add-project.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProjectModalLabel">Add Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="client" class="form-label">Client</label>
                            <input type="text" class="form-control" id="client" name="client" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date (optional)</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" name="role" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_project" class="btn btn-primary">Save Project</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="edit-project.php">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="edit_project_name" name="project_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_client" class="form-label">Client</label>
                            <input type="text" class="form-control" id="edit_client" name="client" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_end_date" class="form-label">End Date (optional)</label>
                            <input type="date" class="form-control" id="edit_end_date" name="end_date">
                        </div>
                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="edit_role" name="role" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_project" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const data = e.target.dataset;
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_project_name').value = data.projectName;
                document.getElementById('edit_client').value = data.client;
                document.getElementById('edit_start_date').value = data.startDate;
                document.getElementById('edit_end_date').value = data.endDate;
                document.getElementById('edit_role').value = data.role;
                document.getElementById('edit_description').value = data.description;
            });
        });
    </script>
</body>
</html>
