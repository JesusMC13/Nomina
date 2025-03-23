<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DiaDescansoController;



Route::get('/', function () {
    return view('home'); // Redirige a home.blade.php
})->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirige a la vista "login"
})->name('logout');



Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');



Route::get('/login', [SessionsController::class, 'create'])
    ->middleware('guest')
    ->name('login.index');

Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');


Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin.index');

    Route::middleware('auth')->group(function () {
        // Ruta principal del dashboard del empleado
        Route::get('/empleado/dashboard', function () {
            return view('user_dashboard');
        })->name('empleado.dashboard');
    });
    
    Route::middleware(['auth', 'auth.admin'])->prefix('adminn')->name('adminn.')->group(function () {
        Route::resource('dias_descanso', DiaDescansoController::class);
    });
    
    
    
    
