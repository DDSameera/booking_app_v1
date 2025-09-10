<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    RoomController, BookingController, DashboardController
};


Route::get('/', [RoomController::class, 'search'])->name('rooms.search');
Route::get('/rooms', [RoomController::class, 'list'])->name('rooms.list');

Route::post('/booking/contact', [BookingController::class, 'contact'])->name('booking.contact');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
