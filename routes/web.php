<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
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

Route::middleware('auth')->group(function () {
Route::post('/cart/suggested', [CartController::class, 'addSuggested'])
    ->name('cart.addSuggested');
});
Route::middleware('auth')->group(function () {
Route::get('/materials', [MaterialController::class, 'index']);
Route::post('/materials/bestel', [MaterialController::class, 'order']);
Route::post('/materials/maatwerk', [\App\Http\Controllers\CartController::class, 'addMaatwerk']);
Route::post('/materials/create', [MaterialController::class, 'store']);
Route::post('/materials/update', [MaterialController::class, 'update']);
Route::post('/materials/delete/{id}', [MaterialController::class, 'destroy']);
});

Route::get('/forecast', [ForcastController::class, 'forecast']);

Route::middleware('auth')->group(function () {
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/checkout/{id}', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::middleware('auth')->group(function () {
    Route::post('/orderlog', [OrderlogController::class, 'store'])->name('orderlog.store');
    Route::get('/orderlog', [OrderlogController::class, 'index'])->name('orderlog.index');
    Route::post('/orderlog/{order_id}/status/{status}', [OrderlogController::class, 'updateStatus'])->name('orderlog.status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact/verstuur', [ContactController::class, 'store']);
});

Route::middleware(['auth', 'rain.session'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/forecast', [ForcastController::class, 'forecast'])
        ->name('forecast.forecast');
});

require __DIR__ . '/auth.php';