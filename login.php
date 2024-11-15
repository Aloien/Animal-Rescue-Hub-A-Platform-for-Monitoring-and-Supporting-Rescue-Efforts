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
    
    <input type="submit" value="Login">

</form>

<hr>

<p>Don't have an account? <a href="register.php">Register here</a></p>

</body>
</html>
