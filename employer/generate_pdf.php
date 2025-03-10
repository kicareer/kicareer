<?php
require '../vendor/autoload.php'; // Include dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set("isHtml5ParserEnabled", true);
$options->set("isPhpEnabled", true);
$options->set('isCssFloatEnabled', true);

$dompdf = new Dompdf($options);

// Assuming $applicant contains dynamic data for the applicant
$applicant = [
    'name' => 'John Doe',
    'apply_position' => 'Software Engineer',
    'experience' => 5,
    'current_emp' => 'TechCorp Ltd.',
    'certifications' => json_encode([['Java Certified'], ['Python Specialist']]),
    'skills' => json_encode([['Java', 'Expert'], ['PHP', 'Intermediate']]),
    'education' => json_encode([['BSc Computer Science', 'Tech University', '2018']]),
    'projects' => json_encode([['Project 1', 'Web App Development'], ['Project 2', 'Mobile App']]),
    'previous_experience' => json_encode([['Company A', 'Developer', '2 years'], ['Company B', 'Software Engineer', '3 years']]),
    'imageBase64' => 'data:image/png;base64,...', // Base64 encoded profile picture
    'imageBase641' => 'data:image/png;base64,...', // Base64 encoded profile picture
    'logoBase64' => 'data:image/png;base64,...' // Base64 encoded company logo
];

$html = '
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #myDiv {
            margin: 0 auto;
            width: 297mm;
            padding: 10px 0;
            position: relative;
            max-height: 3150px;
        }

        /* Background watermark logo */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 48px;
            color: #cccccc;
            z-index: -1;
            opacity: 0.1;
            pointer-events: none;
        }

        .profile-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .profile-container img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }

        .header {
            width: 100%;
            background: #0089BA;
            padding: 10px 0;
            color: white;
            font-size: 18px;
            text-align: center;
            position: relative;
        }

        .header img {
            height: 100px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .content {
            display: flex;
            justify-content: space-between;
        }

        .left-column,
        .right-column {
            width: 48%;
        }

        .section-title {
            width: 100%;
            padding: 4px 0;
            background: #1296cf;
            margin-top: 10px;
            color: white;
            font-size: 14px;
        }

        .content-item {
            margin: 5px 0;
            font-size: 13px;
        }

        .content-item ul {
            margin: 0;
            padding: 0;
           
            margin-left: 12px;
        }

        .content-item li {
            font-size: 13px;
        }

        .profile-summary {
            font-size: 14px;
            color: #000;
        }
    </style>
</head>
<body>
    <div id="myDiv">
        <!-- Background watermark logo -->
        <div class="watermark">
           
        </div>

        <!-- Main content area with border -->
        <div style="border: 1px solid #1296CF; height: 100%;">

            <!-- Header with name and position -->
            <div class="header">
              
                <b>' . htmlspecialchars($applicant['name']) . '</b> - 
                <span style="font-size:16px">' . htmlspecialchars($applicant['apply_position']) . '</span>
            </div>

            <div class="content">
                <div class="left-column">
                    <!-- Profile Photo -->
                    <div class="profile-container">
                        <div>
                          
                        </div>
                    </div>

                    <!-- Certifications -->
                    <div class="section-title">Certifications</div>
                    <div class="content-item">';
                        $certifications = json_decode($applicant['certifications'], true);
                        if (is_array($certifications)) {
                            echo '<ul>';
                            foreach ($certifications as $cert) {
                                echo '<li>' . htmlspecialchars($cert[0]) . '</li>';
                            }
                            echo '</ul>';
                        }
                    echo '</div>

                    <!-- Skills -->
                    <div class="section-title">Skills & Competencies</div>
                    <div class="content-item">';
                        $skills = json_decode($applicant['skills'], true);
                        if (is_array($skills)) {
                            echo '<ul>';
                            foreach ($skills as $skill) {
                                echo '<li>' . htmlspecialchars($skill[0]) . ' - ' . htmlspecialchars($skill[1]) . '</li>';
                            }
                            echo '</ul>';
                        }
                    echo '</div>

                    <!-- Education -->
                    <div class="section-title">Education</div>
                    <div class="content-item">';
                        $education = json_decode($applicant['education'], true);
                        if (is_array($education)) {
                            echo '<ul>';
                            foreach ($education as $edu) {
                                echo '<li>' . htmlspecialchars($edu[0]) . ' - ' . htmlspecialchars($edu[1]) . ' (' . htmlspecialchars($edu[2]) . ')</li>';
                            }
                            echo '</ul>';
                        }
                    echo '</div>
                </div>

                <!-- Right side of the resume -->
                <div class="right-column">
                    <div class="section-title">Executive Profile</div>
                    <p class="profile-summary">
                        <b>' . htmlspecialchars($applicant['name']) . '</b> has an experience of ' . htmlspecialchars($applicant['experience']) . ' years.
                    </p>
                    <p class="profile-summary" style="font-weight: bold;">
                        Currently working at ' . htmlspecialchars($applicant['current_emp']) . '
                    </p>

                    <!-- Projects -->
                    <div class="section-title">Projects</div>
                    <div class="content-item">';
                        $projects = json_decode($applicant['projects'], true);
                        if (is_array($projects)) {
                            echo '<ul>';
                            foreach ($projects as $project) {
                                echo '<li>' . htmlspecialchars($project[0]) . ' - ' . htmlspecialchars($project[1]) . '</li>';
                            }
                            echo '</ul>';
                        }
                    echo '</div>

                    <!-- Previous Experience -->
                    <div class="section-title">Previous Experience</div>
                    <div class="content-item">';
                        $previous_experience = json_decode($applicant['previous_experience'], true);
                        if (is_array($previous_experience)) {
                            echo '<ul>';
                            foreach ($previous_experience as $exp) {
                                echo '<li>' . htmlspecialchars($exp[0]) . ' - ' . htmlspecialchars($exp[1]) . ' (' . htmlspecialchars($exp[2]) . ')</li>';
                            }
                            echo '</ul>';
                        }
                    echo '</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

// Render the PDF (first pass)
$dompdf->render();

// Output the PDF to the browser
$dompdf->stream("resume.pdf", array("Attachment" => 0));
?>
