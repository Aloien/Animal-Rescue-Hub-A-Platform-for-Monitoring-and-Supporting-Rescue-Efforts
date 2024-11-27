<?php
// Include the database connection and incident classes
require_once 'classes/dbConnection.php';
require_once 'classes/Incident.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new instance of the Database class
    $database = new Database();
    // Get the database connection
    $db = $database->getConnect();

    // Create a new instance of the Incident class with the database connection
    $incident = new Incident($db);
    // Sanitize and assign the form inputs to the incident properties
    $incident->animal_type = htmlspecialchars(trim($_POST['animal_type']));
    $incident->location = htmlspecialchars(trim($_POST['location']));
    $incident->date = htmlspecialchars(trim($_POST['date']));
    $incident->description = htmlspecialchars(trim($_POST['description']));
    $incident->status = htmlspecialchars(trim($_POST['status'])); // Add status field

    // Check if an image file was uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Define allowed file types and maximum file size (2MB)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        // Check if the uploaded file type is allowed and the file size is within the limit
        if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
            // Define the target directory for uploads
            $targetDir = "uploads/";
            // Define the target file path
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Assign the file path to the incident image property
                $incident->image = $targetFile;
            } else {
                // Display an error message if the file upload fails
                echo "Error uploading file.";
                exit;
            }
        } else {
            // Display an error message if the file type or size is invalid
            echo "Invalid file type or size.";
            exit;
        }
    } else {
        // If no image was uploaded, set the incident image property to null
        $incident->image = null;
    }

    // Attempt to create the incident record in the database
    if ($incident->create()) {
        // If successful, display a success message using SweetAlert
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Success!',
            text: 'Incident was successfully reported!',
            icon: 'success'
        }).then((result) => {
            // Redirect to the incident page after the user acknowledges the alert
            if(result.isConfirmed) {
                window.location.href = 'incident.php';
            }
        });
        </script>
        </body>
        </html>";
    } else {
        // If the incident creation fails, display an error message
        echo "Error reporting incident. Please try again later.";
    }
}
?>