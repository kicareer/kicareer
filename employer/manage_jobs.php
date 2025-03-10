<?php
require_once '../config.php';
include '../DbConnect.php';
include 'includes/subscription_check.php';

// Check if employer has active subscription
$hasSubscription = checkActiveSubscription($connection, $_SESSION['employer_id']);

// If no subscription and trying to perform action, redirect
if (!$hasSubscription && isset($_POST['action'])) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Subscription required']);
    exit;
}
?>

<!-- Then in your HTML, modify buttons like this: -->
<button class="btn btn-primary" <?php echo getSubscriptionRequiredAttribute($connection, $_SESSION['employer_id']); ?>>
    Post New Job
</button>

<!-- For links: -->
<a href="post_job.php" class="btn btn-primary" <?php echo getSubscriptionRequiredAttribute($connection, $_SESSION['employer_id']); ?>>
    Post New Job
</a> 