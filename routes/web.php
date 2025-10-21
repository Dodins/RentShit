<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// AUTHENTICATION

Route::get('/', function () {
    return Inertia::render('Login');
})->name('loginpage');

Route::get('/register', function () {
    return Inertia::render('Register');
})->name('registerpage');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// DASHBOARD

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
