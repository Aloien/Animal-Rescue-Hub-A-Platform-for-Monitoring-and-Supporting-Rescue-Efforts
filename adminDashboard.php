<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION["adminEmail"])) {
    header("Location: login.php");
    exit();
}

require_once 'classes/dbConnection.php';
require_once 'classes/crudAnimal.php';
require_once 'classes/crudAdoption.php';
require_once 'classes/crudOperation.php';
require_once 'classes/incidentManagement.php';

$database = new Database();
$pdo = $database->getConnect();

$crud = new CrudOperation($pdo);
$users = $crud->getUsers();
$crudAnimal = new Animals($pdo);
$animals = $crudAnimal->read();
$crudAdoption = new Adoption($pdo);
$adoptions = $crudAdoption->getAdoptions();
$incident = new Incident($pdo);
$incidents = $incident->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
    <header>
        <h1 class="text-center my-4">Welcome to Admin Dashboard</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Dashboard</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <button onclick="history.back()" class="btn btn-secondary mb-3">Back</button>
        <h2>Users List</h2>
        <table id="userTable" class="table table-striped display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                        <td class="action-buttons">
                            <form method="GET" action="editUser.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <button type="submit" class="btn btn-success">Edit</button>
                            </form>
                            <form method="POST" action="deleteUser.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-4">
        <h2>Incident List</h2>
        <table id="animalIncidentTable" class="table table-striped display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Animal Type</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Geolocation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $incidents->fetch(PDO::FETCH_ASSOC)): ?>
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
                        <td> <?php if (!empty($row['geolocation'])): ?>
                                <?php list($lat, $lon) = explode(',', $row['geolocation']); ?>
                                <button onclick="window.open('https://www.google.com/maps?q=<?php echo $lat; ?>,<?php echo $lon; ?>', '_blank')">Locate</button>
                            <?php endif; ?>
                        </td>
                        <td class="action-buttons">
                            <form method="POST" action="animalForms.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="hidden" name="status" value="for adoption">
                                <button type="submit" class="btn btn-primary">Mark Animal for Adoption</button>
                            </form>
                            <form method="GET" action="editIncident.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-success">Edit</button>
                            </form>
                            <form method="POST" action="deleteIncident.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this incident?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-4">
        <h2>Animals Ready for Adoption</h2>
        <table id="adoptionTable" class="table table-striped display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Animal Name</th>
                    <th>Species</th>
                    <th>Age</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $animals->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['animal']); ?></td>
                        <td><?php echo htmlspecialchars($row['species']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                            <?php if ($row['image']): ?>
                                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Animal Image" style="max-width: 100px;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td class="action-buttons">
                            <form method="GET" action="editAnimal.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-success">Edit</button>
                            </form>
                            <form method="POST" action="deleteAnimal.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this animal?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-4">
    <h2>Adoption Requests</h2>
    <table id="adoptionRequestTable" class="table table-striped display">
        <thead>
            <tr>
                <th>Animal ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Monthly Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($adoptions as $adoption): ?>
            <tr>
                <td><?php echo htmlspecialchars($adoption['animal_id']); ?></td>
                <td><?php echo htmlspecialchars($adoption['name']); ?></td>
                <td><?php echo htmlspecialchars($adoption['gender']); ?></td>
                <td><?php echo htmlspecialchars($adoption['contact']); ?></td>
                <td><?php echo htmlspecialchars($adoption['monthly_salary']); ?></td>
                <td class="action-buttons">
                    <form method="POST" action="approveAdoption.php" style="display:inline;">
                        <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($adoption['animal_id']); ?>">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to approve this adoption?')">Approve</button>
                    </form>
                    <form method="POST" action="deleteAdoption.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($adoption['id']); ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this request?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
            $('#animalIncidentTable').DataTable();
            $('#adoptionTable').DataTable();
            $('#adoptionRequestTable').DataTable();
        });
    </script>
</body>

</html>