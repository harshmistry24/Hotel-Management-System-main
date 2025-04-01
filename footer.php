<?php
include("php/db_connect.php");

$result = $conn->query("SELECT * FROM footer_content WHERE id=1");
$footer = $result->fetch_assoc();
?>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-section about">
            <h3>About Us</h3>
            <p><?= $footer['about_us'] ?></p>
        </div>
        <div class="footer-section contact">
            <h3>Contact Us</h3>
            <p><i class="fas fa-phone"></i> <?= $footer['phone'] ?></p>
            <p><i class="fas fa-envelope"></i> <?= $footer['email'] ?></p>
            <p><i class="fas fa-map-marker-alt"></i> <?= $footer['address'] ?></p>
        </div>
        <div class="footer-section social">
            <h3>Follow Us</h3>
            <a href="<?= $footer['facebook'] ?>"><i class="fab fa-facebook"></i></a>
            <a href="<?= $footer['twitter'] ?>"><i class="fab fa-twitter"></i></a>
            <a href="<?= $footer['instagram'] ?>"><i class="fab fa-instagram"></i></a>
            <a href="<?= $footer['linkedin'] ?>"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 The President Hotel. All rights reserved.</p>
    </div>
</footer>

<?php $conn->close(); ?>