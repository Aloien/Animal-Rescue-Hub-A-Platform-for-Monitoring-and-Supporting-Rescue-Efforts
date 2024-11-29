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
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #032f30;
        }
        .navbar-brand {
            color: #6ba3be;
            font-weight: bold;
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
        .jumbotron {
            background-image: url('wildlife-header.jpg');
            background-size: cover;
            background-position: center;
            color: #f5f5f5;
            text-shadow: 1px 1px 2px black;
        }
        .section-title {
            margin-bottom: 40px;
            font-weight: bold;
            color: #032f30;
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

<!-- Header -->
    <header class="jumbotron text-center bg-dark bg-opacity-50">
        <div class="container">
            <h1 class="display-4">Welcome to Animal Rescue Hub!</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <nav class="nav flex-column">
                    <a class="nav-link btn btn-primary mb-2" href="incident.php">Incident</a>
                    <a class="nav-link btn btn-primary mb-2" href="adoption_index.php">Adoption</a>
                    <a class="nav-link btn btn-primary mb-2" href="report.php">Report</a>
                    <a class="nav-link btn btn-primary mb-2" href="contactUs.php">Contact Us</a>
                    <a class="nav-link btn btn-secondary" href="logout.php">Logout</a>
                </nav>
            </div>
            <div class="col-md-9">
                <div style="background-image: url('path_to_animal_image.jpg'); height: 500px; background-size: cover;">
                    <!-- Additional content can go here -->
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="m-0">&copy; 2024 Animal Rescue Hub. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
