<?php
session_start();
include 'db_connect.php';
//upload the email of logged in user to database
if (!isset($_SESSION['user_email'])) {
    echo "<script>alert('You must log in.');
    window.location.href='login.html';</script>"; 
}

$user_email = $_SESSION['user_email'];
// //debugging
// echo "logged in as :".$user_email;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $country_code = $_POST['country_code'];
    $contact = $_POST['contact'];
    $guests = $_POST['guests'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Combine country code and contact number
    $full_contact = $country_code . $contact;

    $price_query = "SELECT dining_deposit FROM banquet_dining_set WHERE id=1";
    $result = $conn->query($price_query);
    $dining_deposit = $result->fetch_assoc()["dining_deposit"];
    
     // Validate date (should not be in the past)
     $current_date = date("Y-m-d");
     if ($date < $current_date) {
         echo "<script>alert('Invalid date! Please select a valid date.');
         window.history.back();</script>";
         exit();
     }

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO dining (first_name, last_name, email, contact, guests, date, time, total_price) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sssssssi", $first_name, $last_name, $user_email, $full_contact, $guests, $date, $time, $dining_deposit);

    //booking confirmation
    if ($stmt->execute()) {
        $type = $_POST['type'] ?? 'dining'; // Default to 'dining' if not set

        // If the type is dining, redirect or perform specific actions
        if ($type === 'dining') {
            header("Location: php/process_payment.php?type=dining");
            exit;
        }

        // echo "<script>alert('Booking confirmed!')</script>"; 
        // echo "<script>window.location.href='php/process_payment.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- Navigation bar -->
<?php include 'header.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Dining Booking</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="assets/image_slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="assets/css/dining_style.css"> -->

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
            margin-bottom: 30px;
            text-align: center;
        }
        .welcome-text-2 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: bold;
            color: #444;
            margin-bottom: 30px;
            text-align: center;
        }
        .table-booking-container {
            max-width: 500px;
            margin: 50px auto; 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            text-align: center; 
        }
        h2 {
            color:rgb(0, 0, 0);
            text-align: center;
        }
        .booking-grid {
            display: grid;
            gap: 10px;
        }
        .label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .input-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        select {
            width: 20%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #contact {
            width: 80%;
        }
        .book-now {
            background: #da9110; 
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
            width: 100%;
            margin-top: 15px;
        }
        .book-now:hover {
            background:rgb(191, 123, 5); 
        }
    </style>
</head>
<body>

<p class="welcome-text">"Where Every Bite Becomes a Memory."</p>
<p class="welcome-text-2">Treat yourself to a culinary journey with dishes crafted to perfection. Reserve your table today at The President.</p>


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

    <div class="table-booking-container">
        <h2>Reserve Your Table</h2>
        <form method="post" action="">
            <div class="booking-grid">
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="input-group">
                    <input type="tel" name="contact" id="contact" placeholder="Contact Number" maxlength="10" pattern="[6-9][0-9]{9}" required title="Please enter a valid 10-digit mobile number">
                </div>
                <div class="input-group">
                    <input type="number" name="guests" placeholder="Number of Guests" min="1" max="10" required>
                </div>
                <div class="input-group">
                    <input type="date" name="date" required>
                    <input type="time" name="time" min="09:00" max="23:00" required>
                </div>
                <input type="hidden" name="type" value="dining">
                <button type="submit" class="book-now" >Book Now</button>
            </div>
        </form>
        <p id="confirmation" style="color: red; margin-top: 10px; text-align: center;"></p>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            let firstName = document.querySelector("input[name='first_name']").value;
            let lastName = document.querySelector("input[name='last_name']").value;
            let contact = document.querySelector("input[name='contact']").value;
            let guests = document.querySelector("input[name='guests']").value;
            let date = document.querySelector("input[name='date']").value;
            let time = document.querySelector("input[name='time']").value;

            let today = new Date().toISOString().split("T")[0]; // Get today's date in YYYY-MM-DD format

            if (!firstName || !lastName || !contact || !guests || !date || !time) {
                event.preventDefault();
                document.getElementById("confirmation").innerText = "⚠️ Please fill all details correctly.";
            }else if (date < today) {
                event.preventDefault();
                document.getElementById("confirmation").innerText = "⚠️ Invalid date! Please select a valid date.";
    }
        });
    </script>

    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>
</html>
