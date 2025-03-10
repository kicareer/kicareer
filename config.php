<?php
session_start();
include('classes/posts.php'); 
if( !isset($_SESSION['logged_in']) ) {
    $_SESSION['logged_in'] = 0;
}
$logged_in = $_SESSION['logged_in']?1:0;
// Email Configuration


// <?php
// contact-us.php

?>

