<?php
include 'includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get image name to delete from folder
    $query = "SELECT image_name FROM food_menu_images WHERE id = $id";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $image_path = "food/" . $row['image_name'];

    if (file_exists($image_path)) {
        unlink($image_path); // Delete the file
    }

    // Delete from database
    $delete_query = "DELETE FROM food_menu_images WHERE id = $id";
    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Image deleted successfully!'); 
        window.location.href='admin_food_menu.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
