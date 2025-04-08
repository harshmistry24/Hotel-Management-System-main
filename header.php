<header>
        <nav class="navbar">
            <div class="logo">
                <a href="home.php">
                    <img src="HMSimages/1logo.png" alt="The President LOGO">
                </a>
                <!-- <span>The<strong> President</strong></span> -->
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="index.php">Rooms</a></li>
                <li><a href="banquet.php">Banquet Hall</a></li>
                <li><a href="dining.php">Dining</a></li>
                <li><a href="food_menu.php">Food</a></li>
                <li><a href="my_reservation.php">My Reservations</a></li>
                </ul>
            <div class="nav-buttons">
                <button class="signin-btn"><i class="fas fa-user"></i>
                    <a href="http://localhost/workspace/Hotel/room_booking/logout.php" style="color: aliceblue; text-decoration: none;">Logout</a>
                </button>
            </div>

            <div class="menu-icon" id="menu-icon">&#9776;</div> <!-- Three-line menu button -->
        </nav>

        <!-- Sidebar menu -->
        <div class="sidebar" id="sidebar">
            <span class="close-btn" id="close-btn">&times;</span>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="index.php">Rooms</a></li>
                <li><a href="banquet.php">Banquet Hall</a></li>
                <li><a href="dining.php">Dining</a></li>
                <li><a href="food_menu.php">Food</a></li>
                <li><a href="my_reservation.php">My Reservation</a></li>
                <button class="sidebar-signin-btn"><i class="fas fa-user"></i>
                    <a href="http://localhost/workspace/Hotel/room_booking/logout.php" style="color: aliceblue; text-decoration: none;">Logout</a>
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
