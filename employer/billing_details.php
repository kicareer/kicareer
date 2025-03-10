<?php
require_once '../config.php';
// session_start();

if (!isset($_SESSION['employer_id'])) {
    header('Location: login.php');
    exit;
}

// Add this after session check
$plan_id = $_GET['plan_id'] ?? null;
$num_recruiters = $_GET['num_recruiters'] ?? null;
$base_price = $_GET['base_price'] ?? null;
$charge_per_recruiter = $_GET['charge_per_recruiter'] ?? null;
$included_recruiters = $_GET['included_recruiters'] ?? null;

if (!$plan_id || !$num_recruiters || !$base_price || !$charge_per_recruiter || !$included_recruiters) {
    header('Location: subscription.php');
    exit;
}

// Calculate totals
$additional_recruiters = max(0, $num_recruiters - $included_recruiters);
$additional_charge = $additional_recruiters * $charge_per_recruiter;
$total_amount = $base_price + $additional_charge;
?>

<?php include 'includes/header.php'; ?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="layout-page">
            <?php include 'includes/top-bar.php'; ?>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Subscription /</span> Payment Details
                    </h4>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Billing & Payment Information</h5>
                                </div>
                                <div class="card-body">
                                <form id="payment-form">
    <!-- Billing Details Section -->
    <h6 class="mb-3">Billing Details</h6>
    <div class="row mb-3">
        <div class="col-12">
            <label class="form-label" for="customer_name">Full Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required value="<?php echo htmlspecialchars($_SESSION['name']); ?>">
        </div>
    </div>

    <!-- Contact Details -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label" for="countryCode">Country</label>
            <select class="form-select" id="countryCode" name="countryCode" required>
                <option value="">Select Country</option>
                <option value="US" data-code="+1">United States (+1)</option>
                <option value="GB" data-code="+44">United Kingdom (+44)</option>
                <option value="IN" data-code="+91" selected>India (+91)</option>
                <option value="AU" data-code="+61">Australia (+61)</option>
                <option value="CA" data-code="+1">Canada (+1)</option>
            </select>
        </div>
        <div class="col-md-8">
            <label class="form-label" for="contact_number">Contact Number</label>
            <div class="input-group">
                <span class="input-group-text" id="selected_code">+91</span>
                <input type="tel" class="form-control" id="contact_number" name="contact_number" required value="<?php echo htmlspecialchars($_SESSION['contact_number']); ?>" pattern="[0-9]{10}" title="Please enter a valid phone number">
            </div>
        </div>
    </div>

    <!-- Address Fields -->
    <div class="mb-3">
        <label class="form-label" for="customer_address_line1">Address Line 1</label>
        <input type="text" class="form-control" id="customer_address_line1" name="customer_address_line1" required>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label" for="customer_city">City</label>
            <input type="text" class="form-control" id="customer_city" name="customer_city" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="customer_state">State</label>
            <input type="text" class="form-control" id="customer_state" name="customer_state" required>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <label class="form-label" for="customer_postal_code">Postal Code/Zip Code</label>
            <input type="text" class="form-control" id="customer_postal_code" name="customer_postal_code" required>
        </div>
    
        <div class="col-md-6">
            <label class="form-label" for="customer_postal_code">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $_SESSION['email'] ?>" required>
        </div>
    </div>

    <!-- Stripe Payment Element -->
    <hr class="my-4">
    <h6 class="mb-3">Payment Details</h6>
    <div id="card-element" class="mb-3">
        <!-- Stripe Elements will be inserted here -->
    </div>


    <!-- Error messages -->
    <div id="payment-message" class="alert alert-danger d-none"></div>

    <!-- Hidden Inputs for Plan Details -->
    <input type="hidden" id="plan_id" name="plan_id" value="<?php echo htmlspecialchars($plan_id); ?>">
    <input type="hidden" id="num_recruiters" name="num_recruiters" value="<?php echo htmlspecialchars($num_recruiters); ?>">
    <input type="hidden" id="base_price" name="base_price" value="<?php echo htmlspecialchars($base_price); ?>">
    <input type="hidden" id="charge_per_recruiter" name="charge_per_recruiter" value="<?php echo htmlspecialchars($charge_per_recruiter); ?>">
    <input type="hidden" id="included_recruiters" name="included_recruiters" value="<?php echo htmlspecialchars($included_recruiters); ?>">

    <button type="submit" class="btn btn-primary d-flex gap-2 align-items-center" id="submit">
        <span id="button-text">Pay Now</span>
        <div class="spinner d-none" id="spinner">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </div>
    </button>
