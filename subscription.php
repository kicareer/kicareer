<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="layout-page">
            <?php include 'includes/top-bar.php'; ?>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Subscription Management</h4>

                    <!-- Current Subscription Card - Moved to top -->
                    <?php if ($current_subscription): ?>
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Current Subscription</h5>
                                    <span class="badge bg-success">Active</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Plan:</strong> <?php echo htmlspecialchars($current_subscription['plan_name']); ?></p>
                                            <p><strong>Current Recruiters:</strong> <?php echo $current_num_recruiters; ?></p>
                                            <p><strong>Amount Paid:</strong> $<?php echo number_format($current_subscription['amount_paid']); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Start Date:</strong> <?php echo date('M d, Y', strtotime($current_subscription['start_date'])); ?></p>
                                            <p><strong>End Date:</strong> <?php echo date('M d, Y', strtotime($current_subscription['end_date'])); ?></p>
                                            <p><strong>Days Remaining:</strong> <?php 
                                                $end_date = new DateTime($current_subscription['end_date']);
                                                $today = new DateTime();
                                                $days_remaining = $today->diff($end_date)->days;
                                                echo $days_remaining;
                                            ?> days</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Available Plans Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="mb-0">Available Plans</h5>
                            <small class="text-muted">Choose a plan that suits your needs</small>
                        </div>
                    </div>

                    <!-- Plans Row -->
                    <div class="row mb-5">
                        <?php foreach ($plans as $plan): ?>
                        <!-- ... existing plan cards code ... -->
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>
</div> 