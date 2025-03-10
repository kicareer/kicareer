<?php
if (isset($_POST['add_experience'])) {
    // Include database configuration
    // include('config.php');
    session_start();
    include('classes/db.class.php');
    // Get the employee ID from session
    $emp_id = htmlspecialchars(trim($_SESSION['id']));

        // Retrieve form inputs and sanitize them
        $job_title = htmlspecialchars(trim($_POST['job_title']));
        $company_name = htmlspecialchars(trim($_POST['company_name']));
        $start_date = htmlspecialchars(trim($_POST['start_date']));
        $end_date = !empty($_POST['end_date']) ? htmlspecialchars(trim($_POST['end_date'])) : null; // Can be NULL
        $description = htmlspecialchars(trim($_POST['description']));

        // Prepare the SQL query
        $sql = "INSERT INTO experience_tbl (emp_id, job_title, company_name, start_date, end_date, description) 
                VALUES (:emp_id, :job_title, :company_name, :start_date, :end_date, :description)";

        // Use prepared statements for secure insertion
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_INT);
        $stmt->bindParam(':job_title', $job_title, PDO::PARAM_STR);
        $stmt->bindParam(':company_name', $company_name, PDO::PARAM_STR);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR); // Can be NULL
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        // Execute the query
        if ($stmt->execute()) {
            echo "<script>alert('Experience added successfully!');</script>";
            echo "<script>window.location.href = 'manage-employee-experience.php';</script>";
        } else {
            echo "<script>alert('Failed to add experience. Please try again.');</script>";
        }

    // Close the database connection
    $conn->close();
}
?>
