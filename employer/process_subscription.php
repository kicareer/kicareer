<?php
include('../config.php');

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: employer-login.php");
    exit();
}

// Initialize database connection
$db = new DbConnect();
$connection = $db->connect();

// Handle trial activation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activate_trial'])) {
    $employer_id = $_SESSION['id'];
    
    try {
        // Start transaction
        $connection->beginTransaction();
        
        // Check trial eligibility
        $stmt = $connection->prepare("
            SELECT COUNT(*) as trial_count 
            FROM subscriptions 
            WHERE employer_id = :employer_id 
            AND plan_id IS NULL
        ");
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['trial_count'] > 0) {
            throw new Exception("Trial period already used");
        }
        
        // Calculate trial dates
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime('+14 days'));
        
        // Insert trial subscription
        $stmt = $connection->prepare("
            INSERT INTO subscriptions (
                employer_id, start_date, end_date, 
                status, payment_status, is_trial
            ) VALUES (
                :employer_id, :start_date, :end_date,
                'active', 'completed', 1
            )
        ");
        
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->execute();
        
        // Commit transaction
        $connection->commit();
        
        $_SESSION['success'] = "Trial period activated successfully!";
        header("Location: index.php");
        exit();
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $connection->rollBack();
        $_SESSION['error'] = "Error activating trial: " . $e->getMessage();
        header("Location: subscription.php");
        exit();
    }
}

// Handle plan subscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['plan_id'])) {
    $employer_id = $_SESSION['id'];
    $plan_id = $_POST['plan_id'];
    
    try {
        // Start transaction
        $connection->beginTransaction();
        
        // Get plan details
        $stmt = $connection->prepare("SELECT * FROM plans WHERE id = :plan_id");
        $stmt->bindParam(':plan_id', $plan_id);
        $stmt->execute();
        $plan = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$plan) {
            throw new Exception("Invalid plan selected");
        }
        
        // Calculate subscription dates
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime("+{$plan['duration']} days"));
        
        // Check if there's an existing active subscription
        $stmt = $connection->prepare("
            UPDATE subscriptions 
            SET status = 'expired' 
            WHERE employer_id = :employer_id 
            AND status = 'active'
        ");
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->execute();
        
        // Insert new subscription
        $stmt = $connection->prepare("
            INSERT INTO subscriptions (
                employer_id, plan_id, start_date, end_date, 
                amount_paid, status, payment_status
            ) VALUES (
                :employer_id, :plan_id, :start_date, :end_date,
                :amount_paid, 'active', 'pending'
            )
        ");
        
        $stmt->bindParam(':employer_id', $employer_id);
        $stmt->bindParam(':plan_id', $plan_id);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':amount_paid', $plan['price']);
        $stmt->execute();
        
        // Commit transaction
        $connection->commit();
        
        // For now, we'll simulate successful payment
        // In production, integrate with payment gateway here
        $subscription_id = $connection->lastInsertId();
        $stmt = $connection->prepare("
            UPDATE subscriptions 
            SET payment_status = 'completed' 
            WHERE id = :subscription_id
        ");
        $stmt->bindParam(':subscription_id', $subscription_id);
        $stmt->execute();
        
        $_SESSION['success'] = "Subscription activated successfully!";
        header("Location: index.php");
        exit();
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $connection->rollBack();
        $_SESSION['error'] = "Error processing subscription: " . $e->getMessage();
        header("Location: subscription.php");
        exit();
    }
} else {
    header("Location: subscription.php");
    exit();
} 