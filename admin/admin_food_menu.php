<?php
include 'includes/config.php';

// Fetch existing food menu images
$query = "SELECT * FROM food_menu_images ORDER BY id DESC";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Food Menu</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>

    <!-- side bar -->
    <?php include 'admin_header.php'; ?>

        <div class="content">
            <h2>Manage Food Menu</h2>

            <!-- Upload Form -->
            <form action="upload_food_menu.php" method="POST" enctype="multipart/form-data">
                <label for="menu_image">Upload Food Menu Image:</label>
                <input type="file" name="menu_image" required>
                <button type="submit" name="upload">Upload</button>
            </form>

            <h3>Existing Menu Images</h3>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><img src="food/<?= $row['image_name'] ?>" width="100"></td>
                    <td>
                        <a href="delete_food_menu.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to DELETE this menu?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
</html>
