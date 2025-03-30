<?php
// session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: admin_login.html");
//     exit();
// }

include("includes/config.php");

//Delete the user
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: users.php");
}

// Fetch all users
$users = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <div class="content">
        <h2>Manage Users</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['firstName'] . ' ' . $user['lastName']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><a href="users.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to DELETE the USER?');" >Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
