<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\User;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
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



    // User Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');


// Category CRUD
Route::resource('categories', CategoryController::class);

// SubCategory CRUD
Route::resource('sub_category', SubCategoryController::class);

// Product CRUD
Route::resource('products', ProductController::class);

// AJAX route to get subcategories dynamically
Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubCategories']);
Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubCategories'])->name('get.subcategories');
