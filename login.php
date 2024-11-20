<?php
require 'classes/dbconnection.php'; 
require 'classes/user_management.php'; 
session_start();

if(isset($_POST["submit"])){
    $db = new Database();
    $conn = $db->getConnect();
    $email = htmlspecialchars($_POST["loginEmail"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["loginPassword"], ENT_QUOTES, 'UTF-8');

    $admin = new Admin($conn);
    $user = new User($conn);

    if ($admin_user = $admin->login($email, $password)) {
        // Admin login successful
        $_SESSION["adminEmail"] = $email;
        $_SESSION["role"] = 'admin';
        echo "<script> alert('Admin Login Successful'); </script>";
        header("Location: admin_dashboard.php");
        exit();
    } elseif ($regular_user = $user->login($email, $password)) {
        // User login successful
        $_SESSION["loginEmail"] = $email;
        $_SESSION["role"] = 'user';
        echo "<script> alert('Login Successful'); </script>";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script> alert('Incorrect Email or Password'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
<h2>Login</h2>
<form action="login.php" method="post">
    <label for="loginEmail">Email:</label><br>
    <input type="email" id="loginEmail" name="loginEmail" placeholder="Email" required><br><br>
    
    <label for="loginPassword">Password:</label><br>
    <input type="password" id="loginPassword" name="loginPassword" placeholder="Password" required><br><br>
    
    <input type="submit" name="submit" value="Login">
</form>
<hr>
<p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>