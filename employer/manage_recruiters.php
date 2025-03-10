<?php
require_once '../config.php';
include '../DbConnect.php';
include 'includes/subscription_check.php';

$hasSubscription = checkActiveSubscription($connection, $_SESSION['employer_id']);
?>

<!-- In your HTML -->
<button class="btn btn-primary" 
    <?php echo getSubscriptionRequiredAttribute($connection, $_SESSION['employer_id']); ?>>
    Add Recruiter
</button>

<!-- Add this to your page's script section -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (!$hasSubscription): ?>
    // Disable all interactive elements if no subscription
    document.querySelectorAll('.action-buttons button, .action-buttons a').forEach(el => {
        el.setAttribute('onclick', 'return redirectToSubscription()');
    });
    <?php endif; ?>
});
</script> 