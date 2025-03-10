<?php 
include('../config.php'); 
require '../vendor/autoload.php';
$custom_logo = '../image/logo-01.png'; // Default logo
$subdomain = '';
$primary_color = '#2b88c4';
$secondary_color = '#2b88c4';
// Get the host name from the URL
$host = $_SERVER['HTTP_HOST'];
// Check if this is a subdomain
if (count(explode('.', $host)) > 2) {
    // Extract subdomain from the host
    $subdomain = explode('.', $host)[0];
    // Query to fetch employer details based on subdomain
    $stmt = $conn->prepare("SELECT id, company_logo,primary_color,secondary_color, accent_color,company_name, email, country_code, contact_number FROM employer_tbl WHERE subdomain = ?");
    $stmt->execute([$subdomain]);
    $employer = $stmt->fetch(PDO::FETCH_ASSOC);    
    if ($employer && !empty($employer['company_logo'])) {
        $custom_logo = '../'.$employer['company_logo'];
        $primary_color = $employer['primary_color'];
        $secondary_color = $employer['secondary_color'];
        $accent_color = $employer['accent_color'];
        $company_name = $employer['company_name'];
        // $company_address = $employer['company_address'];
        $company_email = $employer['email'];
        $country_code = $employer['country_code'];
        $contact_number = $employer['contact_number'];
    }
}
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

$imageData = base64_encode(file_get_contents($profile_image));
$imagePath = $profile_image;
$imageType = mime_content_type($imagePath);
$imageBase64 = "data:$imageType;base64,$imageData";

$sql1 = "SELECT * FROM emp_tbl WHERE id = :id";
$stmt1 = $conn->prepare($sql1);
$stmt1->bindValue(':id', $id, PDO::PARAM_INT);
$stmt1->execute();
$emp = $stmt1->fetch(PDO::FETCH_ASSOC);

$professional_summary = $emp['professional_summary'];

