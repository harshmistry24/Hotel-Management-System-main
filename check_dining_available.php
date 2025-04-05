<?php
include 'db_connect.php';

header('Content-Type: application/json'); //Tell browser its json

$date = $_GET['date'];
$selected_time = $_GET['time'];

if (!$date || !$selected_time) {
    echo json_encode(["available" => false, "error" => "Invalid input."]);
    exit;
}

// Fetch the dining capacity limit
$capacity_query = "SELECT dining_capacity FROM banquet_dining_set WHERE id=1";
$capacity_result = $conn->query($capacity_query);
if ($capacity_result->num_rows === 0) {
    echo json_encode(["available" => false, "error" => "Capacity setting not found."]);
    exit;
}
$row = $capacity_result->fetch_assoc();
$max_capacity = $row["dining_capacity"];

// Calculate time range (2 hours before and after selected time)
$time_start = date("H:i:s", strtotime($selected_time . " -2 hours"));
$time_end = date("H:i:s", strtotime($selected_time . " +2 hours"));

// Get count of bookings within the time range
$check_query = "SELECT COUNT(*) AS total_bookings FROM dining WHERE date = ? AND time BETWEEN ? AND ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("sss", $date, $time_start, $time_end);
$stmt->execute();
$result = $stmt->get_result();
$booked_data = $result->fetch_assoc();
$current_bookings = $booked_data['total_bookings'] ?? 0;

// Check if capacity is reached
$available = $current_bookings < $max_capacity;

echo json_encode(["available" => $available]);

$conn->close();
?>