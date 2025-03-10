<?php
include('../config.php');

if(!isset($_SESSION['admin_id'])){ 
    header('Location: login.php'); 
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $response = array();
    
    try {
        $db = new DbConnect();
        $connection = $db->connect();
        
        if ($_POST['action'] === 'edit') {
            $plan_id = intval($_POST['plan_id']);
            $plan_name = htmlspecialchars(trim($_POST['plan_name']));
            $price = floatval($_POST['price']);
            $duration = intval($_POST['duration']);
            $num_recruiter = intval($_POST['num_recruiter']);
            $charge_per_recruiter = floatval($_POST['charge_per_recruiter']);
            
            $query = "UPDATE plans 
                     SET plan_name = :plan_name,
                         price = :price,
                         duration = :duration,
                         num_recruiter = :num_recruiter,
                         charge_per_recruiter = :charge_per_recruiter,
                         updated_at = NOW()
                     WHERE id = :plan_id";
            
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':plan_id', $plan_id);
            $stmt->bindParam(':plan_name', $plan_name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':num_recruiter', $num_recruiter);
            $stmt->bindParam(':charge_per_recruiter', $charge_per_recruiter);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Plan updated successfully!';
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to update plan!';
            }
        }
    } catch (PDOException $e) {
        $response['success'] = false;
        $response['message'] = 'Error: ' . $e->getMessage();
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} 