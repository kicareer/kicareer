<?php
 session_start();
 include('classes/db.class.php');
 // Get the employee ID from session
 $emp_id = htmlspecialchars(trim($_SESSION['id']));
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_skill'])) {
    // Get form values
    $skill_name = htmlspecialchars($_POST['skill_name']);
    $skill_level = htmlspecialchars($_POST['skill_level']);
    $emp_id = $_SESSION['id'];

    // Insert skill into the database
    $query = $conn->prepare("INSERT INTO employee_skills_tbl (emp_id, skill_name, skill_level) 
                             VALUES (:emp_id, :skill_name, :skill_level)");

    $query->execute([
        ':emp_id' => $emp_id,
        ':skill_name' => $skill_name,
        ':skill_level' => $skill_level
    ]);

    header('Location: manage-employee-skills.php');
}
?>
