<?php

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::delete('logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::get('/', function () {
    return Inertia::render('Home', [
        'name' => request('name', 'World')
    ]);
})->name('index');

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::get('/register', [RegistrationController::class, "create"])->name('register');
Route::post('/register', [RegistrationController::class, "store"]);
