<?php
require_once 'config.php';
include 'DbConnect.php';

if (isset($_GET['subdomain'])) {
    $subdomain = $_GET['subdomain'];
    
    // Validate subdomain format (only lowercase letters and numbers allowed)
    if (!preg_match('/^[a-z0-9]+$/', $subdomain)) {
        echo json_encode(['available' => false, 'message' => 'Invalid subdomain format']);
        exit;
    }
    
    // Check if subdomain exists
    $stmt = $connection->prepare("SELECT id FROM employer_tbl WHERE subdomain = ?");
    $stmt->execute([$subdomain]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode(['available' => false, 'id' => $result['id'], 'message' => 'Subdomain already exists']);
    } else {
        echo json_encode(['available' => true, 'message' => 'Subdomain is available']);
    }
} else {
    echo json_encode(['available' => false, 'message' => 'No subdomain provided']);
}
