<?php
session_start();
require 'db_connect.php'; // Database connection

// header('Content-Type: application/json'); // Set the response content type to JSON


// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    die("You must be logged in to proceed with payment.");
}

$user_email = $_SESSION['user_email'];
$booking_type = $_GET['type']; // Determine the booking type (room, banquet, dining)
// $booking_id = $_GET['booking_id']; // Get the booking ID from the URL
$booking_id = '';

// Fetch the amount based on booking type
$amount = 0;

if ($booking_type === 'room') {
    $query = "SELECT id, total_price FROM bookings WHERE email = ? ORDER BY created_at DESC LIMIT 1";
} elseif ($booking_type === 'banquet') {
    $query = "SELECT id, total_price FROM banquet WHERE email = ? ORDER BY created_at DESC LIMIT 1";
} elseif ($booking_type === 'dining') {
    $query = "SELECT id, total_price FROM dining WHERE email = ? ORDER BY created_at DESC LIMIT 1";
} else {
    // die("Invalid booking type.");
    echo json_encode(['error' => 'Invalid booking type.']);
    exit;
}

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $amount = $row['total_price'];
    $booking_id = $row['id'];
}
$stmt->close();

// If amount is zero, stop processing
if ($amount <= 0) {
    // die("No valid booking found for payment.");
    echo json_encode(['error' => 'No valid booking found for payment.']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        button {
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pay with Stripe</h2>
        <p>Amount: ₹<?php echo number_format($amount, 2); ?></p>
        <button id="payButton">Pay Now</button>
    </div>

    <script>
        const stripe = Stripe("pk_test_51R8dzFIxncSbJ9pLjA9CJzGHuhzSEBXVCsqyYU5D88Yw3nqMfKArVoZHoHFUtcNUEH43ONMsXFqfpbY4yr6xoIN100Aka9mqzz");

        document.getElementById("payButton").addEventListener("click", async () => {
            console.log("Pay button clicked"); // Debugging
            const amount = <?php echo $amount * 100; ?>; // Convert to paisa
            console.log("Amount to be paid:", amount); // Debugging

        //  try{   
            const response = await fetch("../php/create_checkout_session.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ amount: amount, booking_type: "<?php echo $booking_type; ?>", booking_id: "<?php echo $booking_id; ?>" })
            });

            if (!response.ok) {
                    throw new Error("Network response was not ok");
                }

            const session = await response.json();
            console.log("Stripe session response:", session); // Debugging
            if (session.id) {
                stripe.redirectToCheckout({ sessionId: session.id });
            } else {
                alert("Payment failed, please try again.");
            }

        //  } catch (error) {
        //         console.error("Error:", error);
        //         alert("An error occurred. Please check the console.");
        //     }
        });
    </script>
</body>
</html>
