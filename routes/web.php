<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontrolaKvalitetaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   // Route::resource('dobavljaci', \App\Http\Controllers\DobavljacController::class);
    Route::resource('dobavljaci', \App\Http\Controllers\DobavljacController::class)
    ->parameters(['dobavljaci' => 'dobavljac']);

    //Route::resource('otkupi', \App\Http\Controllers\OtkupController::class);
    Route::resource('otkupi', \App\Http\Controllers\OtkupController::class)
    ->parameters(['otkupi' => 'otkup']);

     // Route::resource('serije', \App\Http\Controllers\SerijaPreradeController::class);
     Route::resource('serije', \App\Http\Controllers\SerijaPreradeController::class)
    ->parameters(['serije' => 'serija']);

    //Route::resource('zalihe', \App\Http\Controllers\ZalihaController::class);
    Route::resource('zalihe', \App\Http\Controllers\ZalihaController::class)
    ->parameters(['zalihe' => 'zaliha']);

    Route::get('/kontrola-kvaliteta', [KontrolaKvalitetaController::class, 'index'])->name('qc.index');
    Route::get('/kontrola-kvaliteta/{serija}/edit', [KontrolaKvalitetaController::class, 'edit'])->name('qc.edit');
    Route::put('/kontrola-kvaliteta/{serija}', [KontrolaKvalitetaController::class, 'update'])->name('qc.update');


});

require __DIR__.'/auth.php';
