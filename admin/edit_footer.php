<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:admin_login.html");
    exit();
}

include("includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $about_us = $_POST["about_us"];
    $facebook = $_POST["facebook"];
    $twitter = $_POST["twitter"];
    $instagram = $_POST["instagram"];
    $linkedin = $_POST["linkedin"];

    // Update footer details in database
    $query = "UPDATE footer_content SET phone=?, email=?, address=?, about_us=?, facebook=?, twitter=?, instagram=?, linkedin=? WHERE id=1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssss", $phone, $email, $address, $about_us, $facebook, $twitter, $instagram, $linkedin);

    if ($stmt->execute()) {
        $message = "Footer updated successfully!";
    } else {
        $message = "Error updating footer: " . $conn->error;
    }
}

// Fetch existing footer data
$result = $conn->query("SELECT * FROM footer_content WHERE id=1");
$footer = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Footer</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

    <div class="content">
        <h2>Edit Footer</h2>
        <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>

        <form method="POST">
            <table class="footer-table">
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" name="phone" value="<?= $footer['phone'] ?>" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" value="<?= $footer['email'] ?>" required></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea name="address" required><?= $footer['address'] ?></textarea></td>
                </tr>
                <tr>
                    <td>About Us</td>
                    <td><textarea name="about us" required><?= $footer['about_us'] ?></textarea></td>
                </tr>
                <tr>
                    <td>Facebook</td>
                    <td><input type="url" name="facebook" value="<?= $footer['facebook'] ?>"></td>
                </tr>
                <tr>
                    <td>Twitter</td>
                    <td><input type="url" name="twitter" value="<?= $footer['twitter'] ?>"></td>
                </tr>
                <tr>
                    <td>Instagram</td>
                    <td><input type="url" name="instagram" value="<?= $footer['instagram'] ?>"></td>
                </tr>
                <tr>
                    <td>LinkedIn</td>
                    <td><input type="url" name="linkedin" value="<?= $footer['linkedin'] ?>"></td>
                </tr>
            </table>

            <br>
            <button type="submit" class="update-btn">Update Footer</button>
        </form>
    </div>
</div>

</body>
</html>