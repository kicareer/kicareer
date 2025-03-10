<?php
 session_start();
 include('classes/db.class.php');
 // Get the employee ID from session
 $emp_id = htmlspecialchars(trim($_SESSION['id']));
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_education'])) {
    // Get form values
    $degree = htmlspecialchars($_POST['degree']);
    $university_name = htmlspecialchars($_POST['university_name']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'] ?: null;
    $description = htmlspecialchars($_POST['description']);
    $emp_id = $_SESSION['id'];

    $query = $conn->prepare("INSERT INTO education_tbl (emp_id, degree, university_name, start_date, end_date, description) 
                             VALUES (:emp_id, :degree, :university_name, :start_date, :end_date, :description)");

    $query->execute([
        ':emp_id' => $emp_id,
        ':degree' => $degree,
        ':university_name' => $university_name,
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':description' => $description
    ]);

    header('Location: manage-employee-education.php');
}
?>
