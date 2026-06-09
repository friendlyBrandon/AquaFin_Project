<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Neerslagvoorspelling</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <h1>Voorspelling Neerslag (2026 - 2030)</h1>
    <p>Gebaseerd op Lineaire Regressie per maand.</p>

    <div id="charts-container">
        {{-- Hier wordt per maand een canvas geplaatst --}}
    </div>

    <script>
        // De data moet vanuit PHP naar JavaScript worden geëxtrapoleerd
        const monthlyForecastData = @json($forecastedRainfall);

        // Function om de grafiek te tekenen
        function renderChart(monthlyData, monthName) {
            const container = document.getElementById('chart-container');
            const canvasId = `chart-${monthName}`;

            // Maak een container voor deze specifieke maand
            const div = document.createElement('div');
            div.className = 'chart-wrapper';
            div.innerHTML = `<h2>${monthName}</h2><canvas id="${canvasId}"></canvas>`;
            container.appendChild(div);

            const ctx = document.getElementById(canvasId).getContext('2d');
            
            // Initialiseer de Chart
            new Chart(ctx, {
                type: 'bar', // Bar is vaak het beste voor maandelijkse voorspellingen
                data: {
                    labels: monthlyData.map(item => item.year), // X-as: Jaartallen
                    datasets: [{
                        label: 'Voorspelde Neerslag (mm)',
                        data: monthlyData.map(item => item.rainfall), // Y-as: Neerslag
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Neerslag (mm)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Jaar'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: `Voorspelling voor ${monthName}`
                        }
                    }
                }
            });
        }

        // Loop over de data en genereer een grafiek voor elke maand
        Object.keys(monthlyForecastData).forEach(month => {
            const data = monthlyForecastData[month];
            renderChart(data, month);
        });
    </script>

</body>
</html>
