<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Animal Rescue Hub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
            padding: 20px;
            background: url('background_Images/contactus.jpg') no-repeat center center fixed; /* Use a relative path */
            background-size: cover; /* Ensure the background image covers the entire page */
        }
        .contact-info {
            width: 100%;
            max-width: 600px;
            margin: 20px 0;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left; /* Align text to the left */
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .contact-info h2 {
            margin-bottom: 20px;
            color: #343a40;
            text-align: center; /* Center the heading */
        }
        .contact-info p {
            margin-bottom: 10px;
            color: #6c757d;
        }
        .contact-info p strong {
            color: #343a40;
        }
        .contact-info .icon {
            font-size: 24px;
            margin-right: 10px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="py-5 text-center w-100" style="background: none;">
        <div class="container">
            <h1 class="display-2 text-white">Contact Us</h1>
            <p class="lead text-white">We'd love to hear from you. Here is how you can reach us.</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="contact-info">
            <h2>Our Contact Information</h2>
            <p><span class="icon">&#x1F4CD;</span><strong>Address:</strong> A. Tanco Drive, Maraouy, Lipa, Batangas</p>
            <p><span class="icon">&#x1F4DE;</span><strong>Phone:</strong> +123 456 7890</p>
            <p><span class="icon">&#x2709;</span><strong>Email:</strong> contact@animalrescuehub.com</p>
            <p><span class="icon">&#x1F551;</span><strong>Working Hours:</strong> Monday - Friday, 9:00 AM - 5:00 PM</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 w-100" style="background: none;">
        <div class="container">
            <p class="m-0 text-center text-white">&copy; 2024 Animal Rescue Hub. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>