<?php
if (!extension_loaded('gd')) {
    die('GD library is not installed. Please install PHP GD extension.');
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config.php');
require_once('classes/db.php');
$font_file = 'OpenSans-Bold.ttf';
// Get job details
$job_id = $_GET['id'] ?? null;
if (!$job_id) {
    die('Job ID not provided');
}

$db = new DbConnect();
$conn = $db->connect();

// Modified query to only get necessary and public information
$query = "SELECT j.*, e.company_name, e.company_logo 
          FROM post j 
          LEFT JOIN employer_tbl e ON j.employer_id = e.id 
          WHERE j.sno = :job_id 
          AND j.status = 'active'";  // Only show active jobs
$stmt = $conn->prepare($query);
$stmt->bindParam(':job_id', $job_id);
$stmt->execute();
$job = $stmt->fetch(PDO::FETCH_ASSOC);

// echo json_encode($job);
// exit;
if (!$job) {
    die('Job not found or not available');
}

// Rest of your existing image generation code...
// (Keep all the image generation code the same, just update the paths)

// Update image paths to use root directory
$font_paths = [
    __DIR__ . '/assets/fonts/' . $font_file,
    'assets/fonts/' . $font_file,
];
$font_path  = $font_paths[0];
// Update logo path
if (!empty($job['company_logo'])) {
    $logo_path = $job['company_logo'];  // Remove the "../" since we're in root
}


// Update working man image path
$worker_image_path = "images/working-man.png";

// Update hiring image path
$hiring_image_path = "images/were-hiring.png";

// Rest of your existing code... 

// Create image
$width = 1200;
$height = 1250;
$image = imagecreatetruecolor($width, $height);

// Colors
$yellow = imagecolorallocate($image, 255, 198, 0);  //rgba(231, 199, 81, 0.51) in RGB
$white = imagecolorallocate($image, 255, 255, 255);
$paleyellow = imagecolorallocate($image, 255, 217, 95);
$black = imagecolorallocate($image, 0, 0, 0);
$blue = imagecolorallocate($image, 0, 123, 255);
$light_blue = imagecolorallocate($image, 100, 181, 246);

// Fill background with yellow
imagefill($image, 0, 0, $yellow);

// Add company logo in top-left corner
if (!empty($job['company_logo'])) {
    $logo_path = $job['company_logo'];
    if (file_exists($logo_path)) {
        $logo_info = getimagesize($logo_path);
        if ($logo_info !== false) {
            $logo = imagecreatefrompng($logo_path);
            if ($logo) {
                $new_width = 200;
                $new_height = 100;
                imagecopyresampled($image, $logo, 50, 50, 0, 0, $new_width, $new_height, imagesx($logo), imagesy($logo));
                imagedestroy($logo);
            }
        }
    }
}

// Add job title in large text at top
$title = strtoupper($job['job_title']);
$title_size = 40;
$title_y = 250;

// Get the width of the text to center it
$bbox = imagettfbbox($title_size, 0, $font_path, $title);
$text_width = $bbox[2] - $bbox[0];
$text_x = ($width - $text_width) / 2;

// Draw the centered title
imagettftext($image, $title_size, 0, $text_x, $title_y, $blue, $font_path, $title);

// Add "RESPONSIBILITIES" heading
$resp_heading = "RESPONSIBILITIES";
$resp_size = 20;
imagettftext($image, $resp_size, 0, 50, $title_y + 100, $blue, $font_path, $resp_heading);

// Add rounded rectangle for responsibilities - make it narrower
$rect_x = 30;
$rect_y = $title_y + 150;
$rect_width = ($width / 2) - 60;
$rect_height = 400;
imagefilledroundedrectangle($image, $rect_x, $rect_y, $rect_x + $rect_width, $rect_y + $rect_height, 30, $paleyellow);

// Add working man image on the right side
if (file_exists($worker_image_path)) {
    $worker_info = getimagesize($worker_image_path);
    if ($worker_info !== false) {
        $worker_image = imagecreatefrompng($worker_image_path);
        if ($worker_image) {
            $orig_width = imagesx($worker_image);
            $orig_height = imagesy($worker_image);
            $aspect = $orig_width / $orig_height;
            
            $worker_height = 400;
            $worker_width = (int)($worker_height * $aspect);
            
            $worker_x = $width - $worker_width - 30;
            $worker_y = $rect_y;
            
            imagealphablending($image, true);
            imagesavealpha($image, true);
            
            imagecopyresampled(
                $image,
                $worker_image,
                $worker_x,
                $worker_y,
                0,
                0,
                $worker_width,
                $worker_height,
                $orig_width,
                $orig_height
            );
            
            imagedestroy($worker_image);
        }
    }
}

// Add responsibilities text
$resp_text_size = 16;
$max_chars = 45;
$line_height = 25;

$description = $job['job_description'];
$wrapped_text = wordwrap($description, $max_chars, "\n");
$lines = explode("\n", $wrapped_text);

$y = $rect_y + 40;
$text_x = $rect_x + 30;

foreach ($lines as $line) {
    if ($y >= ($rect_y + $rect_height - 20)) {
        break;
    }
    imagettftext($image, $resp_text_size, 0, $text_x, $y, $black, $font_path, $line);
    $y += $line_height;
}

// Add "WE'RE HIRING" image
if (file_exists($hiring_image_path)) {
    $hiring_info = getimagesize($hiring_image_path);
    if ($hiring_info !== false) {
        $hiring_image = imagecreatefrompng($hiring_image_path);
        if ($hiring_image) {
            $orig_width = imagesx($hiring_image);
            $orig_height = imagesy($hiring_image);
            $aspect = $orig_width / $orig_height;
            
            $hiring_width = 1000;
            $hiring_height = (int)($hiring_width / $aspect);
            
            $hiring_x = ($width - $hiring_width) / 2;
            $hiring_y = $rect_y + $rect_height + 50;
            
            imagealphablending($image, true);
            imagesavealpha($image, true);
            
            imagecopyresampled(
                $image,
                $hiring_image,
                $hiring_x,
                $hiring_y,
                0,
                0,
                $hiring_width,
                $hiring_height,
                $orig_width,
                $orig_height
            );
            
            imagedestroy($hiring_image);
        }
    }
}

// Add location, experience, and language in a row
$info_y = $hiring_y + $hiring_height + 50;  // Position below the hiring image
$col_width = $width / 3;

$location = $job['location'];
// Location
imagettftext($image, 20, 0, 50, $info_y, $blue, $font_path, "LOCATION");
imagettftext($image, 15, 0, 50, $info_y + 50, $black, $font_path, $location);

$experience = $job['exper_min'].' to '.$job['exper_max'].' years';
// Experience
imagettftext($image, 20, 0, $col_width + 50, $info_y, $blue, $font_path, "EXPERIENCE");
imagettftext($image, 15, 0, $col_width + 50, $info_y + 50, $black, $font_path, $experience);

// Language
imagettftext($image, 20, 0, ($col_width * 2) + 50, $info_y, $blue, $font_path, "LANGUAGE");
imagettftext($image, 15, 0, ($col_width * 2) + 50, $info_y + 50, $black, $font_path, "English");

// Add Skills section
$skills_y = $info_y + 100; // Position below the previous info row
imagettftext($image, 20, 0, 50, $skills_y, $blue, $font_path, "REQUIRED SKILLS");

// Wrap and display skills
$skills = $job['skills'];
$skills_width = $width - 100; // Full width minus margins
$skills_size = 15;
$line_height = 30;

// Word wrap the skills text
$wrapped_skills = wordwrap($skills, 100, "\n"); // Wrap after approximately 100 characters
$skills_lines = explode("\n", $wrapped_skills);

$skills_text_y = $skills_y + 30; // Start text below the heading
foreach ($skills_lines as $line) {
    imagettftext($image, $skills_size, 0, 50, $skills_text_y, $black, $font_path, $line);
    $skills_text_y += $line_height;
}

// Adjust contact info position to account for skills section
$contact_y = $skills_text_y + 50; // Position below the skills section
$website = "https://" . $subdomain . ".ki-careers.com";
$email = $email;
imagettftext($image, 15, 0, 50, $contact_y, $black, $font_path, $website);
imagettftext($image, 15, 0, $width - 350, $contact_y, $black, $font_path, $email);

// Clear output buffer
while (ob_get_level()) {
    ob_end_clean();
}

// Output image
header('Content-Type: image/png');
if (isset($_GET['download'])) {
    header('Content-Disposition: attachment; filename="job_poster.png"');
}

if (!imagepng($image)) {
    die('Failed to output image');
}

imagedestroy($image);

// Helper function for rounded rectangle
function imagefilledroundedrectangle($image, $x, $y, $w, $h, $radius, $color) {
    imagefilledrectangle($image, $x + $radius, $y, $w - $radius, $h, $color);
    imagefilledrectangle($image, $x, $y + $radius, $w, $h - $radius, $color);
    
    imagearc($image, $x + $radius, $y + $radius, $radius * 2, $radius * 2, 180, 270, $color);
    imagefilltoborder($image, $x + $radius - 1, $y + $radius - 1, $color, $color);
    
    imagearc($image, $w - $radius, $y + $radius, $radius * 2, $radius * 2, 270, 360, $color);
    imagefilltoborder($image, $w - $radius + 1, $y + $radius - 1, $color, $color);
    
    imagearc($image, $x + $radius, $h - $radius, $radius * 2, $radius * 2, 90, 180, $color);
    imagefilltoborder($image, $x + $radius - 1, $h - $radius + 1, $color, $color);
    
    imagearc($image, $w - $radius, $h - $radius, $radius * 2, $radius * 2, 0, 90, $color);
    imagefilltoborder($image, $w - $radius + 1, $h - $radius + 1, $color, $color);
}
?> 
