<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
      Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::resource('dobavljaci', \App\Http\Controllers\DobavljacController::class);
    Route::resource('otkupi', \App\Http\Controllers\OtkupController::class);
    Route::resource('serije', \App\Http\Controllers\SerijaPreradeController::class);
    Route::resource('zalihe', \App\Http\Controllers\ZalihaController::class);
});

require __DIR__.'/auth.php';
