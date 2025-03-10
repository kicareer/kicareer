<?php
session_start();
require '../vendor/autoload.php';
include('../classes/posts.php');

use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // For loading external assets
$dompdf = new Dompdf($options);

// Database Connection (Ensure `$conn` is properly initialized)
if (!isset($conn)) {
    echo "Database connection not set.";
    exit();
}

// Validate and fetch post ID
if (!isset($_GET['postid']) || empty($_GET['postid'])) {
    echo "No post ID provided.";
    exit();
}
$postid = $_GET['postid'];

// Fetch data based on applicant's ID
$sql = "SELECT * FROM job_applications WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $postid, PDO::PARAM_INT);
$stmt->execute();
$applicant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$applicant) {
    echo "No data found for the given ID.";
    exit();
}

// Path to the logo
$imagePath = '../'.$_SESSION['company_logo'];
if (!file_exists($imagePath)) {
    echo "Error: Image file not found.";
    exit();
}

$profile_path = '../'.$applicant['profile_image'];
$imageData1 = base64_encode(file_get_contents($profile_path));
$imageType1 = mime_content_type($profile_path);
$profileBase64 = "data:$imageType1;base64,$imageData1";
// Convert image to Base64
$imageData = base64_encode(file_get_contents($imagePath));
$imageType = mime_content_type($imagePath);
$imageBase64 = "data:$imageType;base64,$imageData";

// Generate dynamic HTML content for the resume
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            position: relative;
            background-color: #f8f9fa;
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }
         .header .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
            border: 2px solid #ddd;
        }
        .header .logo {
            width: 100px;
            height: auto;
            margin-left: 450px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .content {
            padding: 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            background-color: #0089BA;
            padding: 5px 10px;
            border-left: 5px solid #0089BA;
            color: #fff;
            margin: 0;
            font-size: 16px;
        }
        .info p {
            margin: 5px 0;
        }
        .skills, .projects, .experience, .education {
            margin-left: 20px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-20%, -80%);
            opacity: 0.3;
            z-index: -1;
            width: 400px;
            height: auto;
        }
             ul li{
                font-size: 14px;
            }
    </style>
</head>
<body>
    <!-- Header Section -->
   
    <!-- Content Section -->
    <div class="content">
     <div class="section">
    <h2 style="text-align: center;">'.$applicant['name'].'-'.$applicant['apply_position'].'</h2>
    </div>
     <div class="header">
      <div class="watermark">
        <img src="'.$imageBase64.'" alt="Logo">
    </div>  
        <!-- Profile Picture -->
        <img src="'.$profileBase64.'" alt="Profile Picture" class="profile-pic">
        
        <!-- Applicant Name -->
    

        <!-- Company Logo -->
        <img src="'.$imageBase64.'" alt="Company Logo" class="logo">
    </div>

        <!-- Personal Information -->
      
        <!-- Certificates -->
        <div class="section">
            <h2>Certifications</h2>
            <ul class="experience">
                ';
foreach (json_decode($applicant['certifications'], true) as $certificate) {
    $html .= '<li><strong>' . $certificate[0] . ':</strong> ' . $certificate[1] . '</li>';
}
$html .= '
            </ul>
        </div>


         <!-- Work Experience -->
        <div class="section">
            <h2>Work Experience</h2>
            <ul class="experience">
                ';
foreach (json_decode($applicant['previous_experience'], true) as $experience) {
    $html .= '<li><strong>' . $experience[0] . ':</strong> ' . $experience[1] . '</li>';
}
$html .= '
            </ul>
        </div>

        <!-- Skills -->
        <div class="section">
            <h2>Skills</h2>
            <ul class="skills">
               ';
foreach (json_decode($applicant['skills'], true) as $skill) {
    $html .= '<li><strong>' . $skill[0] . ':</strong> ' . $skill[1] . '</li>';
}
$html .= '
                </ul>
            </div>
       

        <!-- Projects -->
        <div class="section">
            <h2>Projects</h2>
            <ul class="projects">
';
foreach (json_decode($applicant['projects'], true) as $project) {
    $html .= '<li><strong>' . $project[0] . ':</strong> ' . $project[1] . '</li>';
}
$html .= '
            </ul>
        </div>

        <!-- Education -->
        <div class="section">
            <h2>Education</h2>
            <ul class="education">
';
foreach (json_decode($applicant['education'], true) as $education) {
    $html .= '<li><strong>' . $education[0] . ':</strong> ' . $education[1] . ' (' . $education[2] . ')</li>';
}
$html .= '
            </ul>
        </div>
    </div>
     </div>
<br />
     <a href="generate_resume.php?post_id='.$postid.'" target="_blank" style="position: relative; margin-top: 20px; background-color: #007BFF; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;"> Download Resume</a>

</body>
</html>
';


echo $html;
exit;
// Load HTML into DOMPDF
$dompdf->loadHtml($html);

// Setup paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the PDF
$dompdf->render();

// Set file name
$fileName = "resume_" . $applicant['name'] . ".pdf";

// Force download of the PDF
$dompdf->stream($fileName, ["Attachment" => 1]);
?>
