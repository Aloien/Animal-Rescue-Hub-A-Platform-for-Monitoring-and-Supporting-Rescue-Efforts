<?php
require_once 'classes/dbConnection.php';
require_once 'classes/crudAdoption.php';
require_once 'classes/crudAnimal.php';
$database = new Database();
$db = $database->getConnect();

$animal = new Animals($db);

// Query to select all animals
$query = "SELECT * FROM animals_table";
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

        .animal-card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 20px;
            padding: 10px;
            text-align: center;
        }

        .animal-card img {
            max-width: 100%;
            border-radius: 8px;
        }

        .animal-card h3 {
            margin: 10px 0;
        }

        .animal-card p {
            margin: 5px 0;
        }

        .animal-card button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .animal-card button:hover {
            background-color: #0056b3;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        h2 {
            text-align: center;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px;
        }

        .header h2 {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Adoptable Animals</h2>
        <button onclick="window.location.href='userDashboard.php'">Back</button>
    </div>
    <div class="container">
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="animal-card">
                <?php if ($row['image']): ?>
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Animal Image">
                <?php endif; ?>
                <h3><?php echo htmlspecialchars($row['animal']); ?></h3>
                <p><strong>Species:</strong> <?php echo htmlspecialchars($row['species']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($row['age']); ?></p>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <form action="adoptionForms.php" method="GET">
                    <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <button type="submit">Adopt</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <script>
        $(document).ready(function() {
            $('#animalTable').DataTable();
        });
    </script>
</body>

</html>