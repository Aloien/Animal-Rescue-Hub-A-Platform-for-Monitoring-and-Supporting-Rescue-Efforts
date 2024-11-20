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


    <?php

    require_once 'animal_database.php';

    $database = new Database();

    $db = $database->getConnect();

    $animal = new Animals($db);

    $stmt = $animal->read();
    ?>

    <h2>Animal List</h2>

    <table id="animalTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Species</th>
                <th>Age</th>
                <th>Description</th>
                <th>Image</th>
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
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Incident Image" style="max-width: 100px;">
                        <?php endif; ?>
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
    <a href="animal_forms.php"><button>Add Animal</button></a>
</body>

</html>