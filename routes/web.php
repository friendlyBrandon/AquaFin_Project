<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
<<<<<<< HEAD
use App\Http\Controllers\CartController;
=======
use App\Http\Controllers\ContactController;
>>>>>>> ecd5df849b3a5a583c16dc889ee53e7573f8b6cc
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
Route::post('/materials/{id}', [MaterialController::class, 'addToCart']);

Route::get('/cart',[CartController::class, 'index']);
Route::post('/cart/update/{id}', [CartController::class, 'update']);
Route::post('/cart/remove/{id}', [CartController::class, 'remove']);
Route::get('/checkout', [CartController::class, 'checkout']);
Route::post('/cart/checkout/{id}', [CartController::class, 'checkout']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () { 
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/verstuur', [ContactController::class, 'store']);
});

require __DIR__.'/auth.php';
