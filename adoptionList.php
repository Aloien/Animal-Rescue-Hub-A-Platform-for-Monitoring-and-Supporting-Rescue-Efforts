<?php
require_once 'classes/dbConnection.php';
require_once 'classes/crudAdoption.php';
require_once 'classes/crudAnimal.php';
$database = new Database();
$db = $database->getConnect();


$animal = new Animals($db);

// Query to filter only specific species
$query = "SELECT * FROM animals_table WHERE species IN ('Cat', 'Dog', 'Rabbit', 'Guinea Pig', 'Hamster')";
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoptable Animals</title>

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
            width: 80%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        img {
            max-width: 100px;
        }
    </style>
</head>

<body>
    <h2>Adoptable Animals</h2>

    <table id="animalTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Species</th>
                <th>Age</th>
                <th>Description</th>
                <th>Image</th>
                <th>Adopt</th> <!-- Add Adopt column -->
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
                    <td>
                        <form action="adoptionForms.php" method="GET">
                            <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="submit">Adopt</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#animalTable').DataTable();
        });
    </script>
</body>

</html>

