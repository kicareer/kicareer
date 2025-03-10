<?php
    // Include database configuration
    // include('config.php');
    session_start();
    include('classes/db.class.php');
    // Get the employee ID from session
    if (!isset($_SESSION['id'])) {
        header('Location: login.php'); // Redirect if session is not set
        exit;
    }
    
    $id = htmlspecialchars(trim($_SESSION['id'])); // Current employee ID
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get certificate data from the form
        $certificate_id = htmlspecialchars(trim($_POST['id']));
        $certificate_name = htmlspecialchars(trim($_POST['certificate_name']));
        $issued_by = htmlspecialchars(trim($_POST['issued_by']));
        $issue_date = htmlspecialchars(trim($_POST['issue_date']));
        $valid_till = htmlspecialchars(trim($_POST['valid_till'])) ?: null;
        $description = htmlspecialchars(trim($_POST['description']));
    
        // Prepare and execute SQL query to update the certificate
        $query = $conn->prepare("UPDATE certificates_tbl 
                                 SET certificate_name = :certificate_name, issued_by = :issued_by, 
                                     issue_date = :issue_date, valid_till = :valid_till, description = :description, 
                                     updated_at = CURRENT_TIMESTAMP
                                 WHERE id = :id AND emp_id = :emp_id");
        $result = $query->execute([
            ':id' => $certificate_id,
            ':emp_id' => $id,
            ':certificate_name' => $certificate_name,
            ':issued_by' => $issued_by,
            ':issue_date' => $issue_date,
            ':valid_till' => $valid_till,
            ':description' => $description
        ]);
    
        if ($result) {
            // Redirect to the certificates management page with success message
            $_SESSION['success'] = "Certificate updated successfully!";
            header('Location: manage-employee-certificates.php');
        } else {
            $_SESSION['error'] = "Failed to update certificate.";
            header('Location: manage-employee-certificates.php');
        }
    }
?>
