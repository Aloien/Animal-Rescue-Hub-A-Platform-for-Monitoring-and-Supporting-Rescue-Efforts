<?php
require_once 'classes/dbConnection.php';
require_once 'classes/incidentManagement.php';
require_once 'classes/crudAdoption.php';
require_once 'classes/crudAnimal.php';

$database = new Database();
$db = $database->getConnect();
$incident = new Incident($db);
$crudAdoption = new Adoption($db);
$crudAnimal = new Animals($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the status of the incident
    if ($incident->updateStatus($id, $status)) {
        // Get the incident details
        $incidentData = $incident->getIncidentById($id);

        // Check if the animal_id exists in the animals_table
        $animal = $crudAnimal->getAnimalById($incidentData['id']);
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

        // Create a new adoption entry
        $crudAdoption->animal_id = $animal['id'];
        $crudAdoption->name = $incidentData['animal_type'];
        $crudAdoption->gender = ''; // Set default or fetch from incident details if available
        $crudAdoption->contact = ''; // Set default or fetch from incident details if available
        $crudAdoption->monthly_salary = 0; // Set default or fetch from incident details if available
        $crudAdoption->pet_type = $incidentData['animal_type'];

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
                text: 'Incident marked for adoption and moved to adoption list successfully!',
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
            text: 'There was an issue updating the incident status. Please try again later.',
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