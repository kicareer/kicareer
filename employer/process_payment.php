<?php
require_once '../config.php';
require_once '../vendor/autoload.php';
require_once '../DbConnect.php';

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['payment_method'], $data['employer_id'], $data['plan_id'], $data['total_price'])) {
    echo json_encode(["success" => false, "error" => "Invalid request. Missing required fields."]);
    exit;
}

$payment_method = filter_var($data['payment_method'], FILTER_SANITIZE_STRING);
$employer_id = intval($data['employer_id']);
$plan_id = intval($data['plan_id']);
$total_price = floatval($data['total_price']);

try {
    $db = new DbConnect();
    $connection = $db->connect();

    // Check if employer already has an active subscription
    $stmt = $connection->prepare("SELECT id FROM subscriptions WHERE employer_id = :employer_id AND status = 'active'");
    $stmt->bindParam(":employer_id", $employer_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => false, "error" => "You already have an active subscription."]);
        exit;
    }

    // Create Stripe PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        "amount" => $total_price * 100, // Convert to cents
        "currency" => "usd",
        "payment_method" => $payment_method,
        "confirm" => true
    ]);

    if ($paymentIntent->status === "succeeded") {
        $stmt = $connection->prepare("
            INSERT INTO subscriptions (employer_id, plan_id, total_amount, status, start_date, end_date)
            VALUES (:employer_id, :plan_id, :total_amount, 'active', NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY))
        ");
        $stmt->bindParam(":employer_id", $employer_id);
        $stmt->bindParam(":plan_id", $plan_id);
        $stmt->bindParam(":total_amount", $total_price);
        $stmt->execute();

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Payment failed."]);
    }
} catch (Exception $e) {
    file_put_contents("payment_errors.log", "[" . date("Y-m-d H:i:s") . "] " . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(["success" => false, "error" => "Payment processing failed."]);
}
?>
