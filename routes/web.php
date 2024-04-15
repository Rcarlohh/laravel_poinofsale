<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VenVentaController;
use App\Http\Controllers\InicioController;

// Rutas de inicio de sesión y registro
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
    Route::get('/inicio', [InicioController::class, 'index'])->name('inicio.index');
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::resource('productos', ProductoController::class);
    Route::resource('ventas', VenVentaController::class);
    Route::get('/ventas', [VenVentaController::class, 'index'])->name('ventas.index');
    Route::post('/ventas/agregar-producto', [VenVentaController::class, 'agregarProducto'])->name('ventas.agregarProducto');
    Route::post('/ventas/finalizar', [VenVentaController::class, 'finalizar'])->name('ventas.finalizar');
    Route::post('/ventas/store', [VenVentaController::class, 'store'])->name('ventas.store');
    

    Route::get('/contactanos', function () {
        return view('contactanos');
    })->name('contactanos');

    Route::get('/print-product/{id}', [ProductoController::class, 'printProduct'])->name('print.product');

});



