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
    <style>
        .btn {
            background: #2b88c4 !important;
            border: 1px solid #2b88c4;
        }
    </style>
</head>

<body>
    <div class="body-inner">
        <!-- Header -->
        <?php include 'header.php'; ?>
        <!-- Page Content -->
        <section class="py-5" style="background: url('gplay.png'); background-repeat: repeat-x;">
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-2">
                        <?php include_once 'sidebar.php'; ?>
                    </div>

                    <!-- Main Content -->
                    <div class="col-md-8">
                        <div class="card shadow-lg border-0">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">Manage Resume</h2>
                            </div>
                            <div class="card-body">
                                <!-- Download Resume Section -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a class="btn me-3" style="min-width: 200px;" href="<?php echo $_SESSION['resume']; ?>" target="_blank">
                                        <i class="fas fa-download me-2"></i>Download My Resume
                                    </a>
                                    <form class="d-flex align-items-center" action="" method="post" enctype="multipart/form-data">
                                        <input type="file" required name="upload_resume" class="form-control me-2" style="max-width: 300px;" placeholder="Upload Resume" />
                                        <button type="submit" name="update_resume" class="btn  d-flex justify-content-between">
                                            <i class="fas fa-upload me-2"></i>Upload
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <h3 class="mb-4">Professional Summary</h3>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form class="d-flex flex-column align-items-center mb-4" action="" method="post" enctype="multipart/form-data">
                                                <textarea class="form-control mb-3" required name="professional_summary" rows="4" placeholder="Professional Summary"><?= $_SESSION['professional_summary']??'' ?></textarea>
                                                <button type="submit" name="update_professional_summary" class="btn btn-primary">
                                                    <i class="fas fa-file me-2"></i>Update
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                                <!-- Resume Templates -->
                                <div class="resume-cards">
                                    <h3 class="text-center mb-4">Select a Resume Template</h3>
                                    <div class="row g-4">
                                        <?php
                                        // Template data
                                        $templates = [
                                            ['id' => 1, 'image' => 'images/templates/template_1.jpg', 'name' => 'Classic Template', 'path' => 'resume_template1.php'],
                                            ['id' => 2, 'image' => 'images/templates/template_2.jpg', 'name' => 'Modern Template', 'path' => 'resume_template2.php'],
                                            ['id' => 3, 'image' => 'images/templates/template_3.jpg', 'name' => 'Professional Template', 'path' => 'resume_template3.php'],
                                        ];

                                        // Render templates
                                        foreach ($templates as $template) {
                                            echo "
                                    <div class='col-lg-4 col-md-6'>
                                        <div class='card h-100 shadow-sm'>
                                            <img src='{$template['image']}' class='card-img-top' alt='{$template['name']}' style='height: 200px; object-fit: cover;'>
                                            <div class='card-body text-center'>
                                                <h5 class='card-title'>{$template['name']}</h5>
                                                <form action='{$template['path']}' method='POST' target='_blank'>
                                                    <input type='hidden' name='template_id' value='{$template['id']}'>
                                                    <button type='submit' class='btn btn-primary w-100 mt-2'>
                                                        <i class='fas fa-eye me-2'></i>View & Download
                                                    </button>
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
                    </div>
                </div>
            </div>
        </section>

    </div>
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

    <?php include_once 'footer.php';

if (isset($_POST['update_resume']) && isset($_FILES['upload_resume'])) {
    // Get the file information
    $file = $_FILES['upload_resume'];

    // File details
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Specify allowed file extensions
    $allowed = array('pdf', 'doc', 'docx', 'txt');

    // Get file extension using pathinfo for better handling
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if the file type is allowed
    if (in_array($fileExt, $allowed)) {
        // Check if there were no errors during upload
        if ($fileError === 0) {
            // Check if the file size is not too large (example: 5MB limit)
            if ($fileSize < 5000000) { // 5MB limit
                // Generate a unique name for the file (to prevent overwriting)
                $newFileName = uniqid('', true) . "." . $fileExt;
                $fileDestination = 'uploads/' . $newFileName; // Save file to the 'uploads' directory

                // Move the uploaded file to the destination
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // File upload was successful. Now update the file path in the database using prepared statements.
                    try {
                        // Use prepared statements to prevent SQL injection
                        $sql = "UPDATE emp_tbl SET resume = :resume WHERE id = :id";
                        $stmt = $conn->prepare($sql);

                        // Get user ID (assuming it's stored in the session)
                        $id = $_SESSION['id'];  // Replace this with your method of retrieving the user ID

                        // Bind the parameters to the statement
                        $stmt->bindParam(':resume', $fileDestination, PDO::PARAM_STR);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                        // Execute the statement
                        if ($stmt->execute()) {
                            echo "<script>alert('Resume updated successfully!');</script>";
                            $_SESSION['resume'] = $fileDestination;
                            echo "<script>window.location.href = 'manage-resume.php';</script>";
                        } else {
                            echo "Error: Could not update the database.";
                        }
                    } catch (PDOException $e) {
                        echo "Error updating database: " . $e->getMessage();
                    }
                } else {
                    echo "There was an error uploading your file.";
                }
            } else {
                echo "Your file is too large. Please upload a file less than 5MB.";
            }
        } else {
            echo "There was an error uploading your file. Error code: " . $fileError;
        }
    } else {
        echo "You cannot upload files of this type. Only PDF, DOC, DOCX, and TXT are allowed.";
    }
}

    if (isset($_POST['update_professional_summary'])) {
        // Get the professional summary text
        $professional_summary = $_POST['professional_summary'];
        $id = $_SESSION['id']; // Assuming the user ID is stored in the session
        
        // Prepare the SQL query for updating the record
        $sql = "UPDATE emp_tbl SET professional_summary = :professional_summary WHERE id = :id";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);
        
        // Bind the parameters to the statement
        $stmt->bindParam(':professional_summary', $professional_summary, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Professional summary updated successfully!');</script>";
            $_SESSION['professional_summary'] = $professional_summary;
            echo "<script>window.location.href = 'manage-resume.php';</script>";
        } else {
            echo "Error updating professional summary: " . $stmt->errorInfo()[2];
        }
    }
    
    ?>
    <!-- Bootstrap JS -->

</body>

</html>