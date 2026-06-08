<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-password/{username}', function ($username) {
    return view('auth.reset-password', compact('username'));
});

Route::post('/save-password', [PasswordResetLinkController::class, 'updatePassword']);

Route::get('/dashboard', function () {

    $provincie = Auth::user()->provincie;

    $geo = Http::get('https://geocoding-api.open-meteo.com/v1/search', [
    'name' => $provincie
])->json();

$location = $geo['results'][0] ?? null;
if (!$location) {
    return view('dashboard', ['weather' => null]);
}

$weather = Http::get('https://api.open-meteo.com/v1/forecast', [
    'latitude' => $location['latitude'],
    'longitude' => $location['longitude'],
    'daily' => 'weather_code,rain_sum,showers_sum,precipitation_probability_max',
    'timezone' => 'auto',
])->json();

    return view('dashboard', [
        'weather' => $weather,
        'provincie' => $provincie
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/materials', [MaterialController::class, 'index']);
Route::post('/materials/{id}', [MaterialController::class, 'order']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
