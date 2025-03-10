<?php 
include('../config.php'); 
// if(!isset($_SESSION['id'])){ 
//     header('Location: login.php'); 
//     exit; 
// }
require '../vendor/autoload.php';
// include('classes/posts.php');

use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // For loading external assets
$dompdf = new Dompdf($options);

 $id  = $_GET['uid'];

// Fetching the data for skills
$stmt = $conn->prepare("SELECT * FROM employee_skills_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($skills);
// exit;
// Fetching the data for education
$stmt = $conn->prepare("SELECT * FROM education_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$education = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetching the data for projects
$stmt = $conn->prepare("SELECT * FROM projects_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetching the data for certificates
$stmt = $conn->prepare("SELECT * FROM certificates_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$certificates = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetching the data for work experience
$stmt = $conn->prepare("SELECT * FROM experience_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$experience = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($experience);
// exit;
$sql = "SELECT * FROM job_applications WHERE applied_id = :applied_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':applied_id', $id, PDO::PARAM_INT);
$stmt->execute();
$applicant = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($applicant);
// exit;
$email = $applicant['email'];
$contact_number = $applicant['phone'];
$country_code = $applicant['countryCode'];
$name = $applicant['name'];
$profile_image = '../'.$applicant['profile_image'];

if (file_exists($profile_image)) {
    $imagePath = $profile_image;
} else {
    $imagePath = 'default.png';
}

$imageData = base64_encode(file_get_contents($imagePath));
$imageType = mime_content_type($imagePath);
$imageBase64 = "data:$imageType;base64,$imageData";

$sql1 = "SELECT * FROM emp_tbl WHERE id = :id";
$stmt1 = $conn->prepare($sql1);
$stmt1->bindValue(':id', $id, PDO::PARAM_INT);
$stmt1->execute();
$emp = $stmt1->fetch(PDO::FETCH_ASSOC);

$professional_summary = $emp['professional_summary'];

$imageData1 = base64_encode(file_get_contents('../image/logo-01.png'));
$imagePath1 = '../image/logo-01.png';
$imageType1 = mime_content_type($imagePath1);
$imageBase641 = "data:$imageType1;base64,$imageData1";
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>'.$applicant['name'].' Resume</title>
 <style>
 @page {
  margin: 0; /* Remove all page margins */
  padding: 0; /* Optional */
}
  .watermark {
      position: absolute;
      top: 50%;
      left: 55%;
      transform: translate(-50%, -50%);
      font-size: 70px;
      color: rgba(0, 0, 0, 0.1);
      font-weight: bold;
      z-index: 100;
      opacity: 0.1; /* Dim the watermark slightly */
    }

     .watermark img {
      width: 260px;
      transform: rotate(-45deg);
    }
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  background-color: #fff; /* Set white background */
  color: #333;
}

.resume {
  display: table; /* Use table layout */
  width: 100%;
  height: 100%;
  border: none; /* Remove any borders */
}

.left-section {
  background-color: #2b88c4;
  color: #fff;
  display: table-cell; /* Ensure proper column structure */
  width: 30%;
  padding: 10px; /* Minimal padding */
  text-align: center;
  vertical-align: top;
}

.left-section .profile-picture img {
  width: 120px;
  height: 120px;
  border-radius: 50%; /* Rounded corners */
  object-fit: cover;
  margin-bottom: 10px; /* Reduced margin */
  border: 3px solid #fff;
}

.left-section .name {
  font-size: 18px;
  margin: 0;
}

.left-section .contact h2 {

  font-size: 16px;
  margin-bottom: 5px; /* Minimal margin */
}

.left-section .contact p {

  margin: 3px 0;
  font-size: 12px;
}

.right-section {
  background-color: #fff;
  display: table-cell;
  width: 70%;
  padding: 10px; /* Minimal padding */
  vertical-align: top;
}
p{
  font-size: 15px;
  padding: 0px 20px; /* Minimal padding */
  margin-bottom:0;
  margin-top:0;
}
.right-section h2 {
  color: #2c3e50;
  margin-bottom: 5px;
  border-bottom: 1px solid #2c3e50;
  padding-bottom: 2px;
}

.right-section .job, .right-section .education {
  margin-bottom: 10px;
}
  .right-section p {
  text-align: justify;
}

.right-section .company {
  font-style: italic;
 
}
.skills-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
.skills-list li {
  display: inline-block;
  margin-right: 5px;
  margin-bottom: 5px;
  padding: 5px 10px;
  background-color: #2b88c4;
  color: #fff;
  border-radius: 3px;
  font-size: 12px;
  text-align: center;
}
  h3 {
  padding-left: 10px;
  margin: 10px 0;
  }
 h4{
 margin: 5px 0;
  padding-left: 20px;
  text-transform: capitalize;
 }

footer p{
  font-size: 12px;
  text-align: right !important;
}
  footer a {
  color: teal !important;
  text-decoration: none;
}
 </style>
</head>
<body>
<div class="watermark"><img src="' . $imageBase641 . '" height="150px" alt="logo"></div>
  <div class="resume">
    <!-- Left Section -->
    <aside class="left-section">
      <div class="profile-picture">
        <img src="' . $imageBase64 . '" alt="Profile Picture">
      </div>
      <h1 class="name">' . $applicant['name'] . '</h1>
      <div class="contact">
        <h3>Contact</h3>
        <p>Email: ' . $applicant['email'] . '</p>
        <p>Phone: +' . $applicant['countryCode'] . ' ' . $applicant['phone'] . '</p>
      </div>
      <section class="skills">
        <h3>Skills</h3>
        <ul class="skills-list">';

foreach ($skills as $skill) {
    $skillLevelMap = [
        'Beginner' => 33,
        'Intermediate' => 66,
        'Expert' => 100
    ];
    $levelPercentage = $skillLevelMap[$skill['skill_level']] ?? 50;
    $html .= '<li style="background-color: #2b88c4; color: #fff; text-align: left; display: flex; align-items: center; gap: 8px;">
        <span style="min-width: 80px;">' . htmlspecialchars($skill['skill_name']) . '</span>
        <div class="skill-bar" style="flex-grow: 1; height: 4px; background: rgba(255,255,255,0.2);">
            <div style="width: ' . $levelPercentage . '%; height: 100%; background: #fff;"></div>
        </div>
    </li>';
}

$html .= '</ul>
      </section>
    </aside>

    <!-- Right Section -->
    <main class="right-section">
      <section class="summary">
        <h3>Professional Summary</h3>
        <p>' . $professional_summary . '</p>
      </section>
      
      <!-- Work Experience -->
      <section class="experience">
        <h3>Work Experience</h3>';

foreach ($experience as $job) {
    $start_date = (new DateTime($job['start_date']))->format('M Y');
    $end_date = $job['end_date'] ? (new DateTime($job['end_date']))->format('M Y') : 'Till Date';

    $html .= '<div class="job">
          <h4>' . htmlspecialchars($job['job_title']) . '</h4>
          <p class="company">' . htmlspecialchars($job['company_name']) . ' | ' . htmlspecialchars($start_date) . ' - ' . htmlspecialchars($end_date) . '</p>
        </div>';
}

$html .= '</section>
      <!-- Education -->
      <section class="education">
        <h3>Education</h3>';

if (count($education) > 0) {
    foreach ($education as $edu) {
        $start_date = (new DateTime($edu['start_date']))->format('M Y');
        $end_date = $edu['end_date'] ? (new DateTime($edu['end_date']))->format('M Y') : 'Till Date';

        $html .= '<p><strong>' . htmlspecialchars($edu['degree']) . '</strong> from ' . htmlspecialchars($edu['university_name']) . ', ' . htmlspecialchars($start_date) . ' - ' . htmlspecialchars($end_date) . '</p>';
    }
} else {
    $html .= '<p>No education information available.</p>';
}

$html .= '</section>
      <!-- Projects -->
      <section class="projects">
        <h3>Projects</h3>';

if (count($projects) > 0) {
    foreach ($projects as $project) {
        $html .= '<div class="project">
            <h4>' . htmlspecialchars($project['project_name']) . '</h4>
            <p class="project-description">' . htmlspecialchars($project['description']) . '</p>
          </div>';
    }
} else {
    $html .= '<p>No project information available.</p>';
}

$html .= '</section>';

if (count($certificates) > 0) {
    $html .= '<!-- Certificates -->
      <section class="certificates">
        <h3>Certificates</h3>';
    foreach ($certificates as $certificate) {
        $html .= '<div class="certificate">
            <h4>' . htmlspecialchars($certificate['certificate_name']) . '</h4>
            <p>Issued by: ' . htmlspecialchars($certificate['issued_by']) . '</p>
            <p>Issued on: ' . htmlspecialchars(date_format(date_create($certificate['issue_date']), 'M d, Y')) . '</p>
          </div>';
    }
}

$html .= '</section>
<hr />
      <!-- copyright -->
      <footer>
        <p><em>Copyright &copy; '.date("Y").' Powered by <a href="https://www.ki-careers.com/" target="_blank">Ki-Careers </a></em></p>
      </footer>
    </main>
  </div>
</body>
</html>';
?>


<?php 
if(isset($_POST['download_resume'])){
 // Load HTML content
$dompdf->loadHtml($html);

// Set paper size and margins
$dompdf->setPaper('A4', 'portrait'); // A4 paper in portrait orientation
// Render the PDF
$dompdf->render();

// Set file name
$fileName = "resume_" . $name .'_'.time(). ".pdf";

// Force download of the PDF
$dompdf->stream($fileName, ["Attachment" => 1]);
   

}
else{
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resume Template</title>
</head>
<body style="background-color: #f5f5f5; padding: 50px;">
 <div id="container" style="width: 50%; margin: 0 auto;">
  <?php
  echo $html;

  ?>
   <form method="post" action="" style="text-align: center;">
    <button type="submit" name="download_resume" class="btn btn-primary" style="background-color: #2b88c4; padding: 10px 20px; margin-top: 20px; border-radius: 5px; font-size: 16px; border: none; color: #fff;">Download Resume</button>
  </form>
  </div>
 </body>
</html>
  <?php
 
}

?>
