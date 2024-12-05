<?php
session_start();
if (!isset($_SESSION["adminEmail"])) {
    header("Location: login.php");
    exit();
}

require_once 'classes/dbConnection.php';
require_once 'classes/crudAnimal.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["animal_id"])) {
    $animal_id = $_POST["animal_id"];

    // Initialize database and Animals class
    $database = new Database();
    $pdo = $database->getConnect();
    $crudAnimal = new Animals($pdo);

    try {
        // Use the updateStatus method to approve the adoption
        if ($crudAnimal->updateStatus($animal_id, 'Approved')) {
            // Redirect back with a success message
            header("Location: adminDashboard.php?message=Adoption+approved");
            exit();
        } else {
            // Redirect back with an error message
            header("Location: adminDashboard.php?error=Failed+to+approve+adoption");
            exit();
        }
    } catch (Exception $e) {
        // Handle any unexpected exceptions
        header("Location: adminDashboard.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    // Redirect if the request is invalid
    header("Location: adminDashboard.php");
    exit();
}
