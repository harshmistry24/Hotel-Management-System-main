<?php 
include 'db_connect.php';

if(isset($_POST['forgotPassword'])){
    $email = $_POST['email'];

    // Check if the email exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if($result->num_rows > 0){
        // Redirect to reset password page with the email
        // header("Location: reset_password.html?email=".$email);
        header("Location: reset_pass.php?email=" . urlencode($email));

        exit();
    } else {
        echo "<script>
                alert('Email not found. Please enter a registered email.');
                window.location.href = 'forgot_password.html';
              </script>";
    }
}
?>
