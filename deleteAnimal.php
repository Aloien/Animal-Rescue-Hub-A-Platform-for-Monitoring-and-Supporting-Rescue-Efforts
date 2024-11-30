<?php
require_once 'classes/crudAnimal.php';
$crudAnimal = new Animals();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

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
            text: 'User deleted successfully!',
            icon: 'success'
        }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'admin_dashboard.php';
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
            text: 'Error deleting user!',
            icon: 'error'
        }).then((result) => {
            if(result.isConfirmed) {
                window.location.href = 'admin_dashboard.php';
            }
        });
        </script>
        </body>
        </html>";
    }
}
?>
