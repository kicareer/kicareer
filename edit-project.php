<?php
session_start();
include('classes/db.class.php');
// Get the employee ID from session
$emp_id = htmlspecialchars(trim($_SESSION['id']));
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_project'])) {
    // Get the updated data from the form
    $id = htmlspecialchars(trim($_POST['id']));
    $project_name = htmlspecialchars(trim($_POST['project_name']));
    $client = htmlspecialchars(trim($_POST['client']));
    $start_date = htmlspecialchars(trim($_POST['start_date']));
    $end_date = isset($_POST['end_date']) ? htmlspecialchars(trim($_POST['end_date'])) : NULL;
    $role = htmlspecialchars(trim($_POST['role']));
    $description = htmlspecialchars(trim($_POST['description']));

    // Validate inputs
    if (!empty($project_name) && !empty($client) && !empty($start_date) && !empty($role)) {
        // Update the project in the database
        $query = $conn->prepare("UPDATE projects_tbl SET 
                                 project_name = :project_name, 
                                 client = :client, 
                                 start_date = :start_date, 
                                 end_date = :end_date, 
                                 role = :role, 
                                 description = :description 
                                 WHERE id = :id");
        $query->execute([
            ':id' => $id,
            ':project_name' => $project_name,
            ':client' => $client,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':role' => $role,
            ':description' => $description
        ]);

        // Redirect to manage projects page after updating
        header('Location: manage-employee-projects.php');
        exit;
    } else {
        // Handle invalid form submission (e.g., show an error message)
        echo "<script>alert('Please fill in all required fields!'); window.history.back();</script>";
    }
}
?>
