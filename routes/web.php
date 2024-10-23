<?php

use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::get('/', function () {
    return redirect('/login');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/habitaciones', function () {
    return view('habitaciones'); // Asegúrate de que esto apunte a tu vista
})->name('habitaciones')->middleware(['auth']);

require __DIR__.'/auth.php';
