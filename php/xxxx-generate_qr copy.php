<?php
include("db_connect.php");
require_once '../vendor/autoload.php'; // Ensure you install "endroid/qr-code" package

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if (isset($_GET["booking_id"])) {
    $booking_id = $_GET["booking_id"];
    $booking_type = $_GET["booking_type"]; // Fetch booking type

    
    
    if ($booking_type === 'room') {
        // Fetch Room Booking Data
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
                         "Total Price: ₹ " . $booking["total_price"];

        $redirect_url = "../index.php";

    } elseif ($booking_type === 'banquet') {
        // Fetch banquet booking details
        $query = "SELECT * FROM banquet WHERE id='$booking_id'";
        $result = $conn->query($query);
        $booking = $result->fetch_assoc();

        $customer_data = "Booking ID: " . $booking["id"] . "\n" .
                         "Name: " . $booking["name"] . "\n" .
                         "Email: " . $booking["email"] . "\n" .
                         "Phone: " . $booking["phone"] . "\n" .
                         "Event Type: " . $booking["event_type"] . "\n" .
                         "Date: " . $booking["date"] . "\n" .
                         "Persons: " . $booking["persons"] . "\n" .
                         "Days: " . $booking["days"] . "\n" .
                         "Total Price: ₹" . $booking["total_price"];
                         
        $redirect_url = "../banquet.php";

    } elseif ($booking_type === 'dining') {
        // Fetch dining booking details
        $query = "SELECT * FROM dining WHERE id='$booking_id'";
        $result = $conn->query($query);
        $booking = $result->fetch_assoc();

        $customer_data = "Booking ID: " . $booking["id"] . "\n" .
                         "Name: " . $booking["first_name"] . " " . $booking["last_name"]."\n" .
                         "Phone: " . $booking["contact"] . "\n" .
                         "Guests: " . $booking["guests"] . "\n" .
                         "Date: " . $booking["date"] . "\n" .
                         "Time: " . $booking["time"] . "\n" .
                         "Total Price: ₹" . $booking["total_price"];

        $redirect_url = "../dining.php";

    }
                    

    // Generate QR Code
    // $qrCode = QrCode::create($customer_data)->setSize(300);
    $qrCode = new QrCode($customer_data); // Pass the data directly
    // $qrCode->setSize(300); // Set the size of the QR code
    $writer = new PngWriter();
    $qrCodeImage = $writer->write($qrCode);

    // Save QR code image
    $qr_filename = "../qr_codes/".$booking_type."_BookingID_" . $booking_id . ".png";
    file_put_contents($qr_filename, $qrCodeImage->getString());

    // Insert QR code path into database
    $insert_qr_query = "INSERT INTO qr_codes (booking_id, qr_code_path) VALUES ('$booking_id', '$qr_filename')";
    $conn->query($insert_qr_query);

    // Force download
    header("Content-Type: image/png");
    header("Content-Disposition: attachment; filename=".$booking_type." BookingID_" . $booking_id . ".png");
    echo $qrCodeImage->getString();

    exit;
}

$conn->close();
?>