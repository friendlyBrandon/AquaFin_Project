<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ContactController;
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
