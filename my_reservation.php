<?php
session_start();
include 'db_connect.php'; // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.html"); // Redirect to login if not logged in
    exit();
}

$user_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <link rel="stylesheet" href="assets/css/my_reservation_st.css">
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<!-- Navigation Bar -->
<?php include 'header.php'; ?>

<div class="reservation-container">
    <h2>My Reservations</h2>

    <!-- Room Reservations -->
    <h3>Room Bookings</h3>
    <?php
    $query = "SELECT * FROM bookings WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    
    <?php if ($result->num_rows > 0): ?>
        <table class="reservation-table">
            <tr>
                <th>Booking ID</th>
                <th>Room Type</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Amount Paid</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['room_type']; ?></td>
                    <td><?php echo $row['checkin_date']; ?></td>
                    <td><?php echo $row['checkout_date']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No room bookings found.</p>
    <?php endif; ?>

    <!-- Banquet Reservations -->
    <h3>Banquet Bookings</h3>
    <?php
    $query = "SELECT * FROM banquet WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    
    <?php if ($result->num_rows > 0): ?>
        <table class="reservation-table">
            <tr>
                <th>Booking ID</th>
                <th>Event Type</th>
                <th>Date</th>
                <th>Persons</th>
                <th>Days</th>
                <th>Amount Paid</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['event_type']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['persons']; ?></td>
                    <td><?php echo $row['days']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No banquet bookings found.</p>
    <?php endif; ?>

    <!-- Dining Reservations -->
    <h3>Dining Bookings</h3>
    <?php
    $query = "SELECT * FROM dining WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    
    <?php if ($result->num_rows > 0): ?>
        <table class="reservation-table">
            <tr>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Guest Count</th>
                <th>Deposit Paid</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['guests']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No dining bookings found.</p>
    <?php endif; ?>

    <a href="home.php" class="back-btn">Back to Home</a>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>
