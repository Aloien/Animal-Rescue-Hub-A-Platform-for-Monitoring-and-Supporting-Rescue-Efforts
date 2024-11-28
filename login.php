<?php
require 'classes/dbconnection.php'; 
require 'classes/user_management.php'; 
session_start();

unset($_SESSION["adminEmail"]);
unset($_SESSION["loginEmail"]);

if (isset($_POST["submit"])) {
    $db = new Database();
    $conn = $db->getConnect();
    $email = htmlspecialchars($_POST["loginEmail"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["loginPassword"], ENT_QUOTES, 'UTF-8');

    $admin = new Admin($conn);
    $user = new User($conn);

    if ($admin_user = $admin->login($email, $password)) {
        // Admin login successful
        $_SESSION["adminEmail"] = $admin_user['email'];
        $_SESSION["role"] = 'admin';
        header("Location: admin_dashboard.php");
        exit();
    } elseif ($regular_user = $user->login($email, $password)) {
        // User login successful
        $_SESSION["loginEmail"] = $regular_user['email'];
        $_SESSION["role"] = 'user';
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #0c969c;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 400px;
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
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Login</h2>
        <form action="login.php" method="post" autocomplete="off">
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email:</label>
                <input type="email" id="loginEmail" name="loginEmail" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Password:</label>
                <input type="password" id="loginPassword" name="loginPassword" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <hr>
        <p class="text-center">Don't have an account? <a href="register.php">Register here</a></p>
    </div>

</body>
</html>
