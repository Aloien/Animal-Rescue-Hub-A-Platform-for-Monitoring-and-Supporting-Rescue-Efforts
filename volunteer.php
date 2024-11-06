<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Directory Page</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        form, table {
            width: 50%;
            margin: 20px 0;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label, input, button {
            margin: 10px 0;
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
    <h1>Volunteer Page</h1>
    
    <!-- Add Volunteer Form -->
    <form action="" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        
        <label for="contact_info">Contact Info:</label>
        <input type="text" id="contact_info" name="contact_info" required>
        
        <label for="role">Role:</label>
        <input type="text" id="role" name="role" required>
        
        <button type="submit">Add Volunteer</button>
    </form>
    
    <!-- Volunteer List -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact Info</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</body>
</html>