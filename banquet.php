<?php
session_start();

$user_email = $_SESSION['user_email'];

include 'db_connect.php';

if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('You must be logged in to book a table.');
    window.location.href='login.html';</script>"; 
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name']) && !empty($_POST['date']) && !empty($_POST['persons']) && !empty($_POST['eventType']) && !empty($_POST['days'])) {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $persons = $_POST['persons'];
        $eventType = $_POST['eventType'];
        $days = $_POST['days'];

        $price_query = "SELECT banquet_price FROM banquet_dining_set WHERE id=1";
        $result = $conn->query($price_query);
        $banquet_rent = $result->fetch_assoc()["banquet_price"];

        // Check if a booking already exists for the selected date
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM banquet WHERE date = ?");
        $checkStmt->bind_param("s", $date);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo "<script>alert('The banquet hall is already booked on this date. Please choose another date.'); window.history.back();</script>";
            exit();
        }

        // Insert new booking if no booking exists for that date
        $stmt = $conn->prepare("INSERT INTO banquet (name, email, date, persons, event_type, days, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi",$name, $user_email, $date, $persons, $eventType, $days, $banquet_rent);

        if ($stmt->execute()) {
            $booking_id = $conn->insert_id;

            $type = $_POST['type'] ?? 'banquet'; // Default to 'banquet' if not set
            // If the type is banquet, redirect or perform specific actions
            if ($type === 'banquet') {
                header("Location: php/process_payment.php?type=banquet&booking_id=$booking_id");
                exit();
        }

        // echo "<script>alert('Booking confirmed!');</script>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error: All fields are required!'); window.history.back();</script>";
    }
}

$conn->close();
?>

<?php include 'header.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banquet Hall Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="nav.css">
    <!-- <link rel="stylesheet" href="assets/image_slider.css"> -->
    <style>

        /* IMAGE SLIDER STYLES */
        .slider-container {
            width: 90%;
        /* Reduce width slightly to create space */
        max-width: 1200px;
        /* Prevents slider from becoming too wide on large screens */
        height: 500px;
        /* Adjust as needed */
        overflow: hidden;
        position: relative;
        margin: 30px auto;
        /* Adds space around and centers the slider */
        border-radius: 15px;
        /* Optional: Adds rounded corners */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        /* Optional: Adds a shadow for better visibility */
        }

        .slider {
        display: flex;
        width: 100%;
        height: 100%;
        transition: transform 0.8s ease-in-out;
        }

        .slide {
        min-width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        }

        .slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensures image fully covers the slide */
        border-radius: 15px;
        /* Matches container for a smooth look */
        }

      .prev,
      .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        font-size: 20px;
        }

      .prev {
        left: 10px;
        }

      .next {
        right: 10px;
      }

        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f4f4f4;
         }

        .welcome-text {
            font-family: 'Playfair Display', serif;
            font-size: 50px;
            font-weight: bold;
            color: #444;
            margin-right: 30px;
            margin-left: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .container { 
            max-width: 800px;
            margin: 50px auto; 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            text-align: center; 
        }

        h1, h2 { 
            color: #333; 
        }

        .form-group { 
            margin: 15px 0; 
            text-align: left; 
        }

        label { 
            display: block; 
            margin-bottom: 5px; 
            font-weight: bold; 
        }

        input { 
            width: calc(100% - 16px); 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px;
        }
        
        .rent { 
            font-size: 20px; 
            font-weight: bold; 
            color: green; 
        }

        .book-btn { 
            width: 100%; 
            padding: 10px; 
            /* Rose Gold color (below) */
            /* background: #b76e79;  */
            /* Burnt Sienna color (below) */
            /* background: #e97451;  */
            background: #da9110; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px; 
            transition: background 0.3s;
        }

        .book-btn:hover { 
            background:rgb(191, 123, 5); 
        }
    </style>
    
</head>
<body>
    <p class="welcome-text">Welcome to our luxurious banquet hall. Perfect for weddings, parties & corporate events.</p>

     <!-- IMAGE SLIDER -->
     <div class="slider-container">
        <div class="slider">
            <div class="slide"><img src="HMSimages/6.png" alt="Luxury Hotel"></div>
            <div class="slide"><img src="HMSimages/duplex.jpg" alt="Comfortable Rooms"></div>
            <div class="slide"><img src="HMSimages/a1.jpg" alt="Amazing Views"></div>
            <div class="slide"><img src="HMSimages/a1.jpg" alt="Amazing Views"></div>
            <div class="slide"><img src="HMSimages/a1.jpg" alt="Amazing Views"></div>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>

    <!--js for slider -->
    <script src="assets/js/image_slide.js"></script>


    <div class="container">
        <h1>Banquet Hall Booking</h1>
        <p>Capacity: Up to 1000 people</p>

        <p class="rent">Rent per day: ₹<span id="rentPerDayDisplay">5000</span></p>
        <h2>Book Now</h2>
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="date">Booking Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="persons">Number of Persons:</label>
                <input type="number" id="persons" name="persons" min="1" max="1000" oninput="validatePersons()" required>
            </div>
            <div class="form-group">
                <label for="eventType">Event Type:</label>
                <input type="text" id="eventType" name="eventType" required>
            </div>
            <div class="form-group">
                <label for="days">Number of Days:</label>
                <input type="number" id="days" name="days" min="1" value="1" oninput="calculateRent()" required>
            </div>
            <p class="rent">Total Rent: ₹<span id="totalRentDisplay">Loading...</span></p>
            <input type="hidden" name="type" value="banquet">
            <button type="submit" class="book-btn">Book Now</button>
        </form>
    </div>

    <script>
       // Global variable to hold the rent per day value
       let rentPerDay = 0;

        // Fetch rent dynamically from the server
        async function fetchRent() {
            try {
                const response = await fetch("php/get_banquet_rent.php"); // Path to your PHP file
                if (!response.ok) throw new Error("Failed to fetch rent");

                // Update rentPerDay globally
                rentPerDay = parseInt(await response.text());
                document.getElementById("rentPerDayDisplay").textContent = rentPerDay;

                // Call calculateRent() after fetching rent
                calculateRent();
            } catch (error) {
                console.error("Error fetching rent:", error);
                document.getElementById("rentPerDayDisplay").textContent = "Error fetching rent";
            }
        }

        // Calculate and update total rent based on the number of days
        function calculateRent() {
            let days = document.getElementById("days").value;
            let totalRent = days * rentPerDay;
            document.getElementById("totalRentDisplay").textContent = totalRent;
        }
        
        function validatePersons() {
            let persons = document.getElementById("persons").value;
            if (persons > 1000) {
                alert("Number of persons exceeds the limit of 1000!");
                document.getElementById("persons").value = 1000;
            }
        }
        
        function validateForm() {
            let date = document.getElementById("date").value;
            let name = document.getElementById("name").value;
            let persons = document.getElementById("persons").value;
            let eventType = document.getElementById("eventType").value;
            let days = document.getElementById("days").value;
            // let totalRent = document.getElementById("totalRent").value;

            if (!date) {
                alert("Please select a booking date.");
                return false;
            }
            if (!name) {
                alert("Please enter a name.");
                return false;
            }
            if (!persons || persons < 1) {
                alert("Please enter a valid number of persons.");
                return false;
            }
            if (!eventType) {
                alert("Please enter the event type.");
                return false;
            }
            if (!days || days < 1) {
                alert("Please enter a valid number of days.");
                return false;
            }
           
            return true;
        }

        // Fetch rent on page load
        window.onload = fetchRent;
    </script>

    <?php include 'footer.php' ?>
</body>
</html>
