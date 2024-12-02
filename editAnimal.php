<?php
require_once 'classes/dbConnection.php';
require_once 'classes/crudAnimal.php';

$database = new Database();
$pdo = $database->getConnect();
$crud = new Animals($pdo);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $animal = $crud->getAnimalById($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $animalName = htmlspecialchars(trim($_POST['animal']));
    $species = htmlspecialchars(trim($_POST['species']));
    $age = htmlspecialchars(trim($_POST['age']));
    $description = htmlspecialchars(trim($_POST['description']));
    $status = htmlspecialchars(trim($_POST['status']));

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024;

        if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
            $targetDir = "animalImages/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
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
        $image = $_POST['existing_image'];
    }

    $success = $crud->updateAnimal($id, $animalName, $species, $age, $description, $image, $status);
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
        title: '" . ($success ? 'Success!' : 'Error!') . "',
        text: '" . ($success ? 'Data was updated successfully!' : 'Error when updating data!') . "',
        icon: '" . ($success ? 'success' : 'error') . "'
    }).then((result) => {
        if(result.isConfirmed) {
            window.location.href = 'adminDashboard.php';
        }
    });
    </script>
    </body>
    </html>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Animal</title>
</head>

<body>
    <?php if (isset($animal)): ?>
        <h2>Edit Animal</h2>
        <form action="editAnimal.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($animal['id']); ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($animal['image']); ?>">

            <label for="animal">Animal:</label><br>
            <input type="text" id="animal" name="animal" value="<?php echo htmlspecialchars($animal['animal']); ?>" required><br><br>

            <label for="species">Species:</label><br>
            <input type="text" id="species" name="species" value="<?php echo htmlspecialchars($animal['species']); ?>" required><br><br>

            <label for="age">Age:</label><br>
            <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($animal['age']); ?>" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($animal['description']); ?></textarea><br><br>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="in facility" <?php echo ($animal['status'] == 'in facility') ? 'selected' : ''; ?>>In Facility</option>
                <option value="adopted" <?php echo ($animal['status'] == 'adopted') ? 'selected' : ''; ?>>Adopted</option>
                <option value="released" <?php echo ($animal['status'] == 'under medical') ? 'selected' : ''; ?>>Under Medical</option>
                <option value="released" <?php echo ($animal['status'] == 'released') ? 'selected' : ''; ?>>Released</option>
                <option value="pending" <?php echo ($animal['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="rescued" <?php echo ($animal['status'] == 'rescued') ? 'selected' : ''; ?>>Rescued</option>
            </select><br><br>

            <label for="image">Image:</label><br>
            <input type="file" id="image" name="image"><br><br>
            <img src="<?php echo htmlspecialchars($animal['image']); ?>" alt="Animal Image" style="max-width: 100px;"><br><br>

            <input type="submit" name="submit" value="Update">
        </form>
    <?php else: ?>
        <p>Animal not found.</p>
    <?php endif; ?>
</body>

</html>