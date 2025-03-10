<?php
 session_start();
 include('classes/db.class.php');
 // Get the employee ID from session
 $emp_id = htmlspecialchars(trim($_SESSION['id']));
 if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redirect if session is not set
    exit;
}

$id = htmlspecialchars(trim($_SESSION['id'])); // Current employee ID

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get certificate data from the form
    $certificate_name = htmlspecialchars(trim($_POST['certificate_name']));
    $issued_by = htmlspecialchars(trim($_POST['issued_by']));
    $issue_date = htmlspecialchars(trim($_POST['issue_date']));
    $valid_till = htmlspecialchars(trim($_POST['valid_till'])) ?: null;
    $description = htmlspecialchars(trim($_POST['description']));

    // Prepare and execute SQL query to insert the certificate
    $query = $conn->prepare("INSERT INTO certificates_tbl (emp_id, certificate_name, issued_by, issue_date, valid_till, description) 
                             VALUES (:emp_id, :certificate_name, :issued_by, :issue_date, :valid_till, :description)");
    $result = $query->execute([
        ':emp_id' => $id,
        ':certificate_name' => $certificate_name,
        ':issued_by' => $issued_by,
        ':issue_date' => $issue_date,
        ':valid_till' => $valid_till,
        ':description' => $description
    ]);

    if ($result) {
        // Redirect to the certificates management page with success message
        $_SESSION['success'] = "Certificate added successfully!";
        header('Location: manage-employee-certificates.php');
    } else {
        $_SESSION['error'] = "Failed to add certificate.";
        header('Location: manage-employee-certificates.php');
    }
}
?>
