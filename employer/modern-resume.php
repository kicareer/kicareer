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
            line-height: 1.6;
            color: #2c3e50;
        }
        
        .resume-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 300px;
            background: '.$primary_color.';
            color: white;
            padding: 40px 20px;
            position: relative;
        }
        
        .main-content {
            flex: 1;
            padding: 40px;
            background: #fff;
            position: relative;
        }
        
        .profile-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            margin-bottom: 20px;
            object-fit: cover;
        }
        
        .name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .contact-info {
            margin-top: 30px;
            padding: 0 15px;
        }
        
        .contact-item {
            margin-bottom: 15px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 20px;
            color: '.$primary_color.';
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: '.$secondary_color.';
        }
        
        .skills-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .skill-item {
            margin-bottom: 15px;
        }
        
        .skill-name {
            color: white;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .skill-bar {
            height: 4px;
            background: rgba(255,255,255,0.2);
            border-radius: 2px;
            overflow: hidden;
        }
        
        .skill-level {
            height: 100%;
            background: white;
        }
        
        .experience-item {
            margin-bottom: 25px;
            position: relative;
            padding-left: 20px;
        }
        
        .experience-item::before {
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: '.$secondary_color.';
        }
        
        .experience-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 5px;
            color: #2c3e50;
        }
        
        .experience-company {
            font-size: 14px;
            color: '.$primary_color.';
            margin-bottom: 8px;
        }
        
        .experience-date {
            font-size: 13px;
            color: #666;
        }
        
        .education-item {
            margin-bottom: 20px;
        }
        
        .watermark {
            position: absolute;
            bottom: 20px;
            right: 20px;
            opacity: 0.1;
            width: 100px;
        }
        
        .company-details {
            margin-top: auto;
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 8px;
            font-size: 13px;
        }
        
        .company-details p {
            margin: 5px 0;
        }
        
        @media print {
            .resume-wrapper {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="resume-wrapper">
        <div class="sidebar">
            <div class="profile-section">
                <img src="'.$imageBase64.'" alt="Profile" class="profile-image">
                <div class="name">'.$applicant['name'].'</div>
            </div>
            
            <div class="section">
                <h3 style="color: white; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px;">Skills</h3>
                <ul class="skills-list">';
                foreach ($skills as $skill) {
                    $skillLevelMap = [
                        'Beginner' => 33,
                        'Intermediate' => 66,
                        'Expert' => 100
                    ];
                    $levelPercentage = $skillLevelMap[$skill['skill_level']] ?? 50;
                    $html .= '
                    <li class="skill-item">
                        <div class="skill-name">'.htmlspecialchars($skill['skill_name']).'</div>
                        <div class="skill-bar">
                            <div class="skill-level" style="width: '.$levelPercentage.'%"></div>
                        </div>
                    </li>';
                }
                $html .= '
                </ul>
            </div>
            
            <div class="company-details">
                <h3 style="color: white; margin-bottom: 15px;">Company Details</h3>
                <p>'.$company_name.'</p>
                <p>'.$company_email.'</p>
                <p>+'.$country_code.'-'.$contact_number.'</p>
            </div>
        </div>
        
        <div class="main-content">
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
                        <div class="experience-title">'.htmlspecialchars($job['job_title']).'</div>
                        <div class="experience-company">'.htmlspecialchars($job['company_name']).'</div>
                        <div class="experience-date">'.$start_date.' - '.$end_date.'</div>
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
                        <div class="experience-title">'.htmlspecialchars($edu['degree']).'</div>
                        <div class="experience-company">'.htmlspecialchars($edu['university_name']).'</div>
                        <div class="experience-date">'.$start_date.' - '.$end_date.'</div>
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
                            <div class="experience-title">'.htmlspecialchars($cert['certificate_name']).'</div>
                            <div class="experience-company">'.htmlspecialchars($cert['issued_by']).'</div>
                            <div class="experience-date">'.date('M Y', strtotime($cert['issue_date'])).'</div>
                        </div>';
                    }
                    $html .= '
                </div>';
            }
            
            $html .= '
            <img src="'.$imageBase641.'" alt="watermark" class="watermark">
        </div>
    </div>
</body>
</html>'; 