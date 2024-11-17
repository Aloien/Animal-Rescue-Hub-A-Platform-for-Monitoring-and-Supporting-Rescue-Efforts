<?php
require 'dbconnection.php';
session_start();

if(isset($_POST["submit"])){
    $email = $_POST["loginEmail"];
    $password = $_POST["loginPassword"];
    
    // Query to check if the user exists
    $query = "SELECT * FROM tb_user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        // User found, start the session
        $_SESSION["loginEmail"] = $email;
        echo "<script> alert('Login Successful'); </script>";
        // Redirect to a secure page (e.g., dashboard.php)
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