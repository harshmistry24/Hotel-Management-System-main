<?php
// session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: index.php");
//     exit();
// }

include("includes/config.php");

//Delete the booking
if (isset($_GET["cancle"])) {
    $id = $_GET["cancle"];
    $conn->query("DELETE FROM bookings WHERE id=$id");
    header("Location: bookings.php");
}

$bookings = $conn->query("SELECT * FROM bookings");
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
        <h2>Manage Bookings</h2>
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
            <?php while ($row = $bookings->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo $row['checkin_date']; ?></td>
                    <td><?php echo $row['checkout_date']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                    <td><a href="bookings.php?cancle=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel</a></td>
                    </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
