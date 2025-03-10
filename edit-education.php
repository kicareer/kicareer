<?php
    // Include database configuration
    // include('config.php');
    session_start();
    include('classes/db.class.php');
    // Get the employee ID from session
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $degree = $_POST['degree'];
        $university_name = $_POST['university_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'] ?: null; // Allow null for end_date
        $description = $_POST['description'];
    
        // Prepare the SQL query for updating education
        $sql = "UPDATE education_tbl SET 
            degree = :degree, 
            university_name = :university_name, 
            start_date = :start_date, 
            end_date = :end_date, 
            description = :description, 
            updated_at = CURRENT_TIMESTAMP 
            WHERE id = :education_id AND emp_id = :emp_id";

        // Use prepared statements for secure update
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':education_id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':emp_id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->bindParam(':degree', $degree, PDO::PARAM_STR);
        $stmt->bindParam(':university_name', $university_name, PDO::PARAM_STR);
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
            echo "<script>alert('Education details updated successfully!');</script>";
            echo "<script>window.location.href = 'manage-employee-education.php';</script>";
        } else {
            echo "<script>alert('Failed to update education details. Please try again.');</script>";
        }
    }
?>
