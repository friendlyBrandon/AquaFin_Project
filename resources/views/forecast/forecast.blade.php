@extends('layouts.dashboard')

@section('content')

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Rainfall Forecast</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    
    .forc-container {
    width:95%;
    max-width: 1200px;
    margin:10px;
    padding: 10px;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    display: flex;
    flex-direction: column;
    align-items: center;
}


.forc-container h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #1e293b;
    font-size: 2rem;
    font-weight: 700;
}


.chart-wrapper {
    position: relative;
    width: 100%;
    max-width: 1100px;
    height: 550px;
    margin: 0 auto;
}

.rainChart {
    display: block;
    width: 100% !important;
    height: 100% !important;
}

</style>
</head>
<body class="forc-body">

<div class="forc-container">
    <h1>📈 1 Year Rainfall Forecast</h1>
    <div class="chart-wrapper">
        <canvas id="rainChart" class="rainChart"></canvas>
    </div>
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
@endsection