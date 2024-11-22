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
        }
        .jumbotron {
            background-image: url('wildlife-header.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
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
                        <a class="nav-link" href="register.php">Register</a>
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
            <h2 class="text-center">Our Mission</h2>
            <p class="text-center">We aim to rescue, rehabilitate, and rehome animals in need. Join our community and help us create a better world for our furry friends.</p>
        </section>
        <section class="my-5">
            <h2 class="text-center">Adopt a Pet</h2>
            <p class="text-center">Find your new best friend from our wide selection of rescued animals. Each one is looking for a loving home just like yours.</p>
            <div class="text-center">
                <a href="adopt.html" class="btn btn-primary">Browse Animals</a>
            </div>
        </section>
        <section class="my-5">
            <h2 class="text-center">Support Us</h2>
            <p class="text-center">We rely on the generosity of our supporters. Learn how you can donate, volunteer, or participate in our fundraising events.</p>
            <div class="text-center">
                <a href="support.html" class="btn btn-secondary">Learn More</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-4 bg-light">
        <div class="container">
            <p class="m-0 text-center text-muted">&copy; 2024 Animal Rescue Hub. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
