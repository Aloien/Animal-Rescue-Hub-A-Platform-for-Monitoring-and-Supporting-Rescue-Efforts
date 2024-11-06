<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Reporting Page</title>
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
    
    <!-- Add Incident Form -->
    <form action="" method="post" enctype="multipart/form-data">
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
        
        <button type="submit">Report Incident</button>
    </form>
    
    <!-- Incidents Table -->
    <table>
        <thead>
            <tr>
                <th>Animal Type</th>
                <th>Location</th>
                <th>Date</th>
                <th>Description</th>
                <th>Status</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>
</body>
</html>