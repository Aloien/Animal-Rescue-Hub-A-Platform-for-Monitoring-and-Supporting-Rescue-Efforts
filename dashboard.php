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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f7f8fc;
            font-family: 'Montserrat', sans-serif;
        }
        .navbar {
            background-color: #032f30;
        }
        .navbar-brand {
            color: #6ba3be;
            font-weight: bold;
            font-family: 'Lora', serif;
        }
        .navbar-brand:hover {
            color: #0c969c;
        }
        .nav-link {
            color: #6ba3be;
        }
        .nav-link:hover {
            color: #0c969c;
        }
        header {
            background-color: #032f30;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #274d60;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            padding: 10px;
        }
        nav ul li button {
            width: 100%;
            text-align: left;
            border: none;
            background-color: #0a7075;
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
            border-radius: 5px;
            cursor: pointer;
        }
        nav ul li button:hover {
            background-color: #0c969c;
        }
        main {
            padding: 20px;
        }
        .btn-primary {
            background-color: #0a7075;
            border-color: #0a7075;
        }
        .btn-primary:hover {
            background-color: #0c969c;
            border-color: #0c969c;
        }
        .btn-secondary {
            background-color: #274d60;
            border-color: #274d60;
        }
        .btn-secondary:hover {
            background-color: #032f30;
            border-color: #032f30;
        }
        footer {
            background-color: #032f30;
            color: #f5f5f5;
        }
        footer a {
            color: #6ba3be;
        }
        footer a:hover {
            color: #0c969c;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Animal Rescue Hub</h1>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 bg-light p-3" style="border-right: 1px solid #ddd;">
                <ul>
                    <li><button onclick="location.href='#incident'">Incident</button></li>
                    <li><button onclick="location.href='#adoption'">Adoption</button></li>
                    <li><button onclick="location.href='#overview'">Overview</button></li>
                    <li><button onclick="location.href='#contact'">Contact Us</button></li>
                </ul>
                <ul class="list-unstyled position-absolute bottom-0">
                    <li><button class="btn btn-danger" onclick="location.href='logout.php'">Logout</button></li>
                </ul>
            </nav>
            <main class="col-md-10">
                <div class="bg-light p-5 rounded-lg">
                    <div style="background-image: url('path_to_animal_image.jpg'); height: 500px; background-size: cover; background-position: center;">
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
