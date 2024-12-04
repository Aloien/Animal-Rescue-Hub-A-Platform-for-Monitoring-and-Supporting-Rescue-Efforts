<?php
require_once 'classes/dbConnection.php';
require_once 'classes/crudAdoption.php';
require_once 'classes/crudAnimal.php';

$database = new Database();
$db = $database->getConnect();

$animal_id = isset($_GET['animal_id']) ? htmlspecialchars($_GET['animal_id']) : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adoptionForm = new Adoption($db);

    $adoptionForm->animal_id = htmlspecialchars(trim($_POST['animal_id']));
    $adoptionForm->name = htmlspecialchars(trim($_POST['name']));
    $adoptionForm->gender = htmlspecialchars(trim($_POST['gender']));
    $adoptionForm->contact = htmlspecialchars(trim($_POST['contact']));
    $adoptionForm->monthly_salary = htmlspecialchars(trim($_POST['monthly_salary']));

    if ($adoptionForm->create()) {
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
            text: 'Your adoption form was successfully submitted!',
            icon: 'success'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'adoptionList.php';
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
            text: 'There was an issue submitting your form. Please try again later.',
            icon: 'error'
        }).then(() => {
            window.location.href = 'adoptionList.php';
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
    <title>Adoption Form</title>
</head>
<body>
    <h2>Adoption Form</h2>
    <form action="createAdoption.php" method="post">
        <input type="hidden" name="animal_id" value="<?php echo $animal_id; ?>">
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label>Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="Female" required>
        <label for="female">Female</label><br><br>
        
        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" required><br><br>
        
        <label for="monthly_salary">Monthly Salary:</label>
        <input type="number" id="monthly_salary" name="monthly_salary" min="0" required><br><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
