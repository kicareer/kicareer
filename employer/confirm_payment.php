<?php
require_once '../config.php';
include '../DbConnect.php';
// session_start();

if (!isset($_SESSION['employer_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

try {
    // First get the plan details
    $stmt = $connection->prepare("SELECT duration, num_recruiter FROM plans WHERE id = ?");
    $stmt->execute([$data['plan_id']]);
    $plan = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$plan) {
        throw new Exception("Invalid plan selected");
    }
    
    // Check for existing active subscription
    $stmt = $connection->prepare("
        SELECT s.*, p.plan_name, p.duration, p.num_recruiter, p.charge_per_recruiter 
        FROM subscriptions s
        LEFT JOIN plans p ON s.plan_id = p.id
        WHERE s.employer_id = ? 
        AND s.status = 'active'
        AND (s.end_date >= CURRENT_DATE OR s.end_date IS NULL)
        ORDER BY s.id DESC 
        LIMIT 1
    ");
    $stmt->execute([$data['employer_id']]);
    $existingSubscription = $stmt->fetch(PDO::FETCH_ASSOC);

    // If there's an existing subscription, mark it as inactive
    if ($existingSubscription) {
        $stmt = $connection->prepare("
            UPDATE subscriptions 
            SET status = 'inactive', updated_at = NOW() 
            WHERE id = ?
        ");
        $stmt->execute([$existingSubscription['id']]);
    }
    
    // Calculate subscription period based on plan duration
    $start_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s', strtotime("+{$plan['duration']} days"));

    // Begin transaction
    $connection->beginTransaction();

    try {
        // Insert subscription record
        $stmt = $connection->prepare("INSERT INTO subscriptions (
            employer_id, 
            plan_id, 
            amount_paid, 
            is_trial, 
            start_date, 
            end_date, 
            status, 
            payment_id, 
            payment_status, 
            created_at, 
            updated_at
        ) VALUES (
            ?, ?, ?, 0, ?, ?, 'active', ?, ?, NOW(), NOW()
        )");

        $stmt->execute([
            $data['employer_id'],
            $data['plan_id'],
            $data['amount_paid'],
            $start_date,
            $end_date,
            $data['payment_id'],
            $data['payment_status']
        ]);

        if ($stmt->rowCount() > 0) {
            // Update employer's recruiter count
            $stmt = $connection->prepare("
                UPDATE employer_tbl 
                SET num_recruiters = ?, 
                    updated_at = NOW() 
                WHERE id = ?
            ");
            $stmt->execute([
                $data['num_recruiters'],
                $data['employer_id']
            ]);

            $connection->commit();

            echo json_encode([
                'status' => 'success',
                'subscription' => [
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'num_recruiters' => $data['num_recruiters']
                ]
            ]);
        } else {
            throw new Exception("Failed to insert subscription");
        }
    } catch (Exception $e) {
        $connection->rollBack();
        throw $e;
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
} 