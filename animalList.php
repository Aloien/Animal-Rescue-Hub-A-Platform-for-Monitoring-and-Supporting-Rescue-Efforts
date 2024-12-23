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
    <title>Animal List</title>


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


        table {
            width: 80%; /* Updated width */
            margin: 20px 0;
            border-collapse: collapse;
        }


        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        img {
            max-width: 100px;
        }

        .container {
            width: 80%;
            margin: 20px 0;
        }

        h2 {
            text-align: center;
        }

        button {
            padding: 10px; 
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>


<body>
    <div class="container">
        <button onclick="window.location.href='userDashboard.php'" style="align-self: flex-start;">Back</button>
        <h2>Adoption Status</h2>


        <table id="animalTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Species</th>
                    <th>Age</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['animal']); ?></td>
                        <td><?php echo htmlspecialchars($row['species']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                            <?php if ($row['image']): ?>
                                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Animal Image">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td> <!-- Display status -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <script>
        $(document).ready(function() {
            $('#animalTable').DataTable();
        });
    </script>
</body>


</html>