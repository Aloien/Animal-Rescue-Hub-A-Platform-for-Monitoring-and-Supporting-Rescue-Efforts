<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Animal Rescue Statistics</h2>
        <canvas id="animalChart" width="400" height="400"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = {
                labels: ['Rescued', 'Released into Wildlife', 'Adopted', 'In Shelter', 'Under Medical Care', 'Fostered'],
                datasets: [{
                    data: [120, 45, 78, 60, 30, 50], // Example data, replace with your actual data
                    backgroundColor: ['#0a7075', '#6ba3be', '#0c969c', '#f5a623', '#f56217', '#f55337'],
                    hoverBackgroundColor: ['#0c969c', '#032f30', '#274d60', '#e59500', '#d85100', '#c54b23']
                }]
            };

            const config = {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
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
