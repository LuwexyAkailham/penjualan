<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('users.login'); // Mengarah ke halaman login
});
Route::get('/login', [UserController::class, 'showLogin'])->name('users.login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'register'])->name('users.register');
Route::post('/register', [UserController::class, 'store'])->name('users.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/settings', [UserController::class, 'settings'])->name('users.settings');
Route::post('/settings', [UserController::class, 'updateSettings'])->name('users.updateSettings');


Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/buy/{product}', [ProductController::class, 'buy'])->name('buy');
    // Route for the 'Buy' button that leads to the payment page
    Route::get('/buy/{product}', [ProductController::class, 'showPaymentPage'])->name('buy');
// Route to process payment and remove the product
    Route::post('/pay/{product}', [ProductController::class, 'processPayment'])->name('pay');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});Route::resource('products', ProductController::class);

Route::get('/categories/{id}', [CategoryController::class, 'showCategory'])->name('categories.show');
// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
