<?php
// session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location:admin_login.html");
//     exit();
// }

include("includes/config.php");

//Room deletion
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn->query("DELETE FROM rooms WHERE id=$id");
    header("Location: rooms.php");
}

// Handle room addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_room"])) {
    $room_type = $_POST["room_type"];
    $price = $_POST["price"];
    $total_rooms = $_POST["total_rooms"];

    $query = "INSERT INTO rooms (room_type, price, total_rooms) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $room_type, $price, $total_rooms);
    
    if ($stmt->execute()) {
        $success_message = "Room added successfully!";
    } else {
        $error_message = "Error adding room.";
    }
}

// Handle room update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_room"])) {
    $room_id = $_POST["room_id"];
    $price = $_POST["price"];
    $total_rooms = $_POST["total_rooms"];

    $query = "UPDATE rooms SET price=?, total_rooms=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $price, $total_rooms, $room_id);

    if ($stmt->execute()) {
        $success_message = "Room updated successfully!";
    } else {
        $error_message = "Error updating room.";
    }
}

// Fetch all rooms
$rooms = $conn->query("SELECT * FROM rooms");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="content">
        <h1>Manage Rooms</h1>

        <?php if (isset($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>

        <br>
        <h3>Add New Room</h3>
        <form method="POST">
            <input type="text" name="room_type" placeholder="Room Type" required>
            <input type="number" name="price" placeholder="Price per Night" required>
            <input type="number" name="total_rooms" placeholder="Total Rooms" required>
            <button type="submit" name="add_room">Add Room</button>
        </form>

        <br>
        <h3>Existing Rooms</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Room Type</th>
                <th>Price</th>
                <th>Total Rooms</th>
                <th>Action</th>
            </tr>
            <?php while ($room = $rooms->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($room['id']); ?></td>
                    <td><?php echo htmlspecialchars($room['room_type']); ?></td>
                    <form method="POST">
                        <td>
                            <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                            <input type="number" name="price" value="<?php echo $room['price']; ?>" required>
                        </td>
                        <td>
                            <input type="number" name="total_rooms" value="<?php echo $room['total_rooms']; ?>" required>
                        </td>
                        <td>
                            <button type="submit" name="update_room">Update</button>
                            <a href="rooms.php?id=<?php echo $room['id']; ?>" onclick="return confirm('Are you sure you want to DELETE the room?');">Delete</a>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>