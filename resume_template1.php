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
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$id = $_SESSION['id'];
$name = $_SESSION['name'];
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

// Company logo
$imageData1 = base64_encode(file_get_contents('image/logo-01.png'));
$imagePath1 = 'image/logo-01.png';
$imageType1 = mime_content_type($imagePath1);
$imageBase641 = "data:$imageType1;base64,$imageData1";

$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>' . htmlspecialchars($_SESSION['name']) . ' Resume</title>
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
    background-color: #f4f4f9;
    color: #333;
  }
  
  .resume {
    width: 96%;
    background: #fff;
    padding: 2%;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  header {
    text-align: center;
    margin-bottom: 20px;
  }
  
  .name {
    font-size: 2rem;
    margin: 0;
  }
  
  .contact {
    font-size: 0.9rem;
    color: #555;
  }
    p.contact{
      text-align: center;
    }
  
  section {
    margin-bottom: 20px;
  }
  
  h2 {
    color: #2c3e50;
    border-bottom: 2px solid #2c3e50;
    padding-bottom: 5px;
    margin-bottom: 10px;
  }
  h3,p,h4 {
    margin: 2px 0;
    line-height: 1.2;
    color: #2c3e50;
  }
    p{
      text-align: justify;
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
    padding-left: 0px;
    list-style-type: none;
  }
h2,h3,h4 {
  text-transform: capitalize;
}
  .skills-list {
  list-style-type: none;
  padding: 10px 0;  
  margin: 0;
}

.skills-list li {
  display: inline-block;
  background: #e7f5ff;
  color: #0077b6;
  padding: 5px 10px;
  margin: 5px 5px 0 0;
  border-radius: 5px;
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
      <h1 class="name">' . htmlspecialchars($_SESSION['name']) . '</h1>
      <p class="contact">
        Email: ' . htmlspecialchars($_SESSION['email']) . ' | Phone: +' . htmlspecialchars($_SESSION['country_code']) . ' ' . htmlspecialchars($_SESSION['contact_number']) . '<br>
      </p>
    </header>
    <section class="summary">
      <h2>Professional Summary</h2>
      <p>' . htmlspecialchars($_SESSION['professional_summary']) . '</p>
    </section>
    <section class="experience">
      <h2>Work Experience</h2>';

foreach ($experience as $job) {
    $start_date = (new DateTime($job['start_date']))->format('M Y');
    $end_date = $job['end_date'] ? (new DateTime($job['end_date']))->format('M Y') : 'Till Date';

  

    $html .= '<div class="job">
        <h3>' . htmlspecialchars($job['job_title']) . '</h3>
        <p class="company">' . htmlspecialchars($job['company_name']) . ' | ' . $start_date . ' - ' . $end_date . '</p>
        <ul>';

    // Add job responsibilities or description if available
    $descriptions = explode("\n", $job['description']);
    foreach ($descriptions as $desc) {
        $html .= '<li>' . htmlspecialchars($desc) . '</li>';
    }

    $html .= '</ul>
      </div>';
}

$html .= '</section>
    <section class="education">
      <h2>Education</h2>';
if (count($education) > 0) {
    foreach ($education as $edu) {
        $start_date = (new DateTime($edu['start_date']))->format('M Y');
        $end_date = $edu['end_date'] ? (new DateTime($edu['end_date']))->format('M Y') : 'Till Date';
        $html .= '<p>
          <strong>' . htmlspecialchars($edu['degree']) . ' </strong>  from
          ' . htmlspecialchars($edu['university_name']) . ', ' . $start_date . ' - ' . $end_date . '
        </p>';
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
$html .= '</ul>
    </section>
    <section class="certifications">
      <h2>Certifications</h2>';
if (count($certificates) > 0) {
    foreach ($certificates as $cert) {
        $issue_date = (new DateTime($cert['issue_date']))->format('M Y');
        $html .= '<p style="line-height: 1.5;">
          <strong>' . htmlspecialchars($cert['certificate_name']) . '</strong><br>
          Issued by: ' . htmlspecialchars($cert['issued_by']) . ' (' . $issue_date . ')
        </p>';
    }
} else {
    $html .= '<p>No certifications available.</p>';
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
