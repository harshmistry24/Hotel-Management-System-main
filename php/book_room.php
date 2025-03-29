<?php
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
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
              VALUES ('$name', '$email', '$phone', '$room_type', '$checkin', '$checkout', '$total_price')";

    if ($conn->query($query) === TRUE) {
        $booking_id = $conn->insert_id;
        header("Location: ../php/checkout.php?booking_id=$booking_id&total=$total_price");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
