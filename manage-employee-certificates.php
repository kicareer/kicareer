<?php
include('config.php');

// Validate and secure session values
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirect if session is not set
    exit;
}

$id = htmlspecialchars(trim($_SESSION['id']));

// Fetch certificates related to the logged-in employee
$query = $conn->prepare("SELECT * FROM certificates_tbl WHERE emp_id = :emp_id ORDER BY issue_date DESC");
$query->execute([':emp_id' => $id]);
$certificates = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Manage Certificates</title>
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
                                <h2>Manage Certificates</h2>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCertificateModal">Add Certificate</button>
                            </div>
                            <!-- Certificates Table -->
                            <div class="table-responsive px-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Certificate Name</th>
                                            <th>Issued By</th>
                                            <th>Issue Date</th>
                                            <th>Valid Till</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($certificates)) : ?>
                                            <?php foreach ($certificates as $index => $certificate) : ?>
                                                <tr>
                                                    <td><?= $index + 1; ?></td>
                                                    <td><?= htmlspecialchars($certificate['certificate_name']); ?></td>
                                                    <td><?= htmlspecialchars($certificate['issued_by']); ?></td>
                                                    <td><?= htmlspecialchars($certificate['issue_date']); ?></td>
                                                    <td><?= htmlspecialchars($certificate['valid_till'] ?: 'N/A'); ?></td>
                                                    <td><?= htmlspecialchars($certificate['description']); ?></td>
                                                    <td>
                                                        <button 
                                                            class="btn btn-warning btn-sm edit-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editCertificateModal"
                                                            data-id="<?= $certificate['id']; ?>"
                                                            data-certificate-name="<?= htmlspecialchars($certificate['certificate_name']); ?>"
                                                            data-issued-by="<?= htmlspecialchars($certificate['issued_by']); ?>"
                                                            data-issue-date="<?= htmlspecialchars($certificate['issue_date']); ?>"
                                                            data-valid-till="<?= htmlspecialchars($certificate['valid_till']); ?>"
                                                            data-description="<?= htmlspecialchars($certificate['description']); ?>"
                                                        >
                                                            Edit
                                                        </button>
                                                        <a href="delete-certificate.php?id=<?= $certificate['id']; ?>" class="btn btn-danger btn-sm" 
                                                           onclick="return confirm('Are you sure you want to delete this certificate?');">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="7" class="text-center">No certificates found.</td>
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

    <!-- Add Certificate Modal -->
    <div class="modal fade" id="addCertificateModal" tabindex="-1" aria-labelledby="addCertificateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="add-certificate.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCertificateModalLabel">Add Certificate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="certificate_name" class="form-label">Certificate Name</label>
                            <input type="text" class="form-control" id="certificate_name" name="certificate_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="issued_by" class="form-label">Issued By</label>
                            <input type="text" class="form-control" id="issued_by" name="issued_by" required>
                        </div>
                        <div class="mb-3">
                            <label for="issue_date" class="form-label">Issue Date</label>
                            <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="valid_till" class="form-label">Valid Till (optional)</label>
                            <input type="date" class="form-control" id="valid_till" name="valid_till">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_certificate" class="btn btn-primary">Save Certificate</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Certificate Modal -->
    <div class="modal fade" id="editCertificateModal" tabindex="-1" aria-labelledby="editCertificateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="edit-certificate.php">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCertificateModalLabel">Edit Certificate</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_certificate_name" class="form-label">Certificate Name</label>
                            <input type="text" class="form-control" id="edit_certificate_name" name="certificate_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_issued_by" class="form-label">Issued By</label>
                            <input type="text" class="form-control" id="edit_issued_by" name="issued_by" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_issue_date" class="form-label">Issue Date</label>
                            <input type="date" class="form-control" id="edit_issue_date" name="issue_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_valid_till" class="form-label">Valid Till (optional)</label>
                            <input type="date" class="form-control" id="edit_valid_till" name="valid_till">
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_certificate" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Populate Edit Modal with existing certificate data
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const data = e.target.dataset;
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_certificate_name').value = data.certificateName;
                document.getElementById('edit_issued_by').value = data.issuedBy;
                document.getElementById('edit_issue_date').value = data.issueDate;
                document.getElementById('edit_valid_till').value = data.validTill;
                document.getElementById('edit_description').value = data.description;
            });
        });
    </script>
  <?php include_once 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
