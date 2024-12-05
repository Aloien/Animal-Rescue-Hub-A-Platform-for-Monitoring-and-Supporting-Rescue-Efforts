<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Rescue Hub</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            padding-top: 56px;
            background-color: #f5f5f5;
        }
        main {
            flex: 1;
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
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Animal Rescue Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registerUser.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="jumbotron text-center bg-dark bg-opacity-50">
        <div class="container">
            <h1 class="display-4">Welcome to Animal Rescue Hub!</h1>
            <p class="lead">Connecting rescued animals with loving homes. Join us in making a difference.</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <section class="my-5">
            <h2 class="text-center section-title">Our Mission</h2>
            <p class="text-center">We aim to rescue, rehabilitate, and rehome animals in need. Join our community and help us create a better world for our furry friends.</p>
        </section>
        <section class="my-5">
            <h2 class="text-center section-title">Adopt a Pet</h2>
            <p class="text-center">Find your new best friend from our wide selection of rescued animals. Each one is looking for a loving home just like yours.</p>
            <div class="text-center">
                <a href="adoptionList.php" class="btn btn-primary">Browse Animals</a>
            </div>
        </section>
        <section class="my-5">
            <h2 class="text-center section-title">Support Us</h2>
            <p class="text-center">We rely on the generosity of our supporters. Learn how you can donate.</p>
            <div class="text-center">
                <a href="supportUs.php" class="btn btn-secondary">Learn More</a>
            </div>
        </section>
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
    
</body>
</html>
