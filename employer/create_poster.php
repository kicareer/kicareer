<?php
if (!extension_loaded('gd')) {
    die('GD library is not installed. Please install PHP GD extension.');
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../config.php');
require_once('../classes/db.php');

// Get job details
$job_id = $_GET['id'] ?? null;
if (!$job_id) {
    die('Job ID not provided');
}
$font_file = 'OpenSans-Bold.ttf';
$db = new DbConnect();
$conn = $db->connect();

$query = "SELECT j.*, e.company_name, e.company_logo,e.subdomain,e.email FROM post j 
          LEFT JOIN employer_tbl e ON j.employer_id = e.id 
          WHERE j.sno = :job_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':job_id', $job_id);
$stmt->execute();
$job = $stmt->fetch(PDO::FETCH_ASSOC);
// $employer = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$job) {
    die('Job not found');
}

// Create image
$width = 1200;
$height = 1350;
$image = imagecreatetruecolor($width, $height);

// Colors
$yellow = imagecolorallocate($image, 247, 211, 81);  //rgb(247, 211, 81) in RGB
$white = imagecolorallocate($image, 255, 255, 255);
$paleyellow = imagecolorallocate($image, 255, 217, 95);
$black = imagecolorallocate($image, 0, 0, 0);
$blue = imagecolorallocate($image, 0, 123, 255);
$light_blue = imagecolorallocate($image, 100, 181, 246);  // Light blue for text

// Fill background with yellow
imagefill($image, 0, 0, $yellow);

// Load font
$font_file = 'OpenSans-Bold.ttf';
$font_paths = [
    __DIR__ . '/../assets/fonts/' . $font_file,
    '../assets/fonts/' . $font_file,
    'assets/fonts/' . $font_file
];

$font_path = null;
foreach ($font_paths as $path) {
    if (file_exists($path)) {
        $font_path = $path;
        break;
    }
}

