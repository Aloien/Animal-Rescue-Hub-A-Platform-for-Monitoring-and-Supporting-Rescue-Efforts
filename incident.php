<?php
// Include the database connection and incident classes
require_once 'classes/dbConnection.php';
require_once 'classes/Incident.php';

// Create a new instance of the Database class
$database = new Database();
// Get the database connection
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
        label, input, textarea, button {
            margin: 10px 0;
        }
        input, textarea, button {
            max-width: 300px; 
            width: 100%; 
            padding: 5px; 
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Incident Report</h1>

    <form action="createIncident.php" method="post" enctype="multipart/form-data">
        <label for="animal_type">Animal Type:</label>
        <input type="text" id="animal_type" name="animal_type" required>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
        
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="pending">Pending</option>
            <option value="rescued">Rescued</option>
        </select>
        
        <button type="submit">Report Incident</button>
    </form>
    
    <!-- Incidents Table -->
    <table id="incidentTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Animal Type</th>
                <th>Location</th>
                <th>Date</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['animal_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>
                        <?php if (!empty($row['image'])): ?>
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Incident Image" style="max-width: 100px;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        // Initialize DataTables plugin for the incidents table
        $(document).ready(function() {
            $('#incidentTable').DataTable();
        });
    </script>
</body>
</html>