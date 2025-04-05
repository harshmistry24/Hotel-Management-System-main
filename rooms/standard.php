<?php
include("../php/db_connect.php");

$room_type = "Standard";
$room_price = 0; // Default price

// Fetch dynamic pricing from the database
$query = "SELECT price FROM rooms WHERE room_type='$room_type'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $room_price = $row["price"];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Standard Room Booking</title>
    <link rel="stylesheet" href="../rooms/rooms_style.css">
</head>

<body>
    <div class="booking-container">
        <h2>Standard Room Booking</h2>

        <p id="availability-message" style="font-weight: bold; color: red;"></p>

        <p>Price per night: <span id="room-price-display"><?php echo $room_price; ?></span></p>
        <p id="total-price">Total Price: <?php echo $room_price; ?></p>

        <div class="form-box">
            <form action="../php/book_room.php" method="POST" onsubmit="return validateForm()">
                <input type="hidden" name="room_type" value="Standard">
                <input type="hidden" id="room-price" value="<?php echo $room_price; ?>">

                <label>Name:</label>
                <input type="text" name="name" required>

                <label>Phone:</label>
                <input type="text" name="phone" required>

                <label>Check-in Date:</label>
                <input type="date" name="checkin" id="checkin" required>

                <label>Check-out Date:</label>
                <input type="date" name="checkout" id="checkout" required>

                <input type="hidden" name="type" value="room">
                <button type="submit" id="submit-btn" class="disable-btn" disabled>Proceed to Payment</button>
            </form>

            <button onclick="history.back()" class="go-back-btn">Go Back</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let checkinInput = document.getElementById("checkin");
            let checkoutInput = document.getElementById("checkout");
            let totalPrice = document.getElementById("total-price");
            let roomPrice = parseFloat(document.getElementById("room-price").value);
            let availabilityMessage = document.getElementById("availability-message");
            let submitBtn = document.getElementById("submit-btn");

            //Disable button initially
            submitBtn.disabled = true;
            submitBtn.classList.add("disabled-btn"); 

            // Prevent past dates for check-in
            let today = new Date().toISOString().split("T")[0];
            checkinInput.setAttribute("min", today);

            checkinInput.addEventListener("change", function () {
                checkoutInput.value = ""; // Reset check-out date
                checkoutInput.setAttribute("min", checkinInput.value);
                checkAvailability();
            });

            checkoutInput.addEventListener("change", function () {
                calculatePrice();
                checkAvailability();
            });

            function calculatePrice() {
                let checkinDate = new Date(checkinInput.value);
                let checkoutDate = new Date(checkoutInput.value);

                if (checkinDate && checkoutDate && checkoutDate > checkinDate) {
                    let nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
                    totalPrice.textContent = "Total Price: " + (nights * roomPrice);
                }
            }

            function checkAvailability() {
                if (checkinInput.value && checkoutInput.value) {
                    let formData = new FormData();
                    formData.append("room_type", "Standard");
                    formData.append("checkin", checkinInput.value);
                    formData.append("checkout", checkoutInput.value);

                    fetch("../php/check_availability.php", {
                        method: "POST",
                        body: formData
                    })
                        .then(response => response.text())
                        .then(data => {
                            availabilityMessage.innerHTML = data;
                            if (data.includes("available")) {
                                availabilityMessage.style.color = "green";
                                // submitBtn.removeAttribute("disabled");
                                submitBtn.classList.remove("disabled-btn");
                            } else {
                                availabilityMessage.style.color = "red";
                                // submitBtn.setAttribute("disabled", "true");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            }
        });
    </script>
</body>

</html>