<?php 
include('config.php'); 
if(!isset($_SESSION['id'])){ 
    header('Location: login.php'); 
    exit; 
}
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
// Initialize DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // For loading external assets (CSS, images, etc.)
$dompdf = new Dompdf($options);

$id = $_SESSION['id'];

// Fetching the data from the database
$stmt = $conn->prepare("SELECT * FROM employee_skills_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM education_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$education = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM projects_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM certificates_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$certificates = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM experience_tbl WHERE emp_id = :emp_id");
$stmt->bindValue(':emp_id', $id, PDO::PARAM_INT);
$stmt->execute();
$experience = $stmt->fetchAll(PDO::FETCH_ASSOC);

$email = $_SESSION['email'];
$contact_number = $_SESSION['contact_number'];
$country_code = $_SESSION['country_code'];
$name = $_SESSION['name'];

// Profile image
$imageData = base64_encode(file_get_contents($_SESSION['profile_image']));
$imagePath = $_SESSION['profile_image'];
$imageType = mime_content_type($imagePath);
$imageBase64 = "data:$imageType;base64,$imageData";

// Company logo
$imageData1 = base64_encode(file_get_contents('image/logo-01.png'));
$imagePath1 = 'image/logo-01.png';
$imageType1 = mime_content_type($imagePath1);
$imageBase641 = "data:$imageType1;base64,$imageData1";
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>' . $_SESSION['name'] . ' Resume</title>
<style>
  @page {
    margin: 0; /* Remove all page margins */
    padding: 0; /* Optional */
  }
*{
  margin: 0; /* Remove all page margins */
  padding: 0; /* Optional */
}
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
  }

  .watermark {
    position: absolute;
    top: 50%;
    left: 50%;
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

  .resume {
    display: table; /* Use table layout */
    width: 96%;
    margin: 0 auto;
    padding: 2%;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  header {
    display: table; /* Mimic flex using table */
    width: 100%;
    margin-bottom: 20px;
  }

  .profile-picture {
    display: table-cell; /* Mimic flex item with table-cell */
    vertical-align: middle;
    width: 150px; /* Fixed width for image container */
  }

  .profile-picture img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #2c3e50;
    display: block; /* Ensure proper centering inside table-cell */
    margin: 0 auto;
  }

  .header-details {
    display: table-cell; /* Mimic flex item with table-cell */
    vertical-align: middle;
    padding-left: 20px;
  }

  .name {
    font-size: 2rem;
    margin: 0;
  }

  .contact {
    font-size: 0.9rem;
    color: #555;
  }

  section {
    margin-bottom: 10px;
  }

  h2 {
    color: #2c3e50;
    border-bottom: 2px solid #2c3e50;
    padding-bottom: 5px;
    margin-bottom: 10px;
  }
    h3,p,h4 {
    margin: 2px 0;;
    color: #2c3e50;
  }

  .job, .education {
    margin-bottom: 10px;
  }

  .company {
    font-style: italic;
    color: #666;
  }

  ul {
    margin: 10px 0;
    padding-left: 20px;
  }

  .skills-list {
    display: inline-block; /* Alternative for flex-wrap */
    width: 100%; /* Ensure full width */
    list-style-type: none;
    padding: 0;
  }

  .skills-list li {
    display: inline-block; /* Inline block to mimic flex wrapping */
    background: #e7f5ff;
    color: #0077b6;
    padding: 5px 10px;
    margin: 5px;
    border-radius: 5px;
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
    <header>
      <div class="profile-picture">
        <img src="' . $imageBase64 . '" alt="Profile Picture">
      </div>
      <div class="header-details">
        <h1 class="name">' . $_SESSION['name'] . '</h1>
        <p class="contact">
          Email: ' . $_SESSION['email'] . ' | Phone: +' . $_SESSION['country_code'] . ' ' . $_SESSION['contact_number'] . '<br>
        </p>
      </div>
    </header>

    <section class="summary">
      <h2>Professional Summary</h2>
      <p style="text-align: justify;">' . htmlspecialchars($_SESSION['professional_summary']) . '</p>
    </section>

    <section class="experience">
      <h2>Work Experience</h2>';
      
foreach ($experience as $job) {
    $start_date = (new DateTime($job['start_date']))->format('M Y');
    $end_date = $job['end_date'] ? (new DateTime($job['end_date']))->format('M Y') : 'Till Date';

    $html .= '<div class="job">
      <h3>' . htmlspecialchars($job['job_title']) . '</h3>
      <p class="company">' . htmlspecialchars($job['company_name']) . ' | ' . $start_date . ' - ' . $end_date . '</p>';
    
    $html .= '</div>';
}

$html .= '</section>

    <section class="education">
      <h2>Education</h2>';
if (count($education) > 0) {
    foreach ($education as $edu) {
        $start_date = (new DateTime($edu['start_date']))->format('M Y');
        $end_date = $edu['end_date'] ? (new DateTime($edu['end_date']))->format('M Y') : 'Till Date';
        $html .= '<p><strong>' . htmlspecialchars($edu['degree']) . '</strong><br>' . htmlspecialchars($edu['university_name']) . ', ' . $start_date . ' - ' . $end_date . '</p>';
    }
} else {
    $html .= '<p>No education information available.</p>';
}

$html .= '</section>

    <section class="skills">
      <h2>Skills</h2>
      <ul class="skills-list">';
foreach ($skills as $skill) {
    $html .= '<li>' . htmlspecialchars($skill['skill_name']) . '</li>';
}
$html .= '</ul>';

$html .= '</section>';

if (count($certificates) > 0) {
    $html .= '<!-- Certificates -->
      <section class="certificates">
        <h2>Certificates</h2>';
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

  </div>
</body>
</html>';

if(isset($_POST['download_resume'])) {
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
} else {
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resume Template</title>
</head>
<body style="background-color: #f5f5f5; padding: 0 50px;">
 <div id="container" style="width: 50%; margin: 0 auto; padding: 0 1%">
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
