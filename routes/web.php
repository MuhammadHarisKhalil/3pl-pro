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

// Service Detail Route
Route::get('/services/{service}', [App\Http\Controllers\HomeController::class, 'serviceDetail'])->name('services.detail');

// Add to your web.php file outside of any groups
Route::post('/quote', [App\Http\Controllers\QuoteController::class, 'store'])->name('quote.store');

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
            
            // Testimonial Management
            Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
            
            // Service Management
            Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
            
            // User Management
            Route::resource('users', App\Http\Controllers\Admin\UserController::class);
            
            // Quote Management
            Route::get('quotes', [App\Http\Controllers\Admin\QuoteController::class, 'index'])->name('quotes.index');
            Route::get('quotes/{quote}', [App\Http\Controllers\Admin\QuoteController::class, 'show'])->name('quotes.show');
            Route::patch('quotes/{quote}/status', [App\Http\Controllers\Admin\QuoteController::class, 'updateStatus'])->name('quotes.update-status');
            Route::delete('quotes/{quote}', [App\Http\Controllers\Admin\QuoteController::class, 'destroy'])->name('quotes.destroy');
        });
});

// Add a regular logout route if needed
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');