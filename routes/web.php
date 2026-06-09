<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForcastController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderlogController;

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

Route::get('/forecast', [ForcastController::class, 'forecast']);

Route::post('/materials/bestel', [MaterialController::class, 'order']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');

Route::post('/cart/checkout/{id}', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/orderlog', [OrderlogController::class, 'index'])->name('orderlog.index');
Route::post('/orderlog', [OrderlogController::class, 'index'])->name('orderlog.index');

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
