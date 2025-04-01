<?php
session_start();

$user_email = $_SESSION['user_email'];

include("db_connect.php");

if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('You must be logged in to book a table.');
    window.location.href='login.html';</script>"; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    // $email = $_POST["email"];
    $phone = $_POST["phone"];
    $room_type = $_POST["room_type"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];

    // Get price from the database
    $price_query = "SELECT price FROM rooms WHERE room_type='$room_type'";
    $result = $conn->query($price_query);
    $price_per_night = $result->fetch_assoc()["price"];

    // Calculate total price
    $days = (strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24);
    $total_price = $price_per_night * $days;

    // Insert booking into the database
    $query = "INSERT INTO bookings (name, email, phone, room_type, checkin_date, checkout_date, total_price)
              VALUES ('$name', '$user_email', '$phone', '$room_type', '$checkin', '$checkout', '$total_price')";

    if ($conn->query($query) === TRUE) {
        $booking_id = $conn->insert_id;
        // header("Location: ../php/checkout.php?booking_id=$booking_id&total=$total_price");
        $type = $_POST['type'] ?? 'room'; // Default to 'room' if not set

        // If the type is room, redirect or perform specific actions
        if ($type === 'room') {
            header("Location: ../php/process_payment.php?type=room&total=$total_price&booking_id=$booking_id");
            exit;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
