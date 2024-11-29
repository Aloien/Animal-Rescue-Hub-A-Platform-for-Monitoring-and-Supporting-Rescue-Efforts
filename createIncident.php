<?php
// Include the database connection and incident classes
require_once 'classes/dbConnection.php';
require_once 'classes/Incident_management.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new instance of the Database class
    $database = new Database();
    // Get the database connection
    $db = $database->getConnect();

    // Create a new instance of the Incident class with the database connection
    $incident = new Incident($db);
    // Sanitize and assign the form inputs to the incident properties
    $incident->animal_type = $_POST['animal_type'];
    $incident->location = $_POST['location'];
    $incident->date = $_POST['date'];
    $incident->description = $_POST['description'];
    $incident->status = $_POST['status']; // Add status field

    // Check if an image file was uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Define the target directory for uploads
        $targetDir = "incidentImages/";
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Define the target file path
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        // Get the image file type
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the uploaded file is a valid image and within the size limit
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false && $_FILES["image"]["size"] <= 5000000 && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
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
        // Handle the case where no file was uploaded or there was an error
        echo "No file uploaded or there was an error.";
        exit;
    }

    // Save the incident to the database (assuming you have a method for this)
    if ($incident->create()) {
        header("Location: incident.php?success=true");
        exit;
    } else {
        echo "Error creating incident.";
    }
}
?>