<?php
include '../php/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomType = $_POST['room_type'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Query to check if the room is available
    $sql = "SELECT COUNT(*) as booked_rooms FROM bookings 
            WHERE room_type = ? 
            AND (checkin_date < ? AND checkout_date > ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $roomType, $checkout, $checkin);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Assuming total available rooms of this type are 5
    $totalRooms = 5;  
    $bookedRooms = $row['booked_rooms'];

    if ($bookedRooms < $totalRooms) {
        echo json_encode(["available" => true]);
    } else {
        echo json_encode(["available" => false]);
    }

    $stmt->close();
    $conn->close();
}
?>
