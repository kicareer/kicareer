<?php

require_once('../config.php');
require_once('../classes/db.php');

// Get job ID from query parameter
$job_id = $_GET['id'] ?? null;
if (!$job_id) {
    die('Job ID not provided');
}

// Fetch job details
$query = "SELECT j.*, e.company_logo, e.company_name, e.subdomain, e.email 
          FROM post j 
          LEFT JOIN employer_tbl e ON j.employer_id = e.id 
          WHERE j.sno = :job_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':job_id', $job_id);
$stmt->execute();

$job = $stmt->fetch(PDO::FETCH_ASSOC);
$subdomain = $job['subdomain'];
$email = $job['email'];
// Function to wrap text
function wrapText($image, $font, $text, $size, $color, $x, $max_width, $line_height) {
    $words = explode(' ', $text);
    $lines = [];
    $current_line = '';
    
    foreach ($words as $word) {
        $test_line = $current_line . ($current_line ? ' ' : '') . $word;
        $bbox = imagettfbbox($size, 0, $font, $test_line);
        $text_width = $bbox[2] - $bbox[0];
        
        if ($text_width > $max_width && $current_line != '') {
            $lines[] = $current_line;
            $current_line = $word;
        } else {
            $current_line = $test_line;
        }
    }
    if ($current_line) {
        $lines[] = $current_line;
    }
    
    return $lines;
}

// Default values
$title = $job['job_title'] ?? 'Job Title';
$company_name = $job['company_name'] ?? 'Company Name';
$location = "Location: " . ($job['location'] ?? 'Location not specified');
$salary = "Salary: Rs. " . number_format($job['salary_min']) . ' - ' . number_format($job['salary_max']) ?? 'Not disclosed';
$experience = "Experience: " . $job['exper_min'] . '-' . $job['exper_max'] . ' years';
$skills = "Skills: " . ($job['skills'] ?? '');

// Create image
$width = 1200;
$height = 630;
$image = imagecreatetruecolor($width, $height);

// Modern color scheme
$white = imagecolorallocate($image, 255, 255, 255);
$dark = imagecolorallocate($image, 33, 33, 33);      // Almost black
$accent = imagecolorallocate($image, 255, 89, 94);   // Coral red
$text_color = imagecolorallocate($image, 51, 51, 51);
$secondary = imagecolorallocate($image, 240, 240, 240); // Light gray

// Fill background
imagefill($image, 0, 0, $white);

// Add modern geometric accent
$points = array(
    0, 0,                    // Top left
    $width * 0.7, 0,        // Top right
    $width * 0.6, $height,  // Bottom right
    0, $height              // Bottom left
);
imagefilledpolygon($image, $points, 4, $secondary);

// Add accent line
$line_thickness = 8;
imagesetthickness($image, $line_thickness);
imageline($image, $width * 0.68, 0, $width * 0.58, $height, $accent);

// Company Logo
$logo_max_width = 100;
$logo_max_height = 100;
$logo_y = 40;

