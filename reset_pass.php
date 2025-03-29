<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="form-title">Reset Password</h1>
        <form method="post" action="reset_password.php">
            <!-- <input type="hidden" name="email" id="email" value=""> -->
            <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="newPassword" id="newPassword" placeholder="New Password" required>
                <label for="newPassword">New Password</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
                <label for="confirmPassword">Confirm Password</label>
            </div>
            <input type="submit" class="btn" value="Update Password" name="resetPassword">
        </form>
    </div>
    <script src="script2.js"></script>
</body>
</html>
