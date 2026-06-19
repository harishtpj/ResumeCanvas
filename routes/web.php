<?php

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $portfolios = Auth::user()->portfolios();

        return Inertia::render('Portfolio/Dashboard', [
            'totalPortfolios' => $portfolios->count(),
            'portfolios' => $portfolios->latest()->limit(5)->get(),
        ]);
    })->name('dashboard');

    Route::resource('portfolio', PortfolioController::class)->except(['edit']);
    Route::delete('logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, "create"])->name('login');
    Route::post('/login', [SessionController::class, "store"]);

    Route::get('/register', [RegistrationController::class, "create"])->name('register');
    Route::post('/register', [RegistrationController::class, "store"]);
});

Route::get('/', function () {
    return Inertia::render('Home');
})->name('index');
