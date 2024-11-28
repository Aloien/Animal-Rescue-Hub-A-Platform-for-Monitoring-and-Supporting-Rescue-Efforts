<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION["loginEmail"])) {
    header("Location: login.php");
    exit();
}

require 'classes/crudOperation.php';
$db = new Database();
$conn = $db->getConnect();
$crud = new CrudOperation($conn);

// Fetch totals
$totalRescued = $crud->getTotalRescued();
$totalReleased = $crud->getTotalReleased();
$totalAdopted = $crud->getTotalAdopted();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Rescue Overview</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            position: relative;
            height: 50vh;
            width: 50vw;
            margin: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="text-center my-4">Animal Rescue Overview</h1>
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
        <h2>Animal Rescue Statistics</h2>
        <div class="chart-container">
            <canvas id="animalChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = {
                labels: ['Rescued', 'Released into Wildlife', 'Adopted'],
                datasets: [{
                    data: [<?php echo $totalRescued; ?>, <?php echo $totalReleased; ?>, <?php echo $totalAdopted; ?>],
                    backgroundColor: ['#0a7075', '#6ba3be', '#0c969c'],
                    hoverBackgroundColor: ['#0c969c', '#032f30', '#274d60']
                }]
            };

            const config = {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || '';
                                    return `${label}: ${value}`;
                                }
                            }
                        }
                    }
                }
            };

            const animalChart = new Chart(
                document.getElementById('animalChart'),
                config
            );
        });
    </script>
</body>
</html>
