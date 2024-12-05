<?php

require_once 'classes/dbConnection.php';
require_once 'classes/crudAdoption.php';
require_once 'classes/crudAnimal.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Initialize database connection
    $database = new Database();
    $db = $database->getConnect();

    // Instantiate the Adoption class
    $adoptionForm = new Adoption($db);
    $crudAnimal = new Animals($db);

    // Retrieve and sanitize form data
    $adoptionForm->animal_id = htmlspecialchars(trim($_POST['animal_id']));
    $adoptionForm->name = htmlspecialchars(trim($_POST['name']));
    $adoptionForm->gender = htmlspecialchars(trim($_POST['gender']));
    $adoptionForm->contact = htmlspecialchars(trim($_POST['contact']));
    $adoptionForm->monthly_salary = htmlspecialchars(trim($_POST['monthly_salary']));

    // Check if the animal_id exists in the animals_table
    $animal = $crudAnimal->getAnimalById($adoptionForm->animal_id);
    if (!$animal) {
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
            text: 'The specified animal ID does not exist.',
            icon: 'error'
        }).then(() => {
            window.history.back();
        });
        </script>
        </body>
        </html>";
        exit;
    }

    // Add server-side validations if needed (e.g., salary must be a number)
    if (!is_numeric($adoptionForm->monthly_salary) || $adoptionForm->monthly_salary < 0) {
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
            text: 'Monthly salary must be a valid number.',
            icon: 'error'
        }).then(() => {
            window.history.back();
        });
        </script>
        </body>
        </html>";
        exit;
    }

    // Create the form entry in the database
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
            // Redirect to a thank-you or index page after the user acknowledges the alert
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
