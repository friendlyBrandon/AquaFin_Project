<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $provincie = Auth::user()->provincie;

        try {
            $geoResponse = Http::timeout(5)->get(
                'https://geocoding-api.open-meteo.com/v1/search',
                ['name' => $provincie]
            );

            if (!$geoResponse->successful()) {
                throw new \Exception('Geocoding service unavailable');
            }

            $geo = $geoResponse->json();
            $location = $geo['results'][0] ?? null;

            if (!$location) {
                return view('dashboard', [
                    'weather' => null,
                    'forecast' => null,
                    'provincie' => $provincie,
                    'error' => 'Locatie kon niet worden gevonden.'
                ]);
            }

            $weatherResponse = Http::timeout(5)->get(
                'https://api.open-meteo.com/v1/forecast',
                [
                    'latitude' => $location['latitude'],
                    'longitude' => $location['longitude'],
                    'daily' => 'weather_code,rain_sum,showers_sum,precipitation_probability_max',
                    'timezone' => 'auto',
                ]
            );

            if (!$weatherResponse->successful()) {
                throw new \Exception('Weather service unavailable');
            }

            $weather = $weatherResponse->json();

            // 🔥 hier halen we forecast data (session of fallback)
            $forecast = session('forecast', null);
            $floodRisk = session('floodRisk', false);
            $suggestedMaterials = session('suggestedMaterials', collect());

            return view('dashboard', compact(
                'weather',
                'forecast',
                'provincie',
                'floodRisk',
                'suggestedMaterials'
            ));

        } catch (\Exception $e) {
            return view('dashboard', [
                'weather' => null,
                'forecast' => null,
                'provincie' => $provincie,
                'error' => 'We konden de weersgegevens momenteel niet laden.'
            ]);
        }
    }
}