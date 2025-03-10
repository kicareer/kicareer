<?php
require_once '../config.php';
// session_start();

if (!isset($_SESSION['employer_id'])) {
    header('Location: login.php');
    exit;
}

// Initialize database connection
$db = new DbConnect();
$connection = $db->connect();

// Fetch available plans
$stmt = $connection->prepare("SELECT * FROM plans ORDER BY price ASC");
$stmt->execute();
$plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get current subscription status
function checkSubscriptionStatus($employer_id, $connection) {
    $stmt = $connection->prepare("
        SELECT s.*, p.plan_name, p.duration, p.num_recruiter, p.charge_per_recruiter 
        FROM subscriptions s
        LEFT JOIN plans p ON s.plan_id = p.id
        WHERE s.employer_id = :employer_id 
        AND s.status = 'active'
        AND (s.end_date >= CURRENT_DATE OR s.end_date IS NULL)
        ORDER BY s.id DESC 
        LIMIT 1
    ");
    $stmt->bindParam(':employer_id', $employer_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$current_subscription = checkSubscriptionStatus($_SESSION['employer_id'], $connection);

// Add a function to convert INR to USD (you can adjust the conversion rate)
function inrToUsd($inr) {
    $conversionRate = 0.012; // 1 INR = 0.012 USD (approximate)
    return round($inr * $conversionRate, 2);
}

// Fetch employer's current num_recruiters
$stmt = $connection->prepare("
    SELECT num_recruiters 
    FROM employer_tbl 
    WHERE id = ?
");
$stmt->execute([$_SESSION['employer_id']]);
$employer = $stmt->fetch(PDO::FETCH_ASSOC);
$current_num_recruiters = $employer['num_recruiters'] ?? 0;

?>

<?php include 'includes/header.php'; ?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="layout-page">
            <?php include 'includes/top-bar.php'; ?>

            <div class="content-wrapper">
                
                <div class="container-xxl flex-grow-1 container-p-y">

                  <!-- Current Subscription Card -->
                  <?php if ($current_subscription): ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Current Subscription</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Plan:</strong> <?php echo htmlspecialchars($current_subscription['plan_name']); ?></p>
                                            <p><strong>Current Recruiters:</strong> <?php echo $current_num_recruiters; ?></p>
                                            <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Start Date:</strong> <?php echo date('M d, Y', strtotime($current_subscription['start_date'])); ?></p>
                                            <p><strong>End Date:</strong> <?php echo date('M d, Y', strtotime($current_subscription['end_date'])); ?></p>
                                            <p><strong>Amount Paid:</strong> $<?php echo number_format($current_subscription['amount_paid']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                

                    <h4 class="fw-bold py-3 mb-4">Subscription Plans</h4>

                    <!-- Plans Row -->
                    <div class="row mb-5">
                        <?php foreach ($plans as $plan): ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><?php echo htmlspecialchars($plan['plan_name']); ?></h5>
                                    <div class="d-flex justify-content-center my-4">
                                        <div class="display-5 fw-bold">
                                            $<?php echo number_format($plan['price']); ?>
                                        </div>
                                        <sub class="mt-auto mb-2">/month</sub>
                                    </div>

                                    <hr>

                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <span class="badge bg-label-primary rounded-pill me-2">✓</span>
                                            <?php echo $plan['num_recruiter']; ?> Recruiters Included
                                        </li>
                                        <li class="mb-2">
                                            <span class="badge bg-label-primary rounded-pill me-2">✓</span>
                                            Additional Recruiter: $<?php echo number_format($plan['charge_per_recruiter']); ?>
                                        </li>
                                        <li class="mb-2">
                                            <span class="badge bg-label-primary rounded-pill me-2">✓</span>
                                            <?php echo $plan['duration']; ?> Days Validity
                                        </li>
                                    </ul>

                                    <div class="mb-4">
                                        <label class="form-label" for="recruiters_<?php echo $plan['id']; ?>">Number of Recruiters:</label>
                                        <input type="number" 
                                               class="form-control"
                                               id="recruiters_<?php echo $plan['id']; ?>" 
                                               min="<?php echo $plan['num_recruiter']; ?>" 
                                               value="<?php echo max($current_num_recruiters, $plan['num_recruiter']); ?>">
                                        <?php if ($current_num_recruiters > 0): ?>
                                        <small class="text-muted">
                                            Current recruiters: <?php echo $current_num_recruiters; ?>
                                        </small>
                                        <?php endif; ?>
                                    </div>

                                    <button class="btn btn-primary d-grid w-100 select-plan-btn" 
                                            data-plan-id="<?php echo $plan['id']; ?>"
                                            data-base-price="<?php echo $plan['price']; ?>"
                                            data-included-recruiters="<?php echo $plan['num_recruiter']; ?>"
                                            data-charge-per-recruiter="<?php echo $plan['charge_per_recruiter']; ?>">
                                        Select Plan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    </div>
                  
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/scripts.php'; ?>

<script>
document.querySelectorAll('.select-plan-btn').forEach(button => {
    button.addEventListener('click', function() {
        const planId = this.dataset.planId;
        const basePrice = this.dataset.basePrice;
        const includedRecruiters = this.dataset.includedRecruiters;
        const chargePerRecruiter = this.dataset.chargePerRecruiter;
        
        // Get the number of recruiters selected for this plan
        const numRecruiters = document.getElementById(`recruiters_${planId}`).value;

        // Create URL with query parameters
        const url = new URL('billing_details.php', window.location.href);
        const params = new URLSearchParams({
            plan_id: planId,
            num_recruiters: numRecruiters,
            base_price: basePrice,
            charge_per_recruiter: chargePerRecruiter,
            included_recruiters: includedRecruiters
        });       
        // Redirect to billing details page with plan information
        window.location.href = `${url}?${params.toString()}`;
    });
});

// Update the price calculation display
document.querySelectorAll('input[type="number"]').forEach(input => {
    const currentRecruiters = <?php echo $current_num_recruiters; ?>;
    
    input.addEventListener('change', function() {
        const planCard = this.closest('.card');
        const button = planCard.querySelector('.select-plan-btn');
        const basePrice = parseFloat(button.dataset.basePrice);
        const includedRecruiters = parseInt(button.dataset.includedRecruiters);
        const chargePerRecruiter = parseFloat(button.dataset.chargePerRecruiter);
        
        const numRecruiters = parseInt(this.value);
        
        // Show warning if reducing recruiters
        if (numRecruiters < currentRecruiters) {
            if (!confirm(`Warning: You are reducing the number of recruiters from ${currentRecruiters} to ${numRecruiters}. This may affect your existing recruiter accounts. Do you want to continue?`)) {
                this.value = currentRecruiters;
                return;
            }
        }
        
        const additionalRecruiters = Math.max(0, numRecruiters - includedRecruiters);
        const totalPrice = basePrice + (additionalRecruiters * chargePerRecruiter);
        
        // Update price display
        planCard.querySelector('.display-5').textContent = `$${totalPrice.toLocaleString()}`;
    });
});
</script>