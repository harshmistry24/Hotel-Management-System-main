<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:admin_login.html");
    exit();
}

include("includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $banquet_price = $_POST["banquet_price"];
    $banquet_capacity = $_POST["banquet_capacity"];

    // Update banquet details in the database
    $query = "UPDATE banquet_dining_set SET banquet_price=?, banquet_capacity=? WHERE id=1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $banquet_price, $banquet_capacity);

    if ($stmt->execute()) {
        $message = "Banquet details updated successfully!";
    } else {
        $message = "Error updating banquet settings: " . $conn->error;
    }
}

// Fetch existing banquet data
$result = $conn->query("SELECT * FROM banquet_dining_set WHERE id=1");
$banquet = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Banquet Settings</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="content">
    <h2>Banquet Settings</h2>
    <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>

    <form method="POST">
        <table class="footer-table">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Banquet Price</td>
                <td><input type="number" name="banquet_price" value="<?= $banquet['banquet_price'] ?>" required></td>
            </tr>
            <tr>
                <td>Banquet Capacity</td>
                <td><input type="number" name="banquet_capacity" value="<?= $banquet['banquet_capacity'] ?>" required></td>
            </tr>
        </table>

        <br>
        <button type="submit" class="update-btn">Update Banquet</button>
    </form>
</div>

</body>
</html>
