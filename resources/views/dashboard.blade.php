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
        @php
            $floodRisk = session('floodRisk', false);
            $suggestedMaterials = session('suggestedMaterials', collect());
        @endphp

        @if($floodRisk)
            <div class="alert-warning">
                <h3>AANGERADEN MATERIAAL</h3>
                <form method="POST" action="{{ route('cart.addSuggested') }}">
                    @csrf

                    @foreach($suggestedMaterials as $material)
                        <input type="hidden" name="materials[]" value="{{ $material['id'] }}">
                    @endforeach

                    <button type="submit" style="background:linear-gradient(135deg, #0099d8, #00b4ff);
                color: white;border: none;border-radius: 12px;
                padding: 12px 24px;font-size: 0.95rem;font-weight: 600;
                cursor: pointer;box-shadow: 0 4px 12px rgba(0, 153, 216, 0.25)">
                        Aan winkelmand toevoegen
                    </button>
                </form>

            </div>
        @endif


        <br>
        <div class="neerslag-dashboard">
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