</form>

                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Card -->
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Order Summary</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex justify-content-between mb-2">
                                            <span>Base Price</span>
                                            <span>$<?php echo number_format($base_price); ?></span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-2">
                                            <span>Additional Recruiters</span>
                                            <span><?php echo $additional_recruiters; ?></span>
                                        </li>
                                        <li class="d-flex justify-content-between mb-2">
                                            <span>Additional Charges</span>
                                            <span>$<?php echo number_format($additional_charge); ?></span>
                                        </li>
                                        <hr class="my-2">
                                        <li class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold">Total Amount</span>
                                            <span class="fw-semibold">$<?php echo number_format($total_amount); ?></span>
                                        </li>
                                    </ul>
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="bx bx-lock-alt me-1"></i>
                                            Your payment information is secure and encrypted
                                        </small>
                                    </div>
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
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Initialize Stripe with your Public Key
const stripe = Stripe('<?= STRIPE_PUBLISHABLE_KEY ?>'); 

// Create an instance of Stripe Elements
const elements = stripe.elements();
const cardElement = elements.create("card");
cardElement.mount("#card-element");

// Handle Form Submission
document.getElementById("payment-form").addEventListener("submit", async (event) => {
    event.preventDefault();
    
    const submitButton = document.getElementById("submit");
    submitButton.disabled = true;
    const messageDiv = document.getElementById("payment-message");
    
    const name = document.getElementById("customer_name").value;
    const email = document.getElementById("email").value;
    const amount = '<?php echo number_format($total_amount); ?>';

    if (!name || !email || !amount) {
        alert("Please fill in all fields.");
        submitButton.disabled = false;
        return;
    }

    // Add this validation before creating the payment intent
    const address_line1 = document.getElementById('customer_address_line1').value;
    const city = document.getElementById('customer_city').value;
    const state = document.getElementById('customer_state').value;
    const postal_code = document.getElementById('customer_postal_code').value;
    const phone = document.getElementById('contact_number').value;

    if (!address_line1 || !city || !state || !postal_code || !phone) {
        messageDiv.textContent = "Please fill in all billing details including complete address.";
        messageDiv.classList.remove("d-none");
        submitButton.disabled = false;
        return;
    }

    try {
        // Send data to backend to create PaymentIntent
        const response = await fetch("create_payment_intent.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                amount: parseInt(amount) * 100,
                currency: "usd",
                payment_method_types: ["card"],
                customer_name: name,
                receipt_email: email,
                description: "Product Payment"
            })
        });

        const { status, paymentIntent, message } = await response.json();
        
        if (status === "error") {
            messageDiv.textContent = `Error: ${message}`;
            messageDiv.classList.remove("d-none");
            submitButton.disabled = false;
            return;
        }

        // Confirm the card payment
        const { error, paymentIntent: confirmedPayment } = await stripe.confirmCardPayment(
            paymentIntent.client_secret,
            {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: name,
                        email: email,
                        address: {
                            line1: document.getElementById('customer_address_line1').value,
                            city: document.getElementById('customer_city').value,
                            state: document.getElementById('customer_state').value,
                            postal_code: document.getElementById('customer_postal_code').value,
                            country: document.getElementById('countryCode').value
                        },
                        phone: document.getElementById('contact_number').value
                    }
                }
            }
        );

        if (error) {
            messageDiv.textContent = `Payment failed: ${error.message}`;
            messageDiv.classList.remove("d-none");
        } else {
            switch (confirmedPayment.status) {
                case "requires_action":
                case "requires_source_action":
                    // Card requires authentication
                    messageDiv.textContent = "Authentication required...";
                    messageDiv.classList.remove("d-none");
                    
                    // Handle 3D Secure authentication
                    const { error: authError, paymentIntent: authenticatedPayment } = 
                        await stripe.confirmCardPayment(paymentIntent.client_secret);
                    
                    if (authError) {
                        messageDiv.textContent = `Authentication failed: ${authError.message}`;
                    } else if (authenticatedPayment.status === "succeeded") {
                        handlePaymentSuccess(authenticatedPayment);
                    }
                    break;
                    
                case "succeeded":
                    handlePaymentSuccess(confirmedPayment);
                    break;
                    
                default:
                    messageDiv.textContent = `Payment status: ${confirmedPayment.status}`;
                    messageDiv.classList.remove("d-none");
            }
        }
    } catch (err) {
        messageDiv.textContent = "An unexpected error occurred.";
        messageDiv.classList.remove("d-none");
        console.error("Payment error:", err);
    }
    
    submitButton.disabled = false;
});

