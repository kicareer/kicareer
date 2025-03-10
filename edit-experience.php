<?php
    // Include database configuration
    // include('config.php');
    session_start();
    include('classes/db.class.php');
    // Get the employee ID from session
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $job_title = $_POST['job_title'];
        $company_name = $_POST['company_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'] ?: null; // Allow null for end_date
        $description = $_POST['description'];
    
        // Prepare the SQL query for updating experience
    $sql = "UPDATE experience_tbl SET 
    job_title = :job_title, 
    company_name = :company_name, 
    start_date = :start_date, 
    end_date = :end_date, 
    description = :description, 
    updated_at = CURRENT_TIMESTAMP 
    WHERE id = :experience_id AND emp_id = :emp_id";

// Use prepared statements for secure update
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bindParam(':experience_id', $id, PDO::PARAM_INT);
$stmt->bindParam(':emp_id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->bindParam(':job_title', $job_title, PDO::PARAM_STR);
$stmt->bindParam(':company_name', $company_name, PDO::PARAM_STR);
$stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);

// If end_date is NULL, use PDO::PARAM_NULL for proper handling
if ($end_date === null) {
$stmt->bindParam(':end_date', $end_date, PDO::PARAM_NULL);
} else {
$stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
}

$stmt->bindParam(':description', $description, PDO::PARAM_STR);

// Execute the query and check if successful
if ($stmt->execute()) {
echo "<script>alert('Experience updated successfully!');</script>";
echo "<script>window.location.href = 'manage-employee-experience.php';</script>";
} else {
echo "<script>alert('Failed to update experience. Please try again.');</script>";
}
    
}
?>
