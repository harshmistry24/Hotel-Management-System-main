<?php
include 'includes/config.php';

if (isset($_POST['upload'])) {
    $target_dir = "food/";
    $target_file = $target_dir . basename($_FILES["menu_image"]["name"]);
    $image_name = basename($_FILES["menu_image"]["name"]);

    if (move_uploaded_file($_FILES["menu_image"]["tmp_name"], $target_file)) {
        $query = "INSERT INTO food_menu_images (image_name) VALUES ('$image_name')";
        if ($conn->query($query) === TRUE) {
            echo "<script>alert('Menu image uploaded successfully!'); 
            window.location.href='admin_food_menu.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
