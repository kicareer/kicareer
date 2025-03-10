<?php
include('config.php');

// Validate and secure session values
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirect if session is not set
    exit;
}

$id = htmlspecialchars(trim($_SESSION['id']));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Manage Resume</title>
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
                    <div class="col-md-2"> <?php include_once 'sidebar.php'; ?></div>
                    <div class="col-md-8">
                        <div class="card card-article mt-4" style="min-height: 50vh">
                            <div class="d-flex justify-content-between align-items-center mb-3 p-3">
                                <h2>Manage Resume</h2>

                            </div>
                            <hr />
                            <div class="d-flex justify-content-center">

                                <a class="btn btn-success" style="max-width: 200px;" href="<?php echo $_SESSION['resume'] ?>" target="_blank">Download My Resume</a>

                            </div>

                            <div class="d-flex justify-content-center">
                                <form class="form-horizontal d-flex align-items-center justify-content-around" action="" method="post" enctype="multipart/form-data">
                                    <!-- <label for="resume">Upload Latest Resume</label><br /> -->
                                    <input type="file" name="upload_resume" class="form-control me-2" placeholder="Upload Resume" />
                                    <button type="submit" style="margin-top: 5px;" class="btn btn-success" href="<?php echo $_SESSION['resume'] ?>">Upload</button>
                                </form>

                            </div>
                            <div class="resume-cards p-3">
                                <h3 class="text-center mb-4">Select a Resume Template</h3>
                                <div class="row">
                                    <?php
                                    // Array of template data (ID, Image Path, Name)
                                    $templates = [
                                        ['id' => 1, 'image' => 'images/templates/template_1.jpg', 'name' => 'Classic Template', 'path' => 'resume_template1.php'],
                                        ['id' => 2, 'image' => 'images/templates/template_2.jpg', 'name' => 'Modern Template', 'path' => 'resume_template2.php'],
                                        ['id' => 3, 'image' => 'images/templates/template_3.jpg', 'name' => 'Professional Template', 'path' => 'resume_template3.php'],
                                    ];

                                    // Display template options
                                    foreach ($templates as $template) {
                                        echo "
            <div class='col-md-4 text-center mb-3'>
                <div class='card'>
                    <img src='{$template['image']}' class='card-img-top' alt='{$template['name']}' style='height: 200px;  object-fit: contain;'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$template['name']}</h5>
                        <form action='{$template['path']}' method='POST'>
                            <input type='hidden' name='template_id' value='{$template['id']}'>
                            <button type='submit' class='btn btn-primary'>View & Download</button>
                        </form>
                    </div>
                </div>
            </div>";
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section>
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