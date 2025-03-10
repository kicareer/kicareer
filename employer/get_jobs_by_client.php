<?php
require_once '../config.php';

if (isset($_GET['client_id'])) {
    $client_id = htmlspecialchars(trim($_GET['client_id']));
    $sql = "SELECT sno, job_title FROM post WHERE client_id = :client_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->execute();
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($jobs);
}

?>