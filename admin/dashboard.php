<?php
// session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: admin_login.html");
//     exit();
// }

include("includes/config.php");

// Fetch booking count
$booking_count = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count'];

// Fetch total rooms
$room_count = $conn->query("SELECT COUNT(*) as count FROM rooms")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="content">
        <h2>Dashboard</h2>
        <div class="cards">
            <div class="card">
                <i class="fas fa-bed"></i>
                <h3>Bookings</h3>
                <p><?php echo $booking_count; ?></p>
            </div>

            <div class="card">
                <i class="fas fa-hotel"></i>
                <h3>Total Rooms</h3>
                <p><?php echo $room_count; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
