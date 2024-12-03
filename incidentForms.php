<?php
require_once 'classes/dbConnection.php';
require_once 'classes/incidentManagement.php';

$database = new Database();
$db = $database->getConnect();

$incident = new Incident($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $incident->animal_type = htmlspecialchars(trim($_POST['animal_type']));
    $incident->location = htmlspecialchars(trim($_POST['location']));
    $incident->date = htmlspecialchars(trim($_POST['date']));
    $incident->description = htmlspecialchars(trim($_POST['description']));
    $incident->status = htmlspecialchars(trim($_POST['status']));
    $incident->geolocation = htmlspecialchars(trim($_POST['geolocation']));

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024;

        if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
            $targetDir = "incidentImages/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $incident->image = $targetFile;
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            echo "Invalid file type or size.";
            exit;
        }
    } else {
        $incident->image = null;
    }

    if ($incident->create()) {
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
            text: 'Incident added successfully!',
            icon: 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'adminDashboard.php';
            }
        });
        </script>
        </body>
        </html>";
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Error</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Error!',
            text: 'There was an issue adding the incident. Please try again later.',
            icon: 'error'
        }).then(() => {
            window.history.back();
        });
        </script>
        </body>
        </html>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Incident</title>
</head>
<body>
    <h2>Add Incident</h2>
    <form action="incidentForms.php" method="post" enctype="multipart/form-data" onsubmit="return setGeolocation()">
        <label for="animal_type">Animal Type:</label>
        <input type="text" id="animal_type" name="animal_type" required><br><br>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>
        
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="in facility">In Facility</option>
            <option value="adopted">Adopted</option>
            <option value="released">Released</option>
            <option value="pending">Pending</option>
            <option value="rescued">Rescued</option>
        </select><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br><br>

        <input type="hidden" id="geolocation" name="geolocation">
        <button type="button" onclick="setGeolocation()">Locate</button>
        <button type="submit">Add Incident</button>
    </form>
    <script>
        function setGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    document.getElementById('geolocation').value = lat + ',' + lon;
                    window.open(`https://www.google.com/maps?q=${lat},${lon}`, '_blank');
                }, function(error) {
                    console.error('Error getting geolocation: ', error);
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }
    </script>
</body>
</html>