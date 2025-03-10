<?php
session_start();
include('classes/db.class.php');
// Get the employee ID from session
$emp_id = htmlspecialchars(trim($_SESSION['id']));
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the experience from the database
    $stmt = $conn->prepare("DELETE FROM experience_tbl WHERE id = :id AND emp_id = :emp_id");
    $stmt->execute(['id' => $id . ' NOT NULL', 'emp_id' => $emp_id]);

    // Redirect back to manage experience page
    header("Location: manage-employee-experience.php?message=deleted");
    exit;
} else {
    die("Invalid request.");
}
?>
