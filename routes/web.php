<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Usar los métodos del controlador en las rutas
    Route::resource('libros', LibroController::class);
});

// Ruta para consultar la información de un libro
Route::get('libro/{id}/edit', [
    LibroController::class,
    'edit'
])->name('libros.edit');

// Ruta para actualizar la información
Route::put('libro/{id}', [
    LibroController::class,
    'update'
])->name('/libros.update');

// Ruta para regresar la vista del formulario de registro
Route::get('/registro', [
    AuthController::class,
    'registerForm'
])->name('registro');

// Ruta para registrar usuarios
Route::post('/registro', [
    AuthController::class,
    'register'
])->name('registro.store');

// Ruta para regresar vista de inicio de sesión
Route::get('/acceso', [
    AuthController::class,
    'loginForm'
])->name('acceso');

//ruta para iniciar sesión
Route::post('/acceso', [
    AuthController::class,
    'login'
])->name('acceso.store');


//Ruta para cerrar sesión
Route::post('/cerrar', [
    AuthController::class,
    'logout'
])->name('cerrar');

Route::middleware(['solo.auth'])->group(function () {
    Route::resource('libros', LibroController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [
        AuthController::class,
        'adminDashboard'
    ])->name('admin-dashboard');
});
