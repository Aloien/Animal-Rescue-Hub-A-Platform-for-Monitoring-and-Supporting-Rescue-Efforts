<?php
require 'dbconnection.php';
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"]; 
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
        echo
        "<script> alert('Email Has Already Been Taken'); </script>";
    }
    else{
        if($password == $confirmPassword){
            $query = "INSERT INTO tb_user (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($conn, $query);
            echo
            "<script> alert('Registration Successful'); </script>";
            
        }
        else {
            echo
            "<script> alert('Password Does Not Match'); </script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head> 
<body>

<h2>Register</h2>
<form action="register.php" method="post" onsubmit="return validateForm()">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" placeholder="Name" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" placeholder="Email" required><br><br>

    <label for="phone">Phone sNumber:</label><br>
    <input type="tel" id="phone" name="phone" placeholder="Phone Number" required><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" placeholder="Password" required><br><br>

    <label for="confirmPassword">Confirm Password:</label><br>
    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required><br><br>
        
    <input type="submit" value="Register">
</form>

<hr>

<p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>
