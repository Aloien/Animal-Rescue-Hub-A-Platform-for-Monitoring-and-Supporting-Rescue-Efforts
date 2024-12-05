<?php
require_once 'classes/dbConnection.php';
require_once 'classes/crudAnimal.php';

$database = new Database();
$db = $database->getConnect();
$animal = new Animals($db);
$stmt = $animal->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Animal Forms</title>

   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <style>
       body {
           display: flex;
           flex-direction: column;
           align-items: center;
           font-family: Arial, sans-serif;
       }

       form,
       table {
           width: 80%;
           margin: 20px 0;
       }

       form {
           display: flex;
           flex-direction: column;
           align-items: center;
           margin: auto;
       }

       label,
       input,
       textarea,
       button {
           margin: 10px 0;
       }

       input,
       textarea,
       button {
           max-width: 300px;
           width: 100%;
           padding: 5px;
       }

       table {
           border-collapse: collapse;
       }

       th,
       td {
           padding: 10px;
           text-align: left;
           border: 1px solid #ddd;
       }
   </style>
</head>


<body>
   <a href="adminDashboard.php" class="back-button" style="position: absolute; top: 10px; left: 10px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; text-decoration: none;">Back</a>
   <h1>Animal for Adoption</h1>

   <form method="POST" action="addAnimal.php" enctype="multipart/form-data">
       <label for="animal">Name:</label>
       <input type="text" id="animal" name="animal" required>

       <label for="species">Species:</label>
       <input type="text" id="species" name="species" required>

       <label for="age">Age:</label>
       <input type="text" id="age" name="age" required>

       <label for="description">Description:</label>
       <textarea id="description" name="description" required></textarea>

       <label for="image">Image:</label>
       <input type="file" id="image" name="image">

       <input type="hidden" name="status" value="pending">

       <button type="submit" class="btn btn-primary">Submit</button>
   </form>
</body>
</html>
