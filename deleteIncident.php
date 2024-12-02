<?php
require_once 'classes/dbConnection.php';
require_once 'classes/incidentManagement.php';

$database = new Database();
$db = $database->getConnect();

$incident = new Incident($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    if ($incident->delete($id)) {
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
            text: 'Incident deleted successfully!',
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
            text: 'There was an issue deleting the incident. Please try again later.',
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