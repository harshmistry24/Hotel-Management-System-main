<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "hotel_booking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the form is submitted properly
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['room_type']) || !isset($_POST['checkin']) || !isset($_POST['checkout'])) {
        die("<p style='color:red;'>Error: Missing form data.</p>");
    }

    // Retrieve form data
    $room_type = $_POST['room_type'];
    $checkin_date = $_POST['checkin'];
    $checkout_date = $_POST['checkout'];
    // $num_rooms = $_POST['num_rooms'];
    // $num_rooms = intval($_POST['num_rooms']);

    // Get total available rooms for the selected room type
    $roomQuery = $conn->prepare("SELECT total_rooms FROM rooms WHERE room_type = ?");
    $roomQuery->bind_param("s", $room_type);
    $roomQuery->execute();
    $roomResult = $roomQuery->get_result();

    if ($roomResult->num_rows > 0) {
        $roomData = $roomResult->fetch_assoc();
        $total_rooms = $roomData['total_rooms'];

        // Get number of booked rooms in the given date range
        // $bookQuery = $conn->prepare("SELECT SUM(num_rooms) as booked_room FROM bookings 
        //     WHERE room_type = ? AND NOT (checkout_date <= ? OR checkin_date >= ?)");
        $bookQuery = $conn->prepare("SELECT COUNT(*) as booked_room FROM bookings 
            WHERE room_type = ? AND NOT (checkout_date <= ? OR checkin_date >= ?)");
        $bookQuery->bind_param("sss", $room_type, $check_in, $check_out);
        $bookQuery->execute();
        $bookResult = $bookQuery->get_result();

        $bookedRooms = 0;
        if ($bookResult->num_rows > 0) {
            $bookedData = $bookResult->fetch_assoc();
            $bookedRooms = $bookedData['booked_rooms'] ?? 0;
        }

        // Calculate available rooms
        $available_rooms = $total_rooms - $bookedRooms;

        if ($available_rooms >= 1) {
            echo "Room is available!";
        } else {
            echo "Sorry no rooms are available.";
        }
    } else {
        echo "Invalid room type selected.";
    }
    //     if ($available_rooms >= $num_rooms) {
    //         echo "Rooms are available!";
    //     } else {
    //         echo "Sorry, only $available_rooms room(s) available.";
    //     }
    // } else {
    //     echo "Invalid room type selected.";
    // }
}

$conn->close();
?>
