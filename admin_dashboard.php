<?php
session_start();
if(!isset($_SESSION["adminEmail"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
<h2>Welcome to the Admin Dashboard</h2>
<p>Hello, <?php echo $_SESSION["adminEmail"]; ?>! You are logged in as admin.</p>
<a href="read_users.php">Manage Users</a>
<a href="logout.php">Logout</a>
</body>
</html>
