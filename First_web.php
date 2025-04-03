<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation bar</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        a {
            color: aliceblue;
            text-decoration: none;
        }

        a:hover {
            color: #f0c040;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="HMSimages/1logo.png" alt="The President LOGO">
                <!-- <span>The<strong> President</strong></span> -->
            </div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="index.php">Rooms</a></li>
                <li><a href="banquet.php">Banquet Hall</a></li>
                <li><a href="dining.php">Dining</a></li>
                <li><a href="food_menu.php">Food</a></li>
                <li><a href="my_reservation.php">My Reservations</a></li>
            </ul>
            <div class="nav-buttons">
                <button class="signin-btn"><i class="fas fa-user"></i>
                    <a href="http://localhost/workspace/Hotel/room_booking/login.html" style="color: aliceblue; text-decoration:none;">SIGN IN</a>
                </button>
            </div>
            <div class="menu-icon" id="menu-icon">&#9776;</div> <!-- Three-line menu button -->
        </nav>

        <!-- Sidebar menu -->
        <div class="sidebar" id="sidebar">
            <span class="close-btn" id="close-btn">&times;</span>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="index.php">Rooms</a></li>
                <li><a href="banquet.php">Banquet Hall</a></li>
                <li><a href="dining.php">Dining</a></li>
                <li><a href="food_menu.php">Food</a></li>
                <li><a href="my_reservation.php">My Reservation</a></li>
                <button class="sidebar-signin-btn"><i class="fas fa-user"></i>
                    <a href="http://localhost/workspace/Hotel/room_booking/login.html" style="color: aliceblue; text-decoration:none;">SIGN IN</a>
                </button>
            </ul>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
              let menuIcon = document.getElementById("menu-icon");
              let sidebar = document.getElementById("sidebar");
              let closeBtn = document.getElementById("close-btn");

            menuIcon.addEventListener("click", function () {
                sidebar.classList.add("active");
            });

            closeBtn.addEventListener("click", function () {
                sidebar.classList.remove("active");
            });
            });
        </script>

    </header>

    <div class="welcome-text">
        <h1>Welcome to <strong>The President</strong></h1>
        <p>Experience luxury, comfort, and elegance at our hotel.</p>
    </div>

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

    <div class="rooms">
        <div class="room">
            <img src="HMSimages/duplex.jpg" alt="deluxe room" width="250" height="250" />
            <h2>Deluxe Room</h2>
            <p>Luxury and comfort.</p>
        </div>
        <div class="room">
            <img src="HMSimages/suite.png" alt="suite room" width="250" height="250" />
            <h2>Suite</h2>
            <p>Spacious and elegant.</p>
        </div>
        <div class="room">
            <img src="HMSimages/6.png" alt="Standard room" width="250" height="250" />
            <h2>Standard Room</h2>
            <p>Affordable and cozy.</p>
        </div>
    </div>

    <section class="services">
        <h2>Our Services</h2>
        <p class="services-subtitle">Exceptional Experiences</p>
        <p class="services-description">
            Indulge in a world of amenities and services designed to elevate your stay from ordinary to extraordinary.
        </p>
        <div class="services-container">
            <div class="service-box">
                <i class="fas fa-bed"></i>
                <h3>Luxury Accommodation</h3>
                <p>Experience unparalleled comfort in our meticulously designed rooms and suites, featuring premium
                    amenities and elegant furnishings.</p>
            </div>
            <div class="service-box">
                <i class="fas fa-utensils"></i>
                <h3>Gourmet Dining</h3>
                <p>Indulge your palate at our award-winning restaurants, offering exquisite culinary creations using the
                    finest local and international ingredients.</p>
            </div>
            <div class="service-box">
                <i class="fas fa-spa"></i>
                <h3>Spa & Wellness</h3>
                <p>Rejuvenate your body and mind at our premium spa, featuring a comprehensive range of treatments,
                    thermal experiences, and fitness facilities.</p>
            </div>
            <div class="service-box">
                <i class="fas fa-bell-concierge"></i>
                <h3>Concierge Service</h3>
                <p>Our dedicated concierge team is available 24/7 to assist with any request, from restaurant
                    reservations to exclusive local experiences.</p>
            </div>
        </div>
    </section>


   <!-- footer -->
    <?php include 'footer.php' ?>
</body>

</html>