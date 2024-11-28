<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Forms</title>

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

        .section {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            padding: 20px;
            width: 100%;
        }

        .section h3 {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <h1>Adoption Forms</h1>

    <form action="make_adoption.php" method="POST">
        <!-- Pet Parent Information Section -->
        <div class="section">
            <h3>Pet Parent Information</h3>
            <!-- Name -->
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <!-- Gender -->
            <label>Gender:</label><br>
            <input type="radio" id="male" name="gender" value="Male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="Female" required>
            <label for="female">Female</label><br>

            <!-- Contact -->
            <label for="contact">Contact:</label><br>
            <input type="text" id="contact" name="contact" required><br><br>

            <!-- Monthly Salary -->
            <label for="monthly_salary">Monthly Salary:</label><br>
            <input type="number" id="monthly_salary" name="monthly_salary" min="0" required><br><br>
        </div>

        <!-- Animal Information Section -->
        <div class="section">
            <h3>Animal Information</h3>
            <!-- Animal ID -->
            <label for="animal_id">Animal ID:</label><br>
            <input type="number" id="animal_id" name="animal_id" min="1" required><br><br>

            <!-- Pet Type -->
            <label for="pet_type">Select Pet Type:</label><br>
            <select id="pet_type" name="pet_type" required>
                <option value="">--Select--</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
                <option value="Rabbit">Rabbit</option>
                <option value="Guinea Pig">Guinea Pig</option>
                <option value="Hamster">Hamster</option>
            </select><br><br>
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Submit">
    </form>
</body>

</html>
