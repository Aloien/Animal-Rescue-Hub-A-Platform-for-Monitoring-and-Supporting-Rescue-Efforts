<?php

require_once 'classes/dbConnection.php';
require_once 'classes/crudAnimal.php';

$database = new Database();
$pdo = $database->getConnect();

$animals = new Animals($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $animal = $_POST['animal'] ?? null;
    $species = $_POST['species'] ?? null;
    $age = $_POST['age'] ?? null;
    $description = $_POST['description'] ?? null;
    
    // Set default status to 'pending'
    $status = 'pending';

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $targetDir = "animalImages/";
        $targetFile = $targetDir . basename($image);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the uploaded file is a valid image and within the size limit
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false && $_FILES["image"]["size"] <= 5000000 && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Assign the file path to the image variable
                $image = $targetFile;
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            echo "Invalid file type or size.";
            exit;
        }
    } else {
        $image = null;
    }

    if ($animal && $species && $age && $description && $image) {
        $animals->create($animal, $species, $age, $description, $image, $status);
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Success</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Success!',
            text: 'Animal added successfully!',
            icon: 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'adminDashboard.php';
            }
        });
        </script>
        </body>
        </html>";
        exit();
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Animal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add New Animal</h1>
    <form action="addAnimal.php" method="POST" enctype="multipart/form-data">
        <label for="animal">Animal Name:</label>
        <input type="text" id="animal" name="animal" required><br>

        <label for="species">Species:</label>
        <input type="text" id="species" name="species" required><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br>

        <button type="submit">Add Animal</button>
    </form>
</body>
</html>