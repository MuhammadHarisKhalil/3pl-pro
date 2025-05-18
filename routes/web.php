<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController; // Ensure this matches the actual namespace of ContactController

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/price', [HomeController::class, 'price'])->name('price');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [ContactController::class, 'index'])->name('contact'); // Ensure the namespace is correct
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Add these routes to your web.php file

// Admin Authentication Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    });
    
    // Protected routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        
        // Contact management routes
        Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class);
    });
});