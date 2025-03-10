<?php
ob_start();
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    echo '<script>window.location.href="index.php"</script>';
} else {
    echo '<script>window.location.href="index.php"</script>';
}
?>