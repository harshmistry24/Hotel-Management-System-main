<?php
include 'includes/config.php';

if (isset($_POST['upload'])) {
    $target_dir = "food/";
    $target_file = $target_dir . basename($_FILES["menu_image"]["name"]);
    $image_name = basename($_FILES["menu_image"]["name"]);
    $menu_disc= $_POST['menu_description'];

    if (!empty($_FILES["menu_image"]["name"])) {
        // file upload and query
        if (move_uploaded_file($_FILES["menu_image"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO food_menu_images (image_name, menu_description) VALUES ('$image_name', '$menu_disc')";
            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Menu uploaded successfully!'); 
                window.location.href='admin_food_menu.php';</script>";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "<script>alert('Error uploading file. *Note: File must be less then 2MB.');
            window.location.href='admin_food_menu.php';</script>";
        }
    } else {
        echo "Menu description or image file is missing.";
    }
    
}
?>
