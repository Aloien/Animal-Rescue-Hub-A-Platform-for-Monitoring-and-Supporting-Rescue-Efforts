<?php
require_once 'classes/dbConnection.php';
require_once 'classes/crudAnimal.php';
require_once 'classes/crudAdoption.php';

$database = new Database();
$db = $database->getConnect();
$crudAnimal = new Animals($db);
$crudAdoption = new Adoption($db);

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete related adoption entries
    $crudAdoption->deleteByAnimalId($id);

    // Delete the animal entry
    if ($crudAnimal->delete($id)) {
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
            text: 'Animal deleted successfully!',
            icon: 'success'
        }).then((result) => {
            if(result.isConfirmed) {
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
            <title>SweetAlert</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Error!',
            text: 'Error deleting animal!',
            icon: 'error'
        }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'adminDashboard.php';
            }
        });
        </script>
        </body>
        </html>";
    }
}
?>
