<?php
include("db_connect.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    echo "<p style='color: red; text-align: center;'>Please log in to view your reservations.</p>";
    exit();
}

$user_email = $_SESSION['user_email'];

// Fetch user bookings from the database
$query = "SELECT * FROM bookings WHERE email = '$user_email'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Reservation Button */
        .reservation-btn {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
            margin: 20px;
        }

        .reservation-btn:hover {
            background: #0056b3;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: auto;
        }

        /* Modal Content */
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            text-align: center;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Close Button */
        .close-btn {
            float: right;
            font-size: 28px;
            cursor: pointer;
            color: #333;
        }

        .close-btn:hover {
            color: red;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        td {
            background: #f9f9f9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .modal-content {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<!-- My Reservations Button -->
<button onclick="openModal()" class="reservation-btn">My Reservations</button>

<!-- Modal -->
<div id="reservationModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Your Reservations</h2>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Room Type</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Total Price</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['room_type']; ?></td>
                <td><?php echo $row['checkin_date']; ?></td>
                <td><?php echo $row['checkout_date']; ?></td>
                <td>₹<?php echo $row['total_price']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
function openModal() {
    document.getElementById("reservationModal").style.display = "block";
}

function closeModal() {
    document.getElementById("reservationModal").style.display = "none";
}

// Close modal on clicking outside
window.onclick = function(event) {
    let modal = document.getElementById("reservationModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
</script>

</body>
</html>
