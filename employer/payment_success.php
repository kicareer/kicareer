<?php
require_once '../config.php';
// session_start();

if (!isset($_SESSION['employer_id'])) {
    header('Location: login.php');
    exit;
}

// Get the payment intent ID from the URL
$payment_intent = $_GET['payment_intent'] ?? null;
$payment_intent_client_secret = $_GET['payment_intent_client_secret'] ?? null;

include 'includes/header.php';
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="layout-page">
            <?php include 'includes/top-bar.php'; ?>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="bx bx-check-circle text-success mb-4" style="font-size: 5rem;"></i>
                                    <h3>Payment Successful!</h3>
                                    <p class="mb-4">Thank you for your subscription. Your account has been activated.</p>
                                    <a href="./" class="btn btn-primary">Go to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/scripts.php'; ?> 