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
    <style>
        body {
            background-color: #f7f8fc;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #388E3C;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            padding: 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
        }
        nav ul li a:hover {
            color: #4CAF50;
        }
        main {
            padding: 20px;
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
                    <li><a href="#incident">Incident</a></li>
                    <li><a href="#donation">Donation</a></li>
                    <li><a href="#adoption">Adoption</a></li>
                    <li><a href="#report">Report</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
                <ul class="list-unstyled position-absolute bottom-0">
                    <li><a href="logout.php" class="btn btn-danger">Logout</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-OMQNB0lQJbWb1D/SIdN++0CUWuvPrNLAHEQRWzFnw2vM3FA1MYIjPUxDSA3lg7kl" crossorigin="anonymous"></script>
</body>
</html>
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
    <style>
        body {
            background-color: #f7f8fc;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #388E3C;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            padding: 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
        }
        nav ul li a:hover {
            color: #4CAF50;
        }
        main {
            padding: 20px;
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
                    <li><a href="#incident">Incident</a></li>
                    <li><a href="#donation">Donation</a></li>
                    <li><a href="#adoption">Adoption</a></li>
                    <li><a href="#report">Report</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
                <ul class="list-unstyled position-absolute bottom-0">
                    <li><a href="logout.php" class="btn btn-danger">Logout</a></li>
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
