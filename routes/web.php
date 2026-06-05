<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reset-password/{username}', function ($username) {
    return view('auth.reset-password', compact('username'));
});

Route::post('/save-password', [PasswordResetLinkController::class, 'updatePassword']);

Route::get('/dashboard', function () {
    return view('dashboard');
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

require __DIR__.'/auth.php';
