@extends('layouts.dashboard')

@section('content')
    <div class="dashboard">
        <h1 class="title">Dashboard</h1>
        <p>Welcome bij Aquafin materiaalbeheer.</p>

    <div class="reminder">
        <h1>⚠️</h1>
        <h2> REMINDER </h2>
        
        <p>     Vergeet het gasdetectiemeter niet mee te nemen!     </p>
    </div>
        
        <br>
        
        <h2>Neerslag Voorspelling ({{ $provincie }}) </h2> 

        
        @if($weather && isset($weather['daily']))
            <table class="table">
                <thead>
                    <tr>
                        <th>Dag</th>
                        <th>Regen (mm)</th>
                        <th>Regen kans (%)</th>
                        <th>Zal het regenen?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weather['daily']['time'] as $i => $day)
                        <tr>
                            <td>{{ $day }}</td>

                            <td>{{ $weather['daily']['rain_sum'][$i] }}</td>

                            <td>{{ $weather['daily']['precipitation_probability_max'][$i] }}</td>

                            <td>
                                {{ $weather['daily']['rain_sum'][$i] > 0
                                    ? 'Ja'
                                    : 'Nee' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <canvas id="rainChart"></canvas>

        @else
            <p>{{ $error ?? 'Weather unavailable' }}</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        @if($weather && isset($weather['daily']))

        const labels = @json($weather['daily']['time']);

        const rain = @json($weather['daily']['rain_sum']);

        new Chart(document.getElementById('rainChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Regen (mm)',
                        data: rain
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        @endif
    </script>
@endsection