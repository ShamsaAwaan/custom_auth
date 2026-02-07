<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\User;

// ----------------------
// Public Routes
// ----------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes (Guest Only)
Route::middleware('guest')->group(function () {

    // Register
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');

    // Forgot Password
    Route::get('/forgot', [AuthController::class, 'forgot'])->name('forgot');
    Route::post('/forgot', [AuthController::class, 'sendResetLink'])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [AuthController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// ----------------------
// Email Verification
// ----------------------
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware('signed')
    ->name('verification.verify');

// ----------------------
// Protected Routes (Auth Only)
// ----------------------
Route::middleware('auth')->group(function () {

    // User Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Category CRUD (prefix + group)
    Route::prefix('category')->group(function () {

        Route::get('/', [CategoryController::class, 'index'])->name('category.index');

        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');

        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    });
});


    // Sub Category CRUD
   Route::prefix('product')->middleware('auth')->group(function(){

    Route::get('/{subCategory}',[ProductController::class,'index'])
        ->name('product.index');

    Route::post('/store',[ProductController::class,'store'])
        ->name('product.store');

    Route::get('/edit/{id}',[ProductController::class,'edit'])
        ->name('product.edit');

    Route::post('/update/{id}',[ProductController::class,'update'])
        ->name('product.update');

    Route::delete('/delete/{id}',[ProductController::class,'destroy'])
        ->name('product.delete');
});
use App\Http\Controllers\SubCategoryController;

Route::get('/get-subcategories/{id}',[SubCategoryController::class,'byCategory']);

