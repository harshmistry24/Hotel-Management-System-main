<?php 
include 'db_connect.php';

if(isset($_POST['resetPassword'])){
    if(isset($_POST['email']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
        
        $email = trim($_POST['email']); // Ensure email is properly received
        $newPassword = trim($_POST['newPassword']);
        $confirmPassword = trim($_POST['confirmPassword']);

        // DEBUGGING: Check what email is being received
        if (empty($email)) {
            echo "<script>alert('Email is empty. Please enter a valid email.');</script>";
            exit();
        } else {
            echo "<script>console.log('Received email: " . $email . "');</script>";
        }

        // Validate email format
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            echo "<script>
                    alert('Invalid email format.');
                    window.location.href = 'reset_password.html?email=".$email."';
                  </script>";
            exit();
        }

        // Check if passwords match
        if ($newPassword !== $confirmPassword) {
            echo "<script>
                    alert('Passwords do not match!');
                    window.location.href = 'reset_password.html?email=".$email."';
                  </script>";
            exit();
        }

        // Check password length
        if (strlen($newPassword) < 8) {
            echo "<script>
                    alert('Password must be at least 8 characters long.');
                    window.location.href = 'reset_pass.php?email=".$email."';
                  </script>";
            exit();
        }

        // Encrypt the new password
        $hashedPassword = md5($newPassword);

        // Ensure email exists before updating
        $checkUser = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($checkUser);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0){
            echo "<script>
                    alert('Email not found.');
                    window.location.href = 'forgot_password.html';
                  </script>";
            exit();
        }

        // Update the password
        $updatePassword = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($updatePassword);
        $stmt->bind_param("ss", $hashedPassword, $email);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Password updated successfully. Please login.');
                    window.location.href = 'login.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating password.');
                    window.location.href = 'reset_password.html?email=".$email."';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Invalid request.');
                window.location.href = 'forgot_password.html';
              </script>";
    }
}
?>
