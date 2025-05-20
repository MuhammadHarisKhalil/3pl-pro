<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/price', [HomeController::class, 'price'])->name('price');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    // Guest routes
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    
    // Protected routes
    Route::middleware(['auth', 'admin'])
        ->as('admin.')
        ->group(function () {
            Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
            Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
            
            // Contact management routes
            Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class);
            
            // Site Info routes
            Route::get('/site-info', [App\Http\Controllers\Admin\SiteInfoController::class, 'edit'])->name('site-info.edit');
            Route::put('/site-info', [App\Http\Controllers\Admin\SiteInfoController::class, 'update'])->name('site-info.update');
            
            // Pricing Management
            Route::resource('pricing', App\Http\Controllers\Admin\PricingController::class);
        });
});

// Add a regular logout route if needed
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');