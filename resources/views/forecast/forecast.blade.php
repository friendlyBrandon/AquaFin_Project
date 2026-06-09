<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Rainfall Forecast</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📈 1 Year Rainfall Forecast</h1>

    <canvas id="rainChart"></canvas>
</div>

@php
    // PHP data naar JS voorbereiden
    $labels = [];
    $values = [];

    foreach ($processedForecast as $item) {
        $labels[] = $item['year'] . '-' . str_pad($item['month'], 2, '0', STR_PAD_LEFT);
        $values[] = $item['rainfall'];
    }
@endphp

<script>
    const labels = @json($labels);
    const data = @json($values);

    const ctx = document.getElementById('rainChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Rainfall (mm)',
                data: data,
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                tension: 0.3,
                fill: true,
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 90,
                        minRotation: 45
                    }
                },
                y: {
                    beginAtZero: false
                }
            }
        }
    });
</script>

</body>
</html>