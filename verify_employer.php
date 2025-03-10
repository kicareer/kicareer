<?php
// Include database connection (replace with your connection logic)
// require 'db_connection.php';
include('config.php');
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $stmt = $conn->prepare("SELECT * FROM employer_tbl WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    // For demonstration, let's assume $user is fetched correctly
    if ($user) {
        // Mark user as verified
        $stmt = $conn->prepare("UPDATE employer_tbl SET status = 'active' WHERE token = ?");
        $stmt->execute([$token]);

        echo "<script language='javascript'>alert('Your account has been verified successfully.');window.location.href='employer-login.php';</script>";
    } else {
        echo "<script language='javascript'>alert('Invalid token.');window.location.href='employer-login.php';</script>";
    }
} else {
    echo "<script language='javascript'>alert('No token provided.');window.location.href='employer-login.php';</script>";
}
?>
