<?php
require 'classes/dbconnection.php';

if (isset($_POST["submit"])) {
    $db = new Database();
    $conn = $db->getConnect();

    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars($_POST["phone"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    $confirmPassword = htmlspecialchars($_POST["confirmPassword"], ENT_QUOTES, 'UTF-8');

    if ($password !== $confirmPassword) {
        echo "<script> alert('Passwords do not match'); </script>";
        exit();
    }

    // Check for duplicate email
    $query = "SELECT * FROM tb_user WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->execute(['email' => $email]);
    $duplicate = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($duplicate) {
        echo "<script> alert('Email Has Already Been Taken'); </script>";
    } else {
        $query = "INSERT INTO tb_user (name, email, phone, password) VALUES (:name, :email, :phone, :password)";
        $stmt = $conn->prepare($query);
        if ($stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'password' => $password])) {
            echo "<script> alert('Registration Successful'); </script>";
        } else {
            echo "<script> alert('Error: " . $stmt->errorInfo()[2] . "'); </script>";
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
    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }
            return true;
        }
    </script>
</head> 
<body>

<h2>Register</h2>
<form action="register.php" method="post" onsubmit="return validateForm()">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" placeholder="Name" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" placeholder="Email" required><br><br>

    <label for="phone">Phone Number:</label><br>
    <input type="tel" id="phone" name="phone" placeholder="Phone Number" required><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" placeholder="Password" required><br><br>

    <label for="confirmPassword">Confirm Password:</label><br>
    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required><br><br>
        
    <input type="submit" name="submit" value="Register">
</form>

<hr>

<p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>
