<?php
require_once '../config.php';
require_once '../vendor/autoload.php';

\Stripe\Stripe::setApiKey('your_stripe_secret_key');

try {
    $payment_intent_id = $_GET['payment_intent'];
    $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
    
    if ($payment_intent->status === 'succeeded') {
        // Get metadata
        $plan_id = $payment_intent->metadata->plan_id;
        $num_recruiters = $payment_intent->metadata->num_recruiters;
        $employer_id = $payment_intent->metadata->employer_id;
        
        // Insert subscription record
        $db = new DbConnect();
        $conn = $db->connect();
        
        $stmt = $conn->prepare("INSERT INTO subscriptions (employer_id, plan_id, num_recruiters, start_date, end_date, status, total_amount) VALUES (?, ?, ?, NOW(), DATE_ADD(NOW(), INTERVAL (SELECT duration FROM plans WHERE id = ?) DAY), 'active', ?)");
        
        $stmt->execute([
            $employer_id,
            $plan_id,
            $num_recruiters,
            $plan_id,
            $payment_intent->amount / 100
        ]);
        
        $_SESSION['payment_success'] = true;
        header('Location: subscription.php');
    }
} catch (Exception $e) {
    $_SESSION['payment_error'] = $e->getMessage();
    header('Location: subscription.php');
} 