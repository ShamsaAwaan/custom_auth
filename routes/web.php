<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('dashboard');
})->name('home');


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/forgot', [AuthController::class, 'forgot'])->name('forgot');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
