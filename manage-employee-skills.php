<?php
include('config.php');

// Validate and secure session values
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirect if session is not set
    exit;
}

$id = htmlspecialchars(trim($_SESSION['id']));

// Fetch the skills of the logged-in user
$query = $conn->prepare("SELECT * FROM employee_skills_tbl WHERE emp_id = :emp_id ORDER BY skill_name ASC");
$query->execute([':emp_id' => $id]);
$skills = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Manage Skills</title>
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
                                <h2>Manage Skills</h2>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSkillModal">Add Skill</button>
                            </div>
                            <!-- Skills Table -->
                            <div class="table-responsive px-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Skill Name</th>
                                            <th>Skill Level</th>
                                            <th width="20%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($skills)) : ?>
                                            <?php foreach ($skills as $index => $skill) : ?>
                                                <tr>
                                                    <td><?= $index + 1; ?></td>
                                                    <td><?= htmlspecialchars($skill['skill_name']); ?></td>
                                                    <td><?= htmlspecialchars($skill['skill_level'] ?: 'Not specified'); ?></td>
                                                    <td>
                                                        <button 
                                                            class="btn btn-warning btn-sm edit-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editSkillModal"
                                                            data-id="<?= $skill['id']; ?>"
                                                            data-skill-name="<?= htmlspecialchars($skill['skill_name']); ?>"
                                                            data-skill-level="<?= htmlspecialchars($skill['skill_level']); ?>"
                                                        >
                                                            Edit
                                                        </button>
                                                        <a href="delete-skill.php?id=<?= $skill['id']; ?>" class="btn btn-danger btn-sm" 
                                                           onclick="return confirm('Are you sure you want to delete this skill record?');">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No skills found.</td>
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

   <!-- Add Skill Modal -->
<div class="modal fade" id="addSkillModal" tabindex="-1" aria-labelledby="addSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="add-skill.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSkillModalLabel">Add Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="skill_name" class="form-label">Skill Name</label>
                        <input type="text" class="form-control" id="skill_name" name="skill_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="skill_level" class="form-label">Skill Level</label>
                        <select class="form-select" id="skill_level" name="skill_level">
                            <option value="" disabled selected>Select Skill Level</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_skill" class="btn btn-primary">Save Skill</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Skill Modal -->
<div class="modal fade" id="editSkillModal" tabindex="-1" aria-labelledby="editSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editSkillForm" method="POST" action="edit-skill.php">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSkillModalLabel">Edit Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_skill_name" class="form-label">Skill Name</label>
                        <input type="text" class="form-control" id="edit_skill_name" name="skill_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_skill_level" class="form-label">Skill Level</label>
                        <select class="form-select" id="edit_skill_level" name="skill_level">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit_skill" class="btn btn-primary">Save Changes</button>
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
        document.getElementById('edit_skill_name').value = data.skillName;

        // Set the correct skill level in the select dropdown
        const skillLevel = data.skillLevel;
        const skillLevelSelect = document.getElementById('edit_skill_level');
        for (let option of skillLevelSelect.options) {
            if (option.value === skillLevel) {
                option.selected = true;
            }
        }
    });
});

    </script>
</body>

</html>
