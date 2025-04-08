<?php
include("db_connect.php");
require_once '../vendor/autoload.php'; // Ensure "endroid/qr-code" is installed

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if (isset($_GET["booking_id"])) {
    $booking_id = $_GET["booking_id"];
    $booking_type = $_GET["booking_type"];

    switch ($booking_type) {
        case 'room':
            $table = 'bookings';
            break;
        case 'dining':
            $table = 'dining';
            break;
        case 'banquet':
            $table = 'banquet';
            break;
        default:
            die("Invalid booking type.");
    }

    // Update payment_status to 'success'
    $stmt = $conn->prepare("UPDATE $table SET payment_status = 'success' WHERE id = ?");
    $stmt->bind_param("s", $booking_id);
    $stmt->execute();

    if ($booking_type === 'room') {
        $query = "SELECT * FROM bookings WHERE id='$booking_id'";
        $result = $conn->query($query);
        $booking = $result->fetch_assoc();

        $customer_data = "Booking ID: " . $booking["id"] . "\n" .
                         "Booking Type: " . $booking_type . "\n" .
                         "Name: " . $booking["name"] . "\n" .
                         "Email: " . $booking["email"] . "\n" .
                         "Phone: " . $booking["phone"] . "\n" .
                         "Room: " . $booking["room_type"] . "\n" .
                         "Check-in: " . $booking["checkin_date"] . "\n" .
                         "Check-out: " . $booking["checkout_date"] . "\n" .
                         "Total Price: ₹ " . $booking["total_price"];

        $redirect_url = "../index.php";

    } elseif ($booking_type === 'banquet') {
        $query = "SELECT * FROM banquet WHERE id='$booking_id'";
        $result = $conn->query($query);
        $booking = $result->fetch_assoc();

        $customer_data = "Booking ID: " . $booking["id"] . "\n" .
                         "Booking Type: " . $booking_type . "\n" .
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
        $query = "SELECT * FROM dining WHERE id='$booking_id'";
        $result = $conn->query($query);
        $booking = $result->fetch_assoc();

        $customer_data = "Booking ID: " . $booking["id"] . "\n" .
                         "Booking Type: " . $booking_type . "\n" .
                         "Name: " . $booking["first_name"] . " " . $booking["last_name"]."\n" .
                         "Phone: " . $booking["contact"] . "\n" .
                         "Guests: " . $booking["guests"] . "\n" .
                         "Date: " . $booking["date"] . "\n" .
                         "Time: " . $booking["time"] . "\n" .
                         "Total Price: ₹" . $booking["total_price"];

        $redirect_url = "../dining.php";
    }

    // Generate QR Code
    $qrCode = new QrCode($customer_data);
    $writer = new PngWriter();
    $qrCodeImage = $writer->write($qrCode);

    // Save QR code image
    $qr_filename = "../qr_codes/".$booking_type."_BookingID_" . $booking_id . ".png";
    file_put_contents($qr_filename, $qrCodeImage->getString());

    // Insert QR code path into database
    $insert_qr_query = "INSERT INTO qr_codes (booking_id, qr_code_path) VALUES ('$booking_id', '$qr_filename')";
    $conn->query($insert_qr_query);
    $conn->close();

    // Redirect to success page with QR code info
    header("Location: success_qr.php?file=" . urlencode($qr_filename) . "&redirect_url=" . urlencode($redirect_url));
    exit;
}
?>
