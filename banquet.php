<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['date']) && !empty($_POST['persons']) && !empty($_POST['eventType']) && !empty($_POST['days']) && !empty($_POST['totalRent'])) {
        $date = $_POST['date'];
        $persons = $_POST['persons'];
        $eventType = $_POST['eventType'];
        $days = $_POST['days'];
        $totalRent = $_POST['totalRent'];

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
        $stmt = $conn->prepare("INSERT INTO banquet (date, persons, event_type, days, total_rent) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisis", $date, $persons, $eventType, $days, $totalRent);

        if ($stmt->execute()) {
            echo "<script>alert('Booking confirmed!'); 
            window.location.href='payment.html';</script>";
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
    <style>
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

        button { 
            width: 100%; 
            padding: 10px; 
            background: #28a745; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px; 
            transition: background 0.3s;
        }

        button:hover { 
            background: #218838; 
        }
    </style>
    
</head>
<body>
    <p class="welcome-text">Welcome to our luxurious banquet hall. Perfect for weddings, parties & corporate events.</p>

    <div class="container">
        <h1>Banquet Hall Booking</h1>
        <p>Capacity: Up to 1000 people</p>

        <p class="rent">Rent per day: ₹5000</p>

        <h2>Book Now</h2>
        <form action="" method="POST" onsubmit="return validateForm()">
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
            <p class="rent">Total Rent: ₹<span id="totalRentDisplay">5000</span></p>
            <input type="hidden" id="totalRent" name="totalRent" value="5000">
            <button type="submit">Book Now</button>
        </form>
    </div>

    <script>
        function calculateRent() {
            let days = document.getElementById("days").value;
            let rentPerDay = 5000;
            let totalRent = days * rentPerDay;
            document.getElementById("totalRentDisplay").innerText = totalRent;
            document.getElementById("totalRent").value = totalRent;
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
            let persons = document.getElementById("persons").value;
            let eventType = document.getElementById("eventType").value;
            let days = document.getElementById("days").value;
            let totalRent = document.getElementById("totalRent").value;

            if (!date) {
                alert("Please select a booking date.");
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
            if (!totalRent || totalRent < 5000) {
                alert("Invalid rent amount.");
                return false;
            }
            return true;
        }
    </script>

    <?php include 'footer.php' ?>
</body>
</html>