if (!empty($job['company_logo'])) {
    $base_path = realpath(__DIR__ . '/..');
    $logo_path = $base_path . '/' . $job['company_logo'];
    
    if (file_exists($logo_path)) {
        $logo_content = file_get_contents($logo_path);
        if ($logo_content !== false) {
            $logo = @imagecreatefromstring($logo_content);
            if ($logo) {
                $logo_width = imagesx($logo);
                $logo_orig_height = imagesy($logo);
                
                // Calculate proportional dimensions
                $logo_aspect = $logo_width / $logo_orig_height;
                if ($logo_width > $logo_max_width) {
                    $logo_width = $logo_max_width;
                    $logo_orig_height = $logo_width / $logo_aspect;
                }
                if ($logo_orig_height > $logo_max_height) {
                    $logo_orig_height = $logo_max_height;
                    $logo_width = $logo_orig_height * $logo_aspect;
                }
                
                // Position logo on the right side
                $logo_x = $width - $logo_width - 60;
                
                // Create circular mask for logo
                $circle_size = max($logo_width, $logo_orig_height) + 20;
                imagefilledellipse($image, $logo_x + $logo_width/2, $logo_y + $logo_orig_height/2, 
                                 $circle_size, $circle_size, $white);
                
                imagecopyresampled(
                    $image, $logo,
                    $logo_x, $logo_y,
                    0, 0,
                    $logo_width, $logo_orig_height,
                    imagesx($logo), imagesy($logo)
                );
                
                // Company name below logo
                $company_size = 24;
                $company_y = $logo_y + $logo_orig_height + 30;
                $company_box = imagettfbbox($company_size, 0, '../assets/fonts/OpenSans-Bold.ttf', $company_name);
                $company_width = $company_box[2] - $company_box[0];
                $company_x = $logo_x + ($logo_width - $company_width)/2;
                imagettftext($image, $company_size, 0, $company_x, $company_y, $text_color, '../assets/fonts/OpenSans-Bold.ttf', $company_name);
                
                imagedestroy($logo);
            }
        }
    }
}

// Job Title
$title_size = 40;
$title_x = 60;
$title_y = 100;
imagettftext($image, $title_size, 0, $title_x, $title_y, $dark, '../assets/fonts/OpenSans-Bold.ttf', $title);

// Add accent rectangle under title
$rect_height = 12;
$rect_width = 100;
imagefilledrectangle($image, $title_x, $title_y + 20, $title_x + $rect_width, $title_y + 20 + $rect_height, $accent);

// Details section
$detail_size = 14;
$detail_x = 60;
$y = $title_y + 100;

// Create semi-transparent box for details
$box_width = $width * 0.5;
$box_height = 280;
$box_x = $detail_x - 20;
$box_y = $y - 30;

// Draw details with proper spacing
$max_width = $box_width - 80;

// Location with text wrapping
$location_lines = wrapText($image, '../assets/fonts/OpenSans-Bold.ttf', $location, $detail_size, $text_color, $detail_x, $max_width, $detail_size);
foreach ($location_lines as $line) {
    imagettftext($image, $detail_size, 0, $detail_x, $y, $text_color, '../assets/fonts/OpenSans-Bold.ttf', $line);
    $y += 40;
}
$y += 20;

// Salary
imagettftext($image, $detail_size, 0, $detail_x, $y, $text_color, '../assets/fonts/OpenSans-Bold.ttf', $salary);
$y += 50;

// Experience
imagettftext($image, $detail_size, 0, $detail_x, $y, $text_color, '../assets/fonts/OpenSans-Bold.ttf', $experience);
$y += 50;

// Skills
if (!empty($skills)) {
    $skills_lines = wrapText($image, '../assets/fonts/OpenSans-Bold.ttf', $skills, $detail_size, $text_color, $detail_x, $max_width, $detail_size);
    foreach ($skills_lines as $line) {
        imagettftext($image, $detail_size, 0, $detail_x, $y, $text_color, '../assets/fonts/OpenSans-Bold.ttf', $line);
        $y += 40;
    }
}

// Website URL at bottom
$website = "http://" . $subdomain . ".ki-careers.com";
$url_size = 20;
$url_y = $height - 40;
$url_box = imagettfbbox($url_size, 0, '../assets/fonts/OpenSans-Bold.ttf', $website);
$url_width = $url_box[2] - $url_box[0];
$url_x = 60;

// Add modern pill-shaped background for URL
$pill_padding = 20;
$pill_height = 36;
imagefilledrectangle($image, 
    $url_x - $pill_padding,
    $url_y - $pill_height + 10,
    $url_x + $url_width + $pill_padding,
    $url_y + 10,
    $accent
);

imagettftext($image, $url_size, 0, $url_x, $url_y, $white, '../assets/fonts/OpenSans-Bold.ttf', $website);

// First clear any output that might have been sent
ob_clean();

// Set the content type header
header('Content-Type: image/png');

// Output the image
imagepng($image);

// Free up memory
imagedestroy($image);
?>
