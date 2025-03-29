<?php
include("db_connect.php");

if (isset($_GET["booking_id"])) {
    $booking_id = $_GET["booking_id"];
    $transaction_id = uniqid("TXN_");

    // Get total price
    $query = "SELECT total_price FROM bookings WHERE id='$booking_id'";
    $result = $conn->query($query);
    $total_price = $result->fetch_assoc()["total_price"];

    // Insert payment record
    $payment_query = "INSERT INTO payments (booking_id, transaction_id, payment_amount)
                      VALUES ('$booking_id', '$transaction_id', '$total_price')";
    $conn->query($payment_query);

    // Update booking status
    $update_query = "UPDATE bookings SET payment_status='Completed' WHERE id='$booking_id'";
    $conn->query($update_query);

    // Generate QR Code
    header("Location: generate_qr.php?booking_id=$booking_id");
} else {
    echo "Invalid request.";
}

$conn->close();
?>
