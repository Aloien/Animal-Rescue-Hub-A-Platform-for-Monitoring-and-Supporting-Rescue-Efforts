<?php
require_once 'classes/dbconnection.php';
require_once 'classes/IncidentManagement.php';

// Initialize database connection
$db = new Database();
$conn = $db->getConnect();

// Instantiate the Animals class with the database connection
$crudIncident = new Incident($conn);

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
