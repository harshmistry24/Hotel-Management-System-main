<?php
include("db_connect.php");
$booking_id = $_GET['booking_id'];
$query = "SELECT * FROM bookings WHERE id = $booking_id";
$result = $conn->query($query);
$data = $result->fetch_assoc();
$amount = $data['total_price'];
?>
<h2>Pay for Booking #<?php echo $booking_id; ?></h2>
<p>Total Amount: $<?php echo $amount; ?></p>
<form action='generate_qr.php' method='POST'>
    <input type='hidden' name='id' value='<?php echo $booking_id; ?>'>
    <button type='submit'>Pay Now</button>
</form>
