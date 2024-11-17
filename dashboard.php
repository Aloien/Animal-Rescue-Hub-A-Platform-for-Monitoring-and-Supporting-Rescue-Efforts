<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION["loginEmail"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<h2>Welcome to Your Dashboard</h2>
<p>Hello, <?php echo $_SESSION["loginEmail"]; ?>! You are logged in.</p>
<a href="logout.php">Logout</a>
</body>
</html>
