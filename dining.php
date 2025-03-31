<?php
include 'db_connect.php';

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

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO dining (first_name, last_name, contact, guests, date, time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $full_contact, $guests, $date, $time);

    if ($stmt->execute()) {
        echo "<script>alert('Booking confirmed!'); 
        window.location.href='dining.php';</script>";
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
    <title>Restaurant Booking</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .table-booking-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: left;
        }
        h2 {
            color: #d35400;
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
            background-color: #d35400;
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
            background-color: #e67e22;
        }
    </style>
</head>
<body>
    <div class="table-booking-container">
        <h2>Reserve Your Table</h2>
        <form method="post" action="./dining.php">
            <div class="booking-grid">
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="input-group">
                    <select name="country_code">
                        <option>+91</option>
                        <option>+1</option>
                        <option>+44</option>
                        <option>+61</option>
                    </select>
                    <input type="tel" name="contact" id="contact" placeholder="Contact Number" required>
                </div>
                <div class="input-group">
                    <input type="number" name="guests" placeholder="Number of Guests" min="1" required>
                </div>
                <div class="input-group">
                    <input type="date" name="date" required>
                    <input type="time" name="time" min="09:00" max="23:00" required>
                </div>
                <button type="submit" class="book-now">Book Now</button>
            </div>
        </form>
        <p id="confirmation" style="color: green; margin-top: 10px; text-align: center;"></p>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            let firstName = document.querySelector("input[name='first_name']").value;
            let lastName = document.querySelector("input[name='last_name']").value;
            let contact = document.querySelector("input[name='contact']").value;
            let guests = document.querySelector("input[name='guests']").value;
            let date = document.querySelector("input[name='date']").value;
            let time = document.querySelector("input[name='time']").value;

            if (!firstName || !lastName || !contact || !guests || !date || !time) {
                event.preventDefault();
                document.getElementById("confirmation").innerText = "⚠️ Please fill all details correctly.";
            }
        });
    </script>

    <!-- Footer -->
    <?php include 'footer.php' ?>
</body>
</html>
