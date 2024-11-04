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

Route::get('/usuarios', function () {
    return view('usuarios'); 
})->name('usuarios')->middleware(['auth']);
    
Route::get('/pisos', function () {
    return view('pisos');
})->name('pisos')->middleware(['auth']);
    
Route::get('/tipo_habitaciones', function () {
    return view('tipo_habitaciones'); 
})->name('tipo_habitaciones')->middleware(['auth']);

Route::get('/huespedes', function () {
    return view('huespedes'); 
})->name('huespedes')->middleware(['auth']);

Route::get('/categorias', function () {
    return view('categorias'); 
})->name('categorias')->middleware(['auth']);

require __DIR__.'/auth.php';
