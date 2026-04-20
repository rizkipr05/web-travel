<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;

Route::get('/', [PublicController::class, 'index']);
Route::get('/search', [SearchController::class, 'index']);
Route::get('/tour', [PublicController::class, 'tour']);
Route::get('/about', [PublicController::class, 'about']);
Route::get('/help', [PublicController::class, 'help']);
Route::get('/tour/{id}', [PublicController::class, 'tourDetail']);

// Booking Flow
Route::get('/booking/{id}', [BookingController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::post('/booking', [BookingController::class, 'store']);
    Route::get('/payment/{id}', [BookingController::class, 'payment']);
    Route::get('/ticket/{id}', [BookingController::class, 'ticket']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);
    Route::get('/profile', [BookingController::class, 'profile']);
    Route::post('/profile/update', [BookingController::class, 'updateProfile']);
});

// Auth Routes
Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::get('/register', [\App\Http\Controllers\Auth\AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');

// Admin Auth Routes
Route::get('/admin/login', [\App\Http\Controllers\Auth\AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Auth\AuthController::class, 'adminLogin']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'dashboard']);
    
    // Tours
    Route::get('/tours', [\App\Http\Controllers\Admin\AdminController::class, 'manageTours']);
    Route::post('/tours', [\App\Http\Controllers\Admin\AdminController::class, 'storeTour']);
    Route::put('/tours/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'updateTour']);
    Route::delete('/tours/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteTour']);
    
    // Bookings
    Route::get('/bookings', [\App\Http\Controllers\Admin\AdminController::class, 'manageBookings']);
    Route::put('/bookings/{id}/status', [\App\Http\Controllers\Admin\AdminController::class, 'updateBookingStatus']);
    Route::delete('/bookings/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteBooking']);
    
    // Schedules
    Route::get('/schedules', [\App\Http\Controllers\Admin\AdminController::class, 'manageSchedules']);
    Route::post('/schedules', [\App\Http\Controllers\Admin\AdminController::class, 'storeSchedule']);
    Route::put('/schedules/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'updateSchedule']);
    Route::delete('/schedules/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteSchedule']);
    
    Route::get('/offers', [\App\Http\Controllers\Admin\AdminController::class, 'manageOffers']);
    Route::get('/profile', [\App\Http\Controllers\Admin\AdminController::class, 'profile']);
});
