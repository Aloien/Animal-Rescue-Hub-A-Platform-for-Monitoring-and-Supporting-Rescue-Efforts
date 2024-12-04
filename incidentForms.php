<?php
require_once 'classes/dbConnection.php';
require_once 'classes/incidentManagement.php';

// Create a new instance of the Database class
$database = new Database();
$db = $database->getConnect();

// Create a new instance of the Incident class with the database connection
$incident = new Incident($db);

// Fetch all incidents from the database
$stmt = $incident->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        form, table {
            width: 80%;
            margin: 20px 0;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center; 
            margin: auto; 
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        @media (max-width: 600px) {
            form, table {
                width: 100%;
            }
            input, textarea, button {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Incident Report</h1>

    <form action="createIncident.php" method="post" enctype="multipart/form-data" onsubmit="return setGeolocation()">
        <label for="animal_type">Animal Type:</label>
        <input type="text" id="animal_type" name="animal_type" required>
        
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        
        <input type="hidden" id="geolocation" name="geolocation">
        
        <button type="submit">Report Incident</button>
    </form>

    <table id="incidentTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Animal Type</th>
                <th>Date</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Geolocation</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['animal_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>
                        <?php if ($row['image']): ?>
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Incident Image" style="max-width: 100px;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if (!empty($row['geolocation'])): ?>
                            <?php list($lat, $lon) = explode(',', $row['geolocation']); ?>
                            <button onclick="window.open('https://www.google.com/maps?q=<?php echo $lat; ?>,<?php echo $lon; ?>', '_blank')">Locate</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script>
        function setGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    document.getElementById('geolocation').value = lat + ',' + lon;
                    document.forms[0].submit();
                }, function(error) {
                    console.error('Error getting geolocation: ', error);
                    return false;
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
                return false;
            }
            return false;
        }
    </script>
</body>
</html>