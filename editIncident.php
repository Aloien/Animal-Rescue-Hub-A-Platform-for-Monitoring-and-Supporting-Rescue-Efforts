<?php
require_once 'classes/dbConnection.php';
require_once 'classes/incidentManagement.php';

$database = new Database();
$db = $database->getConnect();

$incident = new Incident($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $incidentData = $incident->getIncidentById($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $incident->animal_type = htmlspecialchars(trim($_POST['animal_type']));
    $incident->location = htmlspecialchars(trim($_POST['location']));
    $incident->date = htmlspecialchars(trim($_POST['date'] . ' ' . $_POST['time'])); // Combine date and time
    $incident->description = htmlspecialchars(trim($_POST['description']));
    $incident->status = htmlspecialchars(trim($_POST['status']));

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024;

        if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
            $targetDir = "incidentImages/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);

            // Ensure the images directory exists
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

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
        $incident->image = $_POST['existing_image'];
    }

    if ($incident->update($id)) {
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
            text: 'Incident updated successfully!',
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
            text: 'There was an issue updating the incident. Please try again later.',
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
    <title>Edit Incident</title>
</head>
<body>
    <h2>Edit Incident</h2>
    <form action="editIncident.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($incidentData['id']); ?>">
        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($incidentData['image']); ?>">

        <label for="animal_type">Animal Type:</label>
        <input type="text" id="animal_type" name="animal_type" value="<?php echo htmlspecialchars($incidentData['animal_type']); ?>" required><br><br>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($incidentData['location']); ?>" required><br><br>
        
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars(explode(' ', $incidentData['date'])[0]); ?>" required><br><br>
        
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" value="<?php echo htmlspecialchars(explode(' ', $incidentData['date'])[1]); ?>" required><br><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($incidentData['description']); ?></textarea><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="in facility" <?php echo ($incidentData['status'] == 'in facility') ? 'selected' : ''; ?>>In Facility</option>
            <option value="adopted" <?php echo ($incidentData['status'] == 'adopted') ? 'selected' : ''; ?>>Adopted</option>
            <option value="released" <?php echo ($incidentData['status'] == 'released') ? 'selected' : ''; ?>>Released</option>
            <option value="pending" <?php echo ($incidentData['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="rescued" <?php echo ($incidentData['status'] == 'rescued') ? 'selected' : ''; ?>>Rescued</option>
        </select><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br><br>
        <img src="<?php echo htmlspecialchars($incidentData['image']); ?>" alt="Incident Image" style="max-width: 100px;"><br><br>
        
        <button type="submit">Update Incident</button>
    </form>
</body>
</html>