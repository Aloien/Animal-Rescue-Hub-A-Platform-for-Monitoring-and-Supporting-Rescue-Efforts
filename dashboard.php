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
    <title>Animal Rescue Hub</title>
</head>
<body>
    <header>
        <h1>Welcome to Animal Rescue Hub</h1>
        
    </header>
    <div style="display: flex;">
        <nav style="width: 20%;">
            <ul style="list-style-type: none; padding: 0;">
                <li><a href="#incident">Incident</a></li>
                <li><a href="#volunteer">Volunteer</a></li>
                <li><a href="#adoption">Adoption</a></li>
                <li><a href="#report">Report</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
            <nav>
            <ul style="list-style-type: none; padding: 0;">
                <li style="display: inline;"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        </nav>
        <main style="width: 80%;">
            <div style="background-image: url('path_to_animal_image.jpg'); height: 500px; background-size: cover;">
                
            </div>
        </main>
    </div>
</body>
</html>
