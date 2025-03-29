<?php 

include 'db_connect.php';

if(isset($_POST['signUp'])){
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Email validation using regex
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        echo "<script>
                alert('Invalid email format. Please enter a valid email.');
                window.location.href = 'register.html';
              </script>";
        exit();
    }

    // Phone number validation (must be exactly 10 digits)
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo "<script>
                alert('Invalid phone number. It must be exactly 10 digits number.');
                window.location.href = 'register.html';
              </script>";
        exit();
    }

    // Password length validation (minimum 8 characters)
    if (strlen($password) < 8) {
        echo "<script>
                alert('Password must be at least 8 characters long.');
                window.location.href = 'register.html';
              </script>";
        exit();
    }

    // Encrypt the password
    $password = md5($password);

    // Check if email already exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    
    if($result->num_rows > 0){
        echo "<script>
                alert('Email Address Already Exists!');
                window.location.href = 'register.html';
              </script>";
        exit();
    }
    else{
        // Insert user into database
        $insertQuery = "INSERT INTO users(firstName, lastName, email, phone, password)
                        VALUES ('$firstName', '$lastName', '$email', '$phone', '$password')";
        if($conn->query($insertQuery) === TRUE){
            header("Location: login.html");
            exit();
        }
        else{
            echo "Error: " . $conn->error;
        }
    }
}

?>