// Helper function to handle successful payment
async function handlePaymentSuccess(confirmedPayment) {
    const messageDiv = document.getElementById("payment-message");
    messageDiv.textContent = "Payment successful! Your subscription is active until " + 
        new Date(confirmedPayment.created).toLocaleDateString();
    messageDiv.classList.remove("d-none");
    messageDiv.classList.remove("alert-danger");
    messageDiv.classList.add("alert-success");
    
    try {
        // Send subscription details to server
        const response = await fetch("confirm_payment.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                employer_id: '<?php echo $_SESSION['employer_id']; ?>',
                plan_id: document.getElementById('plan_id').value,
                amount_paid: '<?php echo $total_amount; ?>',
                payment_id: confirmedPayment.id,
                payment_status: confirmedPayment.status,
                num_recruiters: document.getElementById('num_recruiters').value
            })
        });

        const result = await response.json();
        // console.log('Server response:', result);
        
        if (result.status === "success") {
            messageDiv.textContent = "Payment successful! Your subscription is active until " + 
                new Date(result.subscription.end_date).toLocaleDateString();
            
            // Redirect after a short delay to show the message
            setTimeout(() => {
                window.location.href = "payment_success.php";
            }, 2000);
        } else {
            messageDiv.textContent = "Payment successful but failed to update subscription. Please contact support.";
            messageDiv.classList.remove("alert-success");
            messageDiv.classList.add("alert-danger");
        }
    } catch (err) {
        console.error("Error updating subscription:", err);
        messageDiv.textContent = "Payment successful but failed to update subscription. Please contact support.";
        messageDiv.classList.remove("alert-success");
        messageDiv.classList.add("alert-danger");
    }
}

</script>
<!-- <script>
document.addEventListener('DOMContentLoaded', async () => {
    const stripe = Stripe('pk_test_51MWsbSSI57XVj5p7zzra9QSnSh8gAwdC7QD74hD2QhSlgPWir99Yjjn2XeYMMs9jLZvJGVoqOL8M5xKa5Ecnjzq000gXgRNCKb');
    const form = document.getElementById('payment-form');
    const submitButton = document.getElementById('submit');
    const errorDiv = document.getElementById('error-message');

    // Step 1: Fetch PaymentIntent from backend
    try {
        const response = await fetch('process_payment.php', { 
            method: 'POST', 
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                customer_name: document.getElementById('customer_name').value,
                contact_number: document.getElementById('contact_number').value,
                countryCode: document.getElementById('countryCode').value,
                customer_address_line1: document.getElementById('customer_address_line1').value,
                customer_city: document.getElementById('customer_city').value,
                customer_state: document.getElementById('customer_state').value,
                customer_postal_code: document.getElementById('customer_postal_code').value,
                plan_id: document.getElementById('plan_id').value,
                num_recruiters: document.getElementById('num_recruiters').value
            })
        });
        const { client_secret } = await response.json();

        if (!client_secret) {
            errorDiv.textContent = "Error initializing payment.";
            return;
        }

        // Step 2: Create a Stripe Payment Element
        const elements = stripe.elements({ clientSecret: client_secret });
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        // Step 3: Handle Form Submission
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            submitButton.disabled = true;
            errorDiv.textContent = "";

            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: { return_url: "https://ki-careers.com/payment_success.php" }
            });

            if (error) {
                errorDiv.textContent = error.message;
                submitButton.disabled = false;
            }
        });
    } catch (error) {
        console.error("Error fetching payment intent:", error);
        errorDiv.textContent = "Payment initialization failed.";
    }
});
</script> -->


<script type="text/javascript">
    var current_country = '';
                const apiKey = "ZlkzaVR5cHRkaHkwRnNGQXlzVDRHWDVCT0w3NmxlOWtMaFk0NVNCdg==";
                const headers = new Headers();
                headers.append("X-CSCAPI-KEY", apiKey);

                const requestOptions = {
                    method: 'GET',
                    headers: headers,
                    redirect: 'follow'
                };

                // Fetch and populate countries with the specified format
                fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
                    .then(response => response.json())
                    .then(countries => {
                        const countrySelect = document.getElementById('countryCode');
                        countries.forEach(country => {
                            const option = document.createElement('option');
                            option.value = country.phonecode; // Use phone code as value
                            option.setAttribute('data-countryCode', country.iso2); // Set ISO code as data attribute
                            option.textContent = `${country.name} (+${country.phonecode})`; // Display country name with phone code
                            countrySelect.appendChild(option);
                        });
                    }).then(response => {
                        fetch('https://ipinfo.io/json?token=05d29092b4fb6b') // Replace with your ipinfo.io token
                            .then(response => response.json())
                            .then(data => {
                                // console.log(data.region)
                                const country = data.country; // e.g., "US", "IN", etc.
                                const select = document.getElementById('countryCode');
                                current_country = country;
                                console.log(current_country);
                                // Loop through options to find the matching country code
                                for (let i = 0; i < select.options.length; i++) {
                                    // console.log(select.options[i].dataset.countrycode)
                                    if (select.options[i].dataset.countrycode === country) {
                                        select.selectedIndex = i;
                                        break;
                                    }
                                }
                            })
                            .catch(error => console.log('Error fetching countries:', error));

                    })

    </script>

<!-- Add this JavaScript to handle card formatting -->
