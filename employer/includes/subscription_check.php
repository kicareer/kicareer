<?php
function checkActiveSubscription($connection, $employer_id) {
    $stmt = $connection->prepare("
        SELECT s.*, p.plan_name, p.duration, p.num_recruiter, p.charge_per_recruiter 
        FROM subscriptions s
        LEFT JOIN plans p ON s.plan_id = p.id
        WHERE s.employer_id = ? 
        AND s.status = 'active'
        AND (s.end_date >= CURRENT_DATE OR s.end_date IS NULL)
        ORDER BY s.id DESC 
        LIMIT 1
    ");
    $stmt->execute([$employer_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function redirectToSubscription() {
    echo "<script>
        Swal.fire({
            title: 'Subscription Required',
            text: 'Please subscribe to a plan to access this feature',
            icon: 'warning',
            confirmButtonText: 'View Plans'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'subscription.php';
            }
        });
    </script>";
    return false;
}

// Use this function to wrap buttons/links that require subscription
function getSubscriptionRequiredAttribute($connection, $employer_id) {
    $subscription = checkActiveSubscription($connection, $employer_id);
    if (!$subscription) {
        return 'onclick="return redirectToSubscription()"';
    }
    return '';
}
?> 