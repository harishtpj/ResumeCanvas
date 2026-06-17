<?php

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PortfolioController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PortfolioController::class, 'index'])->name('dashboard');
    Route::resource('portfolio', PortfolioController::class)
        ->except(['index', 'edit']);
    Route::delete('logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, "create"])->name('login');
    Route::post('/login', [SessionController::class, "store"]);

    Route::get('/register', [RegistrationController::class, "create"])->name('register');
    Route::post('/register', [RegistrationController::class, "store"]);
});

Route::get('/', function () {
    return Inertia::render('Home', [
        'name' => request('name', 'World')
    ]);
})->name('index');
