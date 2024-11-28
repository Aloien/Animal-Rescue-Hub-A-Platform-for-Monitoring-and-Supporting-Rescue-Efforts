<?php
require 'classes/dbconnection.php';
require 'classes/user_management.php'; // Include the User class

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
        $user = new User($conn);
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);
        if ($user->create()) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #0c969d;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            padding: 30px;
            background: white;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #032f30;
        }
        .btn-primary {
            background-color: #0a7075;
            border-color: #0a7075;
        }
        .btn-primary:hover {
            background-color: #032f30;
            border-color: #032f30;
        }
        a {
            color: #274d60;
        }
        a:hover {
            color: #6ba3be;
        }
    </style>
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
    <div class="container mt-5">
        <h2 class="text-center mb-4">Register</h2>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone Number" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <hr>
        <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-OMQNB0lQJbWb1D/SIdN++0CUWuvPrNLAHEQRWzFnw2vM3FA1MYIjPUxDSA3lg7kl" crossorigin="anonymous"></script>
</body>
</html>
