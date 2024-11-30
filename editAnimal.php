<?php
require_once 'classes/crudAnimal.php';
$crudAnimal = new Animals();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $animals = $crudAnimal->read($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $animal = htmlspecialchars(trim($_POST['animal']));
    $species = htmlspecialchars(trim($_POST['species']));
    $age = htmlspecialchars(trim($_POST['age']));
    $description = htmlspecialchars(trim($_POST['description']));

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024;

        if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {

            $targetDir = "images/";

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


        $image = null;
    }
    $status = htmlspecialchars(trim($_POST['status']));

    $success = $crudAnimal->updateAnimal($id, $animal, $species, $age, $description, $image, $status);
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
            window.location.href = 'admin_dashboard.php';
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
    <title>Edit User</title>
</head>

<body>
<?php if (isset($animals)): ?>
    <h2>Edit Animal</h2>
    <form action="editAnimal.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($animals['id']); ?>">
         <label for="name">Name:</label><br>
        <input type="text" id="animal" name="animal" value="<?php echo htmlspecialchars($animals['animal']); ?>" required><br><br>

        <label for="species">Species:</label><br>
        <input type="text" id="species" name="species" value="<?php echo htmlspecialchars($animals['species']); ?>" required><br><br>

        <label for="age">Age:</label><br>
        <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($animals['age']); ?>" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($animals['description']); ?></textarea><br><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br><br>
        <?php if (!empty($animals['image'])): ?>
            <img src="<?php echo htmlspecialchars($animals['image']); ?>" alt="Animal Image" style="max-width: 100px;"><br><br>
        <?php endif; ?>

        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <option value="in facility" <?php echo ($animals['status'] === 'in facility') ? 'selected' : ''; ?>>In Facility</option>
            <option value="adopted" <?php echo ($animals['status'] === 'adopted') ? 'selected' : ''; ?>>Adopted</option>
            <option value="released" <?php echo ($animals['status'] === 'released') ? 'selected' : ''; ?>>Released</option>
        </select><br><br>

        <input type="submit" name="submit" value="Update">
    </form>
<?php else: ?>
    <p>Animal not found.</p>
<?php endif; ?>

</body>

</html>