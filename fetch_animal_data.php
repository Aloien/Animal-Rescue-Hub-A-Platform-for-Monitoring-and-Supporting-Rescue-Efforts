<?php
require_once 'classes/dbconnection.php';
require_once 'classes/crudAnimal.php';

// Initialize database connection
$db = new Database();
$conn = $db->getConnect();

// Instantiate the Animals class with the database connection
$crudAnimal = new Animals($conn);

// Fetch statistics for animals
$totalInFacility = $crudAnimal->getTotalInFacility();
$totalAdopted = $crudAnimal->getTotalAdopted();
$totalReleased = $crudAnimal->getTotalReleased();
$totalUnderMedical = $crudAnimal->getTotalUnderMedical();

// Return data as JSON
echo json_encode([
    'totalInFacility' => $totalInFacility,
    'totalAdopted' => $totalAdopted,
    'totalReleased' => $totalReleased,
    'totalUnderMedical' => $totalUnderMedical
]);
?>
