<?php
session_start();
include('classes/posts.php'); 
if( !isset($_SESSION['logged_in']) ) {
    $_SESSION['logged_in'] = 0;
}
$logged_in = $_SESSION['logged_in']?1:0;
// Email Configuration
define('STRIPE_SECRET_KEY', 'sk_test_51MWsbSSI57XVj5p7vLRNnD3Z957Mu1pbgnWnIsfysZKG5tINPaXrcBNmDiLycG2GXFf2UGi6Pl1LVf1fmZWjsSzK00dq0vvC4H');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51MWsbSSI57XVj5p7zzra9QSnSh8gAwdC7QD74hD2QhSlgPWir99Yjjn2XeYMMs9jLZvJGVoqOL8M5xKa5Ecnjzq000gXgRNCKb');


define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'kicareer01@gmail.com');
define('SMTP_PASSWORD', 'myen caef fslf jiyw');
define('SMTP_PORT', 587);
define('SMTP_FROM_EMAIL', 'kicareer01@gmail.com');
define('SITE_URL', 'https://ki-careers.com');

// <?php
// contact-us.php

?>

