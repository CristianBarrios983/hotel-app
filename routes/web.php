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

Route::get('/productos', function () {
    return view('productos'); 
})->name('productos')->middleware(['auth']);

Route::get('/proveedores', function () {
    return view('proveedores'); 
})->name('proveedores')->middleware(['auth']);

Route::get('/categorias', function () {
    return view('categorias'); 
})->name('categorias')->middleware(['auth']);

Route::get('/servicios', function () {
    return view('servicios'); 
})->name('servicios')->middleware(['auth']);

Route::get('/recepcion', function () {
    return view('recepcion'); 
})->name('recepcion')->middleware(['auth']);

Route::get('/reservas', function () {
    return view('reservas'); 
})->name('reservas')->middleware(['auth']);

Route::get('/check-in', function () {
    return view('check-in'); 
})->name('check-in')->middleware(['auth']);

Route::get('/check-out', function () {
    return view('check-out'); 
})->name('check-out')->middleware(['auth']);

Route::get('/crear-reserva', function () {
    return view('crear-reserva'); 
})->name('crear-reserva')->middleware(['auth']);

require __DIR__.'/auth.php';