if (!$font_path) {
    die('Font not found. Checked paths: ' . implode(', ', $font_paths));
}
$subdomain = $job['subdomain'];
$email = $job['email'];
// Add company logo in top-left corner
if (!empty($job['company_logo'])) {
    $logo_path = "../" . $job['company_logo'];
    if (file_exists($logo_path)) {
        $logo_info = getimagesize($logo_path);
        if ($logo_info !== false) {
            $logo = imagecreatefrompng($logo_path);
            if ($logo) {
                // Make logo smaller and position in top-left
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
$title_size = 60;
$title_y = 250;

// Get the width of the text to center it
$bbox = imagettfbbox($title_size, 0, $font_path, $title);
$text_width = $bbox[2] - $bbox[0];
$text_x = ($width - $text_width) / 2;  // Calculate x position to center the text

// Draw the centered title
imagettftext($image, $title_size, 0, $text_x, $title_y, $blue, $font_path, $title);

// Add "RESPONSIBILITIES" heading
$resp_heading = "RESPONSIBILITIES";
$resp_size = 25;
imagettftext($image, $resp_size, 0, 50, $title_y + 100, $blue, $font_path, $resp_heading);

// Add rounded rectangle for responsibilities - make it narrower
$rect_x = 30;
$rect_y = $title_y + 150;
$rect_width = ($width / 2) - 60;  // Half width minus margins
$rect_height = 400;
imagefilledroundedrectangle($image, $rect_x, $rect_y, $rect_x + $rect_width, $rect_y + $rect_height, 30, $paleyellow);

// Add working man image on the right side
$worker_image_path = "../images/working-man.png";
if (file_exists($worker_image_path)) {
    $worker_info = getimagesize($worker_image_path);
    if ($worker_info !== false) {
        $worker_image = imagecreatefrompng($worker_image_path);
        if ($worker_image) {
            // Calculate dimensions for the worker image
            $orig_width = imagesx($worker_image);
            $orig_height = imagesy($worker_image);
            $aspect = $orig_width / $orig_height;
            
            $worker_height = 400;  // Match height with responsibilities box
            $worker_width = (int)($worker_height * $aspect);
            
            // Position on the right side
            $worker_x = $width - $worker_width - 30;  // 30px margin from right
            $worker_y = $rect_y;  // Align with responsibilities box
            
            // Enable alpha blending
            imagealphablending($image, true);
            imagesavealpha($image, true);
            
            // Copy the worker image
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

// Adjust text position for narrower responsibilities section
$resp_text_size = 16;  // Decreased from 20 to 16

// Calculate maximum width for text wrapping
$max_chars = 45;  // Characters per line
$line_height = 25;  // Space between lines

// Wrap text to fit the box width
$description = $job['job_description'];
$wrapped_text = wordwrap($description, $max_chars, "\n");
$lines = explode("\n", $wrapped_text);

// Start position for text
$y = $rect_y + 40;
$text_x = $rect_x + 30;  // Fixed left margin of 30px from rectangle edge

// Draw each line of text
foreach ($lines as $line) {
    // Skip if we're about to overflow the box
    if ($y >= ($rect_y + $rect_height - 20)) {
        break;
    }
    
    // Left align text with consistent margin
    imagettftext($image, $resp_text_size, 0, $text_x, $y, $black, $font_path, $line);
    $y += $line_height;
}

// Add requirements section at bottom
$req_y = $rect_y + $rect_height + 50;


// Add "WE'RE HIRING" image above location section
$hiring_image_path = "../images/were-hiring.png";
if (!file_exists($hiring_image_path)) {
    error_log("Hiring image not found at: " . $hiring_image_path);
    // Try alternative paths
    $alternative_paths = [
        "./images/were-hiring.png",
        "images/were-hiring.png",
        __DIR__ . "/../images/were-hiring.png",
        __DIR__ . "/images/were-hiring.png"
    ];
    
    foreach ($alternative_paths as $path) {
        if (file_exists($path)) {
            $hiring_image_path = $path;
            break;
        }
    }
}

if (file_exists($hiring_image_path)) {
    // Get image info first
    $hiring_info = getimagesize($hiring_image_path);
    if ($hiring_info !== false) {
        switch ($hiring_info[2]) {
            case IMAGETYPE_JPEG:
                $hiring_image = imagecreatefromjpeg($hiring_image_path);
                break;
            case IMAGETYPE_PNG:
                $hiring_image = imagecreatefrompng($hiring_image_path);
                break;
            case IMAGETYPE_GIF:
                $hiring_image = imagecreatefromgif($hiring_image_path);
                break;
            default:
                error_log("Unsupported image type for hiring image");
                $hiring_image = false;
        }
        
        if ($hiring_image) {
            // Calculate dimensions while maintaining aspect ratio
            $orig_width = imagesx($hiring_image);
            $orig_height = imagesy($hiring_image);
            $aspect = $orig_width / $orig_height;
            
            $hiring_width = 900;  // Width of hiring image
            $hiring_height = (int)($hiring_width / $aspect);
            
            // Position the image closer to the responsibilities box
            $hiring_x = ($width - $hiring_width) / 2;
            $hiring_y = $rect_y + $rect_height + 50; // Position right after responsibilities
            
            // Enable alpha blending
            imagealphablending($image, true);
            imagesavealpha($image, true);
            
            // Copy the hiring image onto the poster
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
        } else {
            error_log("Failed to create image resource for hiring image");
        }
    } else {
        error_log("Failed to get image info for hiring image");
    }
} else {
    error_log("No hiring image found in any location");
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


// Move contact info up accordingly
$contact_y = $info_y + 100; // Position below the location section
$website = "https://" . $subdomain . ".ki-careers.com";
$email = $email;
imagettftext($image, 15, 0, 50, $contact_y, $black, $font_path, $website);
imagettftext($image, 15, 0, $width - 350, $contact_y, $black, $font_path, $email);

// Clear any output buffers
while (ob_get_level()) {
    ob_end_clean();
}

// Output image
header('Content-Type: image/png');
if (isset($_GET['download'])) {
    header('Content-Disposition: attachment; filename="job_poster.png"');
}

// Output the image
if (!imagepng($image)) {
    die('Failed to output image');
}

// Clean up
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
