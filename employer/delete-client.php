<?php
// session_start();
include('../config.php');

if (!isset($_SESSION['employer_id'])) {
    die("Unauthorized access.");
}

// Get the employer ID safely
$emp_id = htmlspecialchars(trim($_SESSION['employer_id']));

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if (!$id) {
        die("Invalid client ID.");
    }

    // Delete the client from the database securely
    $stmt = $conn->prepare("DELETE FROM clients WHERE id = :id AND employer_id = :employer_id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':employer_id', $emp_id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: manage-clients.php?message=Client deleted");
        exit;
    } else {
        die("Error deleting client.");
    }
} else {
    die("Invalid request.");
}
?>
