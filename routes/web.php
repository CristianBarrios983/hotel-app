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


Route::get('/usuarios', function () {
    return view('usuarios'); // Asegúrate de que esto apunte a tu vista
})->name('usuarios')->middleware(['auth']);
    
Route::get('/pisos', function () {
    return view('pisos'); // Asegúrate de que esto apunte a tu vista
})->name('pisos')->middleware(['auth']);
    
Route::get('/tipo_habitaciones', function () {
    return view('tipo_habitaciones'); 
})->name('usuarios')->middleware(['auth']);

Route::get('/productos', function () {
    return view('productos'); 
})->name('productos')->middleware(['auth']);

Route::get('/categorias', function () {
    return view('categorias'); 
})->name('categorias')->middleware(['auth']);

require __DIR__.'/auth.php';
