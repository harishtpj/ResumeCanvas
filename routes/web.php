<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'name' => request('name', 'World')
    ]);
})->name('index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
