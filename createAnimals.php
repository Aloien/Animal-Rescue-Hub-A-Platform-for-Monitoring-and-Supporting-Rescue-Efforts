<?php


require_once 'classes/dbConnection.php';
require_once 'classes/crudAnimal.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $database = new Database();


    $db = $database->getConnect();


    $animal = new Animals($db);


    $animal->animal = htmlspecialchars(trim($_POST['animal']));
    $animal->species = htmlspecialchars(trim($_POST['species']));
    $animal->age = htmlspecialchars(trim($_POST['age']));
    $animal->description = htmlspecialchars(trim($_POST['description']));
    $animal->status = htmlspecialchars(trim($_POST['status'])); // Add status field


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {


        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024;


        if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {


            $targetDir = "animalImages/";


            $targetFile = $targetDir . basename($_FILES["image"]["name"]);


            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {


                $animal->image = $targetFile;
            } else {


                echo "Error uploading file.";
                exit;
            }
        } else {


            echo "Invalid file type or size.";
            exit;
        }
    } else {


        $animal->image = null;
    }


    if ($animal->create()) {


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
            text: 'Animal was successfully added!',
            icon: 'success'
        }).then((result) => {
            // Redirect to the animal index page after the user acknowledges the alert
            if(result.isConfirmed) {

                window.location.href = 'adminDashboard.php';
                window.location.href = 'animalList.php';
            }
        });
        </script>
        </body>
        </html>";
    } else {


        echo "Error adding animal. Please try again later.";
    }
}