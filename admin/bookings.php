<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: admin_login.html");
    exit();
}

include("includes/config.php");

// Cancel logic for all booking types
if (isset($_GET["cancel"]) && isset($_GET["type"])) {
    $id = $_GET["cancel"];
    $type = $_GET["type"];

    if ($type === "room") {
        $conn->query("DELETE FROM bookings WHERE id = $id");
    } elseif ($type === "banquet") {
        $conn->query("DELETE FROM banquet WHERE id = $id");
    } elseif ($type === "dining") {
        $conn->query("DELETE FROM dining WHERE id = $id");
    }

    header("Location: bookings.php");
    exit();
}

// Fetch bookings
$roomBookings = $conn->query("SELECT * FROM bookings WHERE payment_status = 'success'");
$banquetBookings = $conn->query("SELECT * FROM banquet WHERE payment_status = 'success'");
$diningBookings = $conn->query("SELECT * FROM dining WHERE payment_status = 'success'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<?php include 'admin_header.php'; ?>
<div class="content">
    <h2>Room Bookings</h2>
    <table border="2">
        <tr>
            <th>Booking ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Room Type</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $roomBookings->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['room_type']; ?></td>
                <td><?php echo $row['checkin_date']; ?></td>
                <td><?php echo $row['checkout_date']; ?></td>
                <td><?php echo $row['total_price']; ?></td>
                <td>
                    <a href="bookings.php?cancel=<?php echo $row['id']; ?>&type=room" onclick="return confirm('Cancel this room booking?');">Cancel</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br><br><br>
    <h2>Banquet Bookings</h2>
    <table border="2">
        <tr>
            <th>Booking ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Event</th>
            <th>Event Date</th>
            <th>Guests</th>
            <th>Days</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $banquetBookings->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['event_type']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['persons']; ?></td>
                <td><?php echo $row['days']; ?></td>
                <td><?php echo $row['total_price']; ?></td>
                <td>
                    <a href="bookings.php?cancel=<?php echo $row['id']; ?>&type=banquet" onclick="return confirm('Cancel this banquet booking?');">Cancel</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br><br><br>
    <h2>Dining Bookings</h2>
    <table border="2">
        <tr>
            <th>Booking ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Dining Date</th>
            <th>Time</th>
            <th>Guests</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $diningBookings->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td><?php echo $row['guests']; ?></td>
                <td><?php echo $row['total_price']; ?></td>
                <td>
                    <a href="bookings.php?cancel=<?php echo $row['id']; ?>&type=dining" onclick="return confirm('Cancel this dining booking?');">Cancel</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
