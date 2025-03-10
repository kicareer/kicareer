<?php
 session_start();
 include('classes/db.class.php');
 // Get the employee ID from session
 $emp_id = htmlspecialchars(trim($_SESSION['id']));
 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_project'])) {
    // Get the data from the form
    $project_name = htmlspecialchars(trim($_POST['project_name']));
    $client = htmlspecialchars(trim($_POST['client']));
    $start_date = htmlspecialchars(trim($_POST['start_date']));
    $end_date = isset($_POST['end_date']) ? htmlspecialchars(trim($_POST['end_date'])) : NULL;
    $role = htmlspecialchars(trim($_POST['role']));
    $description = htmlspecialchars(trim($_POST['description']));
    $emp_id = $_SESSION['id']; // Get logged-in employee's ID

    // Validate inputs
    if (!empty($project_name) && !empty($client) && !empty($start_date) && !empty($role)) {
        // Insert the new project into the database
        $query = $conn->prepare("INSERT INTO projects_tbl (emp_id, project_name, client, start_date, end_date, role, description) 
                                 VALUES (:emp_id, :project_name, :client, :start_date, :end_date, :role, :description)");
        $query->execute([
            ':emp_id' => $emp_id,
            ':project_name' => $project_name,
            ':client' => $client,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':role' => $role,
            ':description' => $description
        ]);

        // Redirect to manage projects page after adding
        header('Location: manage-employee-projects.php');
        exit;
    } else {
        // Handle invalid form submission (e.g., show an error message)
        echo "<script>alert('Please fill in all required fields!'); window.history.back();</script>";
    }
}
?>
