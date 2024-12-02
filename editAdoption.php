<?php
require_once 'classes/dbConnection.php';
require_once 'classes/crudAdoption.php';
require_once 'classes/crudAnimal.php';

$database = new Database();
$db = $database->getConnect();

$adoption = new Adoption($db);
$animal = new Animals($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $adoptionData = $adoption->getAdoptionById($id);
    $animals = $animal->read(); // Fetch all animals for the dropdown
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $animal_id = htmlspecialchars(trim($_POST['animal_id']));
    $adoption->animal_id = $animal_id;
    $adoption->name = htmlspecialchars(trim($_POST['name']));
    $adoption->gender = htmlspecialchars(trim($_POST['gender']));
    $adoption->contact = htmlspecialchars(trim($_POST['contact']));
    $adoption->monthly_salary = htmlspecialchars(trim($_POST['monthly_salary']));
    $adoption->pet_type = htmlspecialchars(trim($_POST['pet_type']));

    // Validate animal_id
    $animalData = $animal->getAnimalById($animal_id);
    if (!$animalData) {
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
            text: 'Invalid animal ID. Please provide a valid animal ID.',
            icon: 'error'
        }).then(() => {
            window.history.back();
        });
        </script>
        </body>
        </html>";
        exit;
    }

    if ($adoption->update($id)) {
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
            text: 'Adoption updated successfully!',
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
            text: 'There was an issue updating the adoption. Please try again later.',
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
    <title>Edit Adoption</title>
</head>
<body>
    <h2>Edit Adoption</h2>
    <form action="editAdoption.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($adoptionData['id']); ?>">

        <label for="animal_id">Animal ID:</label>
        <select id="animal_id" name="animal_id" required>
            <option value="">--Select Animal--</option>
            <?php while ($row = $animals->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo htmlspecialchars($row['id']); ?>" <?php echo ($adoptionData['animal_id'] == $row['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['id']) . ' - ' . htmlspecialchars($row['animal']); ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($adoptionData['name']); ?>" required><br><br>
        
        <label>Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male" <?php echo ($adoptionData['gender'] == 'Male') ? 'checked' : ''; ?> required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="Female" <?php echo ($adoptionData['gender'] == 'Female') ? 'checked' : ''; ?> required>
        <label for="female">Female</label><br><br>
        
        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($adoptionData['contact']); ?>" required><br><br>
        
        <label for="monthly_salary">Monthly Salary:</label>
        <input type="number" id="monthly_salary" name="monthly_salary" value="<?php echo htmlspecialchars($adoptionData['monthly_salary']); ?>" required><br><br>
        
        <label for="pet_type">Select Pet Type:</label><br>
        <select id="pet_type" name="pet_type" required>
            <option value="">--Select--</option>
            <option value="Cat" <?php echo ($adoptionData['pet_type'] == 'Cat') ? 'selected' : ''; ?>>Cat</option>
            <option value="Dog" <?php echo ($adoptionData['pet_type'] == 'Dog') ? 'selected' : ''; ?>>Dog</option>
            <option value="Rabbit" <?php echo ($adoptionData['pet_type'] == 'Rabbit') ? 'selected' : ''; ?>>Rabbit</option>
            <option value="Guinea Pig" <?php echo ($adoptionData['pet_type'] == 'Guinea Pig') ? 'selected' : ''; ?>>Guinea Pig</option>
            <option value="Hamster" <?php echo ($adoptionData['pet_type'] == 'Hamster') ? 'selected' : ''; ?>>Hamster</option>
        </select><br><br>
        
        <button type="submit">Update Adoption</button>
    </form>
</body>
</html>