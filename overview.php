<?php
require_once 'classes/dbconnection.php';
require_once 'classes/IncidentManagement.php';

// Initialize database connection
$db = new Database();
$conn = $db->getConnect();

// Instantiate the Animals class with the database connection
$crudIncident = new Incident($conn);

// Fetch initial statistics for animals
$totalInFacility = $crudIncident->getTotalInFacility();
$totalAdopted = $crudIncident->getTotalAdopted();
$totalReleased = $crudIncident->getTotalReleased();
$totalUnderMedical = $crudIncident->getTotalUnderMedical();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .chart-container {
            position: relative;
            height: 130vh; 
            width: 130vw;  
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Animal Rescue Statistics</h2>
        <div class="chart-container">
            <canvas id="animalChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function fetchDataAndUpdateChart(chart) {
                $.ajax({
                    url: 'fetchAnimalData.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        // Update statistics
                        $('#totalInFacility').text(data.totalInFacility);
                        $('#totalAdopted').text(data.totalAdopted);
                        $('#totalReleased').text(data.totalReleased);
                        $('#totalUnderMedical').text(data.totalUnderMedical);

                        // Update chart data
                        chart.data.datasets[0].data = [data.totalInFacility, data.totalAdopted, data.totalReleased, data.totalUnderMedical];
                        chart.update();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data: ", error);
                    }
                });
            }

            const data = {
                labels: ['In Facility', 'Adopted', 'Released', 'Under Medical'],
                datasets: [{
                    data: [<?php echo $totalInFacility; ?>, <?php echo $totalAdopted; ?>, <?php echo $totalReleased; ?>, <?php echo $totalUnderMedical; ?>],
                    backgroundColor: ['#007BFF', '#28A745', '#FFD700', '#F39C12'], 
                    hoverBackgroundColor: ['#0056b3', '#1f8b29', '#FFC107', '#E67E22'] 
                }]
            };

            const config = {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right', 
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

            console.log(animalChart);

            // Initial fetch and update of the chart
            fetchDataAndUpdateChart(animalChart);

            // Set an interval to update the chart every 10 seconds
            setInterval(function() {
                fetchDataAndUpdateChart(animalChart);
            }, 10000);
        });
    </script>
</body>
</html>
