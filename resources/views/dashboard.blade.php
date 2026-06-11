@extends('layouts.dashboard')

@section('content')
    <div class="dashboard">

        <div class="dashboard-header">
            <h2>Welkom, {{ auth()->user()->username }}</h2>
            <p>Aquafin Material Management Dashboard</p>
        </div>

        <div class="reminder">
            <h1>⚠️</h1>
            <h2> REMINDER </h2>
            <p>Vergeet het gasdetectiemeter niet mee te nemen!</p>
        </div>


        <br>

        <h2>Neerslag Voorspelling <span class="provincie">({{ $provincie }})</span> </h2>
        <br>

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

                <div class="chart-wrapper">
                    <div class="chart"></div>
                    <canvas id="rainChart" width="200" height="100"
                        style="display: block; box-sizing: border-box; height: 191px; width: 382px;"></canvas>
                </div>
            </div>
        @else
        <div class="alert alert-warning">
            {{ $error ?? 'Weersgegevens zijn momenteel niet beschikbaar.' }}
        </div>
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