<?php

// require '../vendor/autoload.php';
require '../vendor/stripe/stripe-php/init.php'; // Include Stripe's PHP library

\Stripe\stripe::setApiKey("sk_test_51R8dzFIxncSbJ9pLAhdwpqk2UYMg6SGmUmqXfM8bCwhG9QhfTEdz1CrswNTgxt2miteRO9FqhVGZ58pK3QE774yn00XXso5PN7");

header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
$amount = $input['amount'];
$booking_type = $input['booking_type']; // Fetch booking type
$booking_id = $input['booking_id']; // Fetch booking ID
//For debugging
if ($amount <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid amount"]);
    exit;
}

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'inr',
                'product_data' => ['name' => 'Hotel Booking Payment'],
                'unit_amount' => $amount,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => "http://localhost/workspace/Hotel/room_booking/php/generate_qr.php?booking_id=$booking_id&booking_type=$booking_type",
        'cancel_url' => 'http://localhost/workspace/Hotel/room_booking/payment_failed.php',
    ]);

    echo json_encode(['id' => $session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
