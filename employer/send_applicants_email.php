<?php
require_once '../config.php';
include '../DbConnect.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$baseUrl = $data['baseUrl'];

try {
    $mail = new PHPMailer(true);
    
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'kicareer01@gmail.com';
    $mail->Password = 'myen caef fslf jiyw';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('kicareer01@gmail.com', 'KI Careers');
    $mail->addAddress($data['clientEmail']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $data['subject'];

    // Build email body
    $body = '<h2>Candidate Profiles</h2>';
    if (!empty($data['additionalNotes'])) {
        $body .= '<p>' . nl2br(htmlspecialchars($data['additionalNotes'])) . '</p>';
    }
    
    $body .= '<table border="1" cellpadding="5" style="border-collapse: collapse; width: 100%;">
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Resume & Documents</th>
        </tr>';

    foreach ($data['applicants'] as $applicant) {
        // Get candidate documents
        $stmt = $connection->prepare("
            SELECT document_type, document_path 
            FROM candidate_documents 
            WHERE emp_id = ?
        ");
        $stmt->execute([$applicant['applied_id']]);
        $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Build documents list
        $documentsList = '';
        foreach ($documents as $doc) {
            $documentsList .= sprintf(
                '<br>• <a href="%s/uploads/%s">%s</a>',
                $baseUrl,
                htmlspecialchars($doc['document_path']),
                htmlspecialchars($doc['document_type'])
            );
        }

        $body .= sprintf('
            <tr>
                <td>%s</td>
                <td>%s</td>
                <td>
                    Email: %s<br>
                    Phone: %s
                </td>
                <td>%s</td>
                <td>
                    <a href="%s/employer/kenz-resume.php?uid=%s">View Resume</a>
                    %s
                </td>
            </tr>',
            htmlspecialchars($applicant['name']),
            htmlspecialchars($applicant['position']),
            htmlspecialchars($applicant['email']),
            htmlspecialchars($applicant['phone']),
            htmlspecialchars($applicant['status']),
            $baseUrl,
            $applicant['applied_id'],
            $documentsList
        );
    }

    $body .= '</table>';
    
    // Add footer with disclaimer
    $body .= '<br><hr><small>Note: The resume and document links will require login credentials to access.</small>';
    
    $mail->Body = $body;

    $mail->send();
    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
    ]);
} 