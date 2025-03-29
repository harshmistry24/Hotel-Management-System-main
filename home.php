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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation bar</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    a{
        color: aliceblue;
        text-decoration: none;

    }
</style>
</head>

    <nav class="navbar">
        <div class="logo">
            <img src="logo.jpg" alt="The President LOGO">
            <span>The<strong> President</strong></span>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Room</a></li>
            <li><a href="#">Banquet Hall</a></li>
            <li><a href="#">Dining</a></li>
            <li><a href="#">Food</a></li>
            <li><a href="#">My Reservations</a></li>
        </ul>
        <div class="nav-buttons">
            <button class="signin-btn"><i class="fas fa-user"></i>    
                <a href="http://localhost/HMS Project/logout.php">Logout</a>
            </button>
        </div>
    </nav>

    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="login-link">Logout</a>
    <?php else: ?>
        <!-- <a href="http://localhost/HMS Project/login.html" class="login-link">Login</a> -->
    <?php endif; ?>

</body>
</html>
