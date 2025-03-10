<?php
// Include Dompdf autoloader
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Disable any output buffer or unwanted debug output
ob_start();  // Start output buffering

// Initialize Dompdf options
$options = new Options();
$options->set('debugCss', false);  // Disable CSS debugging
$options->set('debugKeepTemp', false);  // Disable keeping temporary files
$options->set('isHtml5ParserEnabled', true);  // Enable HTML5 parsing
$options->set('isPhpEnabled', false);  // Disable PHP execution within HTML
$options->set('isRemoteEnabled', true);  // Enable remote image fetching

// Create Dompdf instance
$dompdf = new Dompdf($options);

// Image path (adjust this based on your setup)
$imagePath = 'default.png';  // Adjust path if needed

// Ensure the file exists
if (!file_exists($imagePath)) {
    echo "Image not found: " . $imagePath;
    exit;
}

// Convert image to base64
$imageData = base64_encode(file_get_contents($imagePath));
$imageType = mime_content_type($imagePath);
$imageBase64 = "data:$imageType;base64,$imageData";

// HTML content with embedded image
$html = '<body>
    <h1>Test PDF with Embedded Image</h1>
    <img src="' . $imageBase64 . '" height="200" />
</body>';

$dompdf->loadHtml($html);  // Load HTML into Dompdf
$dompdf->setPaper('A4', 'portrait');  // Paper size

// Render PDF
try {
    $dompdf->render();
} catch (Exception $e) {
    echo "Error generating PDF: " . $e->getMessage();
    exit;
}

// Get the PDF output (do not output it yet)
$pdf_output = $dompdf->output();
if (!$pdf_output) {
    echo "Error generating PDF!";
    exit;
}

// Clean any previously sent output before sending headers
ob_end_clean();  // Clear the output buffer to avoid any warnings or content before headers

// Send PDF to browser
header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=test_image.pdf");
echo $pdf_output;
?>
