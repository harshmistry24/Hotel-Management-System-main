<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:admin_login.html");
    exit();
}

include("includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dining_deposit = $_POST["dining_deposit"];
    $dining_capacity = $_POST["dining_capacity"];

    // Update dining settings in the database
    $query = "UPDATE banquet_dining_set SET dining_deposit=?, dining_capacity=? WHERE id=1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $dining_deposit, $dining_capacity);

    if ($stmt->execute()) {
        $message = "Dining details updated successfully!";
    } else {
        $message = "Error updating dining settings: " . $conn->error;
    }
}

// Fetch existing dining data
$result = $conn->query("SELECT * FROM banquet_dining_set WHERE id=1");
$dining = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Dining Settings</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="content">
    <h2>Dining Settings</h2>
    <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>

    <form method="POST">
        <table class="footer-table">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Dining Fixed Deposit</td>
                <td><input type="number" name="dining_deposit" value="<?= $dining['dining_deposit'] ?>" required></td>
            </tr>
            <tr>
                <td>Dining Capacity</td>
                <td><input type="number" name="dining_capacity" value="<?= $dining['dining_capacity'] ?>" required></td>
            </tr>
        </table>

        <br>
        <button type="submit" class="update-btn">Update Dining</button>
    </form>
</div>

</body>
</html>