$imageData1 = base64_encode(file_get_contents($custom_logo));
$imagePath1 = $custom_logo;
$imageType1 = mime_content_type($imagePath1);
$imageBase641 = "data:$imageType1;base64,$imageData1";
// Default values and database queries remain the same as kenz-resume.php
// ... existing PHP code for fetching data ...

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$applicant['name'].' Resume</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #333;
            line-height: 1.6;
        }

        .resume-header {
            background: linear-gradient(135deg, '.$primary_color.' 0%, '.$secondary_color.' 100%);
            color: white;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 30px;
            position: relative;
            z-index: 1;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            border: 4px solid rgba(255,255,255,0.3);
            object-fit: cover;
        }

        .header-text h1 {
            font-size: 36px;
            margin: 0 0 10px 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .header-text p {
            font-size: 16px;
            margin: 5px 0;
            opacity: 0.9;
        }

        .resume-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            padding: 40px;
            position: relative;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            color: '.$primary_color.';
            font-size: 20px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid '.$secondary_color.';
            position: relative;
        }

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .skill-item {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            border-left: 3px solid '.$primary_color.';
        }

        .skill-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .skill-level {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
        }

        .skill-level-fill {
            height: 100%;
            background: '.$primary_color.';
        }

        .experience-item, .education-item {
            margin-bottom: 20px;
            padding-left: 20px;
            border-left: 2px solid '.$secondary_color.';
            position: relative;
        }

        .experience-item::before, .education-item::before {
            content: "";
            position: absolute;
            left: -6px;
            top: 0;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: '.$secondary_color.';
        }

        .date {
            color: '.$primary_color.';
            font-size: 14px;
            margin-bottom: 5px;
        }

        .company-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
        }

        .company-details h3 {
            color: '.$primary_color.';
            margin-top: 0;
        }
        h3,p{
            margin-bottom: 5px;
            margin-top: 0;
            padding-bottom: 0;
            padding-top: 0;
            margin-top: 0;

        }
        .watermark {
            position: absolute;
            top: 50%;
      left: 55%;
      transform: translate(-50%, -50%);
            opacity: 0.1;
            width: 150px;
        }
            .watermark img {
      width: 260px;
      transform: rotate(-45deg);
    }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="resume-container">
        <header class="resume-header">
            <div class="header-content">
                <img src="'.$imageBase64.'" alt="Profile" class="profile-image">
                <div class="header-text">
                    <h1>'.$applicant['name'].'</h1>
                    <p><strong>Email:</strong> '.$applicant['email'].'</p>
                    <p><strong>Phone:</strong> +'.$applicant['countryCode'].'-'.$applicant['phone'].'</p>
                </div>
            </div>
        </header>

        <div class="resume-grid">
            <div class="left-column">
                <div class="section">
                    <h2 class="section-title">Skills</h2>
                    <div class="skills-grid">';
                    foreach ($skills as $skill) {
                        $skillLevelMap = [
                            'Beginner' => 33,
                            'Intermediate' => 66,
                            'Expert' => 100
                        ];
                        $levelPercentage = $skillLevelMap[$skill['skill_level']] ?? 50;
                        $html .= '
                        <div class="skill-item">
                            <div class="skill-name">'.htmlspecialchars($skill['skill_name']).'</div>
                            <div class="skill-level">
                                <div class="skill-level-fill" style="width: '.$levelPercentage.'%"></div>
                            </div>
                        </div>';
                    }
                    $html .= '
                    </div>
                </div>

                <div class="company-details">
                    <h3>Company Information</h3>
                    <p><strong>'.$company_name.'</strong></p>
                    <p>'.$company_email.'</p>
                    <p>+'.$country_code.'-'.$contact_number.'</p>
                </div>
            </div>

            <div class="right-column">
                <div class="section">
                    <h2 class="section-title">Professional Summary</h2>
                    <p>'.$emp['professional_summary'].'</p>
                </div>

                <div class="section">
                    <h2 class="section-title">Work Experience</h2>';
                    foreach ($experience as $job) {
                        $start_date = (new DateTime($job['start_date']))->format('M Y');
                        $end_date = $job['end_date'] ? (new DateTime($job['end_date']))->format('M Y') : 'Present';
                        $html .= '
                        <div class="experience-item">
                            <div class="date">'.$start_date.' - '.$end_date.'</div>
                            <h3>'.htmlspecialchars($job['job_title']).'</h3>
                            <p>'.htmlspecialchars($job['company_name']).'</p>
                        </div>';
                    }
                    $html .= '
                </div>

                <div class="section">
                    <h2 class="section-title">Education</h2>';
                    foreach ($education as $edu) {
                        $start_date = (new DateTime($edu['start_date']))->format('M Y');
                        $end_date = $edu['end_date'] ? (new DateTime($edu['end_date']))->format('M Y') : 'Present';
                        $html .= '
                        <div class="education-item">
                            <div class="date">'.$start_date.' - '.$end_date.'</div>
                            <h3>'.htmlspecialchars($edu['degree']).'</h3>
                            <p>'.htmlspecialchars($edu['university_name']).'</p>
                        </div>';
                    }
                    $html .= '
                </div>';

                if (count($certificates) > 0) {
                    $html .= '
                    <div class="section">
                        <h2 class="section-title">Certifications</h2>';
                        foreach ($certificates as $cert) {
                            $html .= '
                            <div class="education-item">
                                <div class="date">'.date('M Y', strtotime($cert['issue_date'])).'</div>
                                <h3>'.htmlspecialchars($cert['certificate_name']).'</h3>
                                <p>'.htmlspecialchars($cert['issued_by']).'</p>
                            </div>';
                        }
                        $html .= '
                    </div>';
                }
                $html .= '
            </div>
        </div>
        <img src="'.$imageBase641.'" alt="watermark" class="watermark">
    </div>
</body>
</html>';

if(isset($_POST['download_resume'])) {
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    $fileName = "resume_ki_" . $applicant['name'] .'_'.time(). ".pdf";
    $dompdf->stream($fileName, ["Attachment" => 1]);
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ki Resume Template</title>
        <style>
            body {
                background-color: #f5f5f5;
                padding: 50px;
            }
            #container {
                width: 50%;
                margin: 0 auto;
                background: white;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
            }
            .download-btn {
                text-align: center;
                margin: 20px 0;
            }
            .download-btn button {
                background-color: <?php echo $primary_color; ?>;
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: opacity 0.3s;
            }
            .download-btn button:hover {
                opacity: 0.9;
            }
            @media (max-width: 768px) {
                body {
                    padding: 20px;
                }
                #container {
                    width: 95%;
                }
            }
        </style>
    </head>
    <body>
        <div id="container">
            <?php echo $html; ?>
            <div class="download-btn">
                <form method="post" action="">
                    <button type="submit" name="download_resume">Download Resume</button>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?> 