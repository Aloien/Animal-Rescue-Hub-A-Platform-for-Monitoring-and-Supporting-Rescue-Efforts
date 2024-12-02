<?php
require_once 'classes/dbConnection.php';
require_once 'classes/crudAnimal.php';
require_once 'classes/crudAdoption.php';

$database = new Database();
$db = $database->getConnect();
$crudAnimal = new Animals($db);
$crudAdoption = new Adoption($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the status of the animal
    if ($crudAnimal->updateStatus($id, $status)) {
        // Get the animal details
        $animal = $crudAnimal->getAnimalById($id);

        // Create a new adoption entry
        $crudAdoption->animal_id = $animal['id'];
        $crudAdoption->name = $animal['animal'];
        $crudAdoption->gender = ''; // Set default or fetch from animal details if available
        $crudAdoption->contact = ''; // Set default or fetch from animal details if available
        $crudAdoption->monthly_salary = 0; // Set default or fetch from animal details if available
        $crudAdoption->pet_type = $animal['species'];

        if ($crudAdoption->create()) {
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
                text: 'Animal marked for adoption and moved to adoption list successfully!',
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
                text: 'There was an issue creating the adoption entry. Please try again later.',
                icon: 'error'
            }).then(() => {
                window.history.back();
            });
            </script>
            </body>
            </html>";
        }
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
            text: 'There was an issue updating the animal status. Please try again later.',
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