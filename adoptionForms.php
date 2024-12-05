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
    <link rel="stylesheet" href="css/styles.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        form {
            width: 80%;
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        @media (max-width: 600px) {
            form {
                width: 100%;
            }
            input, textarea, select, button {
                max-width: 100%;
            }
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <a href="userDashboard.php" class="back-button">Back</a>
    <h1 class="section-title">Adoption Form</h1>
    <form action="createAdoption.php" method="post">
        <input type="hidden" name="animal_id" value="<?php echo $animal_id; ?>">
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">--Select--</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>
        
        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" required><br>
        
        <label for="monthly_salary">Monthly Salary (in Peso):</label>
        <select id="monthly_salary" name="monthly_salary" required>
            <option value="">--Select--</option>
            <option value="Less than 10,000">Less than 10,000</option>
            <option value="10,000 - 20,000">10,000 - 20,000</option>
            <option value="20,000 - 30,000">20,000 - 30,000</option>
            <option value="30,000 - 40,000">30,000 - 40,000</option>
            <option value="40,000 - 50,000">40,000 - 50,000</option>
            <option value="More than 50,000">More than 50,000</option>
        </select><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>