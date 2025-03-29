<?php
include("db_connect.php");
require_once '../vendor/autoload.php'; // Ensure you install "endroid/qr-code" package

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if (isset($_GET["booking_id"])) {
    $booking_id = $_GET["booking_id"];

    // Fetch booking details
    $query = "SELECT * FROM bookings WHERE id='$booking_id'";
    $result = $conn->query($query);
    $booking = $result->fetch_assoc();

    $customer_data = "Booking ID: " . $booking["id"] . "\n" .
                     "Name: " . $booking["name"] . "\n" .
                     "Email: " . $booking["email"] . "\n" .
                     "Phone: " . $booking["phone"] . "\n" .
                     "Room: " . $booking["room_type"] . "\n" .
                     "Check-in: " . $booking["checkin_date"] . "\n" .
                     "Check-out: " . $booking["checkout_date"] . "\n" .
                     "Total Price: $" . $booking["total_price"];

    // Generate QR Code
    $qrCode = QrCode::create($customer_data)->setSize(300);
    $writer = new PngWriter();
    $qrCodeImage = $writer->write($qrCode);

    // Save QR code image
    $qr_filename = "../qr_codes/qr_" . $booking_id . ".png";
    file_put_contents($qr_filename, $qrCodeImage->getString());

    // Insert QR code path into database
    $insert_qr_query = "INSERT INTO qr_codes (booking_id, qr_code_path) VALUES ('$booking_id', '$qr_filename')";
    $conn->query($insert_qr_query);

    // Force download
    header("Content-Type: image/png");
    header("Content-Disposition: attachment; filename=qr_" . $booking_id . ".png");
    echo $qrCodeImage->getString();
    exit;
}

$conn->close();
?>
