<?php
include '../config.php';
require '../vendor/autoload.php'; // Include the Stripe PHP SDK

// Set your Stripe secret key
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

header('Content-Type: application/json');

try {
    // Get JSON input
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Validate required fields
    if (empty($data['amount']) || empty($data['currency']) || empty($data['payment_method_types'])) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields: amount, currency, or payment_method_types']);
        http_response_code(400);
        exit;
    }

    // Validate amount is a positive integer
    if (!is_numeric($data['amount']) || intval($data['amount']) <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Amount must be a positive integer']);
        http_response_code(400);
        exit;
    }

    // Validate customer name
    if (empty($data['customer_name'])) {
        echo json_encode(['status' => 'error', 'message' => 'Customer name is required']);
        http_response_code(400);
        exit;
    }

    // Create a Stripe Customer
    $customer = \Stripe\Customer::create([
        'name' => $data['customer_name'],
        'address' => [
            'line1' => $data['customer_address_line1'] ?? '',
            'postal_code' => $data['customer_postal_code'] ?? '',
            'city' => $data['customer_city'] ?? '',
            'state' => $data['customer_state'] ?? '',
            'country' => $data['customer_country'] ?? 'IN', // Defaulting to India
        ],
    ]);

    // Create Payment Intent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => intval($data['amount']), // Amount in smallest currency unit (e.g., cents)
        'currency' => $data['currency'],
        'payment_method_types' => $data['payment_method_types'],
        'description' => $data['description'] ?? 'Payment for online service',
        'metadata' => array_merge($data['metadata'] ?? [], ['customer_name' => $data['customer_name']]),
        'receipt_email' => $data['receipt_email'] ?? null,
        'customer' => $customer->id,
    ]);

    // Return response
    echo json_encode(['status' => 'success', 'paymentIntent' => $paymentIntent]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    http_response_code(500);
} catch (\Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    http_response_code(500);
}
?>
