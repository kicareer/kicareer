<?php
    // Include database configuration
    // include('config.php');
    session_start();
    include('classes/db.class.php');
    // Get the employee ID from session
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_skill'])) {
        $id = $_POST['id'];
        $skill_name = htmlspecialchars($_POST['skill_name']);
        $skill_level = htmlspecialchars($_POST['skill_level']);
    
        $query = $conn->prepare("UPDATE employee_skills_tbl 
                                 SET skill_name = :skill_name, skill_level = :skill_level, updated_at = CURRENT_TIMESTAMP 
                                 WHERE id = :id");
    
        $query->execute([
            ':id' => $id,
            ':skill_name' => $skill_name,
            ':skill_level' => $skill_level
        ]);
    
        header('Location: manage-employee-skills.php');
    }
?>
