<?php
session_start();

// Auto-logout if inactive for more than 1 hour
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    session_unset(); 
    session_destroy();
    header("Location: login.html?session_expired=true");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
 
 
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>

<body>
        <!-- Header -->
    <?php include 'header.php' ?>

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

    <!--Note: include the logout part form the 'old_home.php' at the end -->
</body>

</html>
