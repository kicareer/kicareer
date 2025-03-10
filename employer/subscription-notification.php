<?php
require_once('/var/www/ki-career/config.php'); 
require '/var/www/ki-career/vendor/autoload.php'; // Make sure you have PHPMailer installed

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Initialize database connection
$db = new DbConnect();
$conn = $db->connect();

// Get subscriptions ending in 5 days
$stmt = $conn->prepare("
    SELECT 
        s.*, 
        e.company_name,
        e.email as employer_email,
        p.plan_name,
        p.price,
        p.num_recruiter
    FROM subscriptions s
    JOIN employer_tbl e ON s.employer_id = e.id
    JOIN plans p ON s.plan_id = p.id
    WHERE s.status = 'active'
    AND DATE(s.end_date) = DATE_ADD(CURRENT_DATE, INTERVAL 5 DAY)
");
$stmt->execute();
$expiring_subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Function to send email notification
function sendExpiryNotification($subscription) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;

        // Recipients
        $mail->setFrom(SMTP_FROM_EMAIL, 'Ki-Careers');
        $mail->addAddress($subscription['employer_email'], $subscription['company_name']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Subscription Expiry Notice - Ki-Careers';

        // Email body
        $body = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
            <h2>Subscription Expiry Notice</h2>
            <p>Dear {$subscription['company_name']},</p>
            
            <p>This is a friendly reminder that your subscription plan with Ki-Careers will expire in 5 days on <strong>" . date('F j, Y', strtotime($subscription['end_date'])) . "</strong>.</p>
            
            <h3>Current Plan Details:</h3>
            <ul>
                <li>Plan Name: {$subscription['plan_name']}</li>
                <li>Number of Recruiters: {$subscription['num_recruiter']}</li>
                <li>Monthly Price: $" . number_format($subscription['price'], 2) . "</li>
                <li>Expiry Date: " . date('F j, Y', strtotime($subscription['end_date'])) . "</li>
            </ul>
            
            <p>To ensure uninterrupted access to our services, please renew your subscription before the expiry date.</p>
            
            <div style='margin: 30px 0;'>
                <a href='".SITE_URL."/employer/subscription.php' 
                   style='background-color: #2b88c4; 
                          color: white; 
                          padding: 12px 25px; 
                          text-decoration: none; 
                          border-radius: 5px;
                          display: inline-block;'>
                    Renew Subscription
                </a>
            </div>
            
            <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
            
            <p>Best regards,<br>Ki-Careers Team</p>
        </div>";

        $mail->Body = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
        
        // Log successful email
        error_log("Subscription expiry notification sent to {$subscription['employer_email']} for company {$subscription['company_name']}");
        
        return true;
    } catch (Exception $e) {
        // Log error
        error_log("Failed to send subscription expiry notification to {$subscription['employer_email']}: {$mail->ErrorInfo}");
        return false;
    }
}

// Send notifications for each expiring subscription
foreach ($expiring_subscriptions as $subscription) {
    sendExpiryNotification($subscription);
}

// Update notification status in database (optional)
$update_stmt = $conn->prepare("
    UPDATE subscriptions 
    SET notification_sent = 1 
    WHERE id = :subscription_id
");

foreach ($expiring_subscriptions as $subscription) {
    $update_stmt->execute(['subscription_id' => $subscription['id']]);
} 