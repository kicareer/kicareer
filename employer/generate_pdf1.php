<?php
// Include Dompdf autoloader (Make sure you have installed Dompdf with Composer)
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Check if printContents is set in POST data
if (isset($_POST['printContents'])) {
    // Retrieve and sanitize the content to be printed from POST data
    $printContents = $_POST['printContents']; // Prevent XSS vulnerabilities

    // Initialize Dompdf options
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
    $options->set('isPhpEnabled', true); // Enable PHP within HTML if needed (use with caution)
    $options->set('isRemoteEnabled', true); // Enable remote content (use with caution for security reasons)

    // Initialize Dompdf with options
    $dompdf = new Dompdf($options);

    // Load HTML content into Dompdf
    $dompdf->loadHtml($printContents);

    // Set paper size and orientation (A4 is default, 'portrait' is default, but it's good to explicitly set)
    $dompdf->setPaper('A4', 'portrait');
    
    try {
        $dompdf->render();
    } catch (Exception $e) {
        // If an error occurs during rendering
        echo "Error generating PDF: " . $e->getMessage();
        exit;
    }

    // Output the generated PDF as a blob
    $pdfOutput = $dompdf->output();

    // Set headers for PDF file download (before any output)
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=resume.pdf");
    header("Content-Length: " . strlen($pdfOutput));

    // Output PDF contents for download
    echo $pdfOutput;
} else {
    echo 'No content to print.';
}
?>
