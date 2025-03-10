<?php
include '../config.php';

if (!isset($_SESSION['kenz_employer'])) {
    header("Location: ../employer-login.php");
    exit();
}

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $employer_id = $_SESSION['kenz_employer'];

        // Verify that the recruiter belongs to the current employer
        $check_query = "SELECT id FROM recruiter_tbl WHERE id = :id AND employer_id = :employer_id";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bindParam(':id', $id);
        $check_stmt->bindParam(':employer_id', $employer_id);
        $check_stmt->execute();

        if ($check_stmt->rowCount() > 0) {
            // Delete the recruiter
            $delete_query = "DELETE FROM recruiter_tbl WHERE id = :id AND employer_id = :employer_id";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bindParam(':id', $id);
            $delete_stmt->bindParam(':employer_id', $employer_id);
            
            if ($delete_stmt->execute()) {
                echo "<script>alert('Recruiter deleted successfully!'); window.location.href='manage-recruiters.php';</script>";
            } else {
                echo "<script>alert('Failed to delete recruiter!'); window.location.href='manage-recruiters.php';</script>";
            }
        } else {
            echo "<script>alert('Unauthorized access!'); window.location.href='manage-recruiters.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='manage-recruiters.php';</script>";
    }
} else {
    header("Location: manage-recruiters.php");
    exit();
}
?>
