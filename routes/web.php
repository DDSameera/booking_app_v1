<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{
    RoomController, BookingController, DashboardController
};


//
//Route::get('/', function () {
//    return Inertia::render('Welcome');
//})->name('home');
//
//Route::get('dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//

Route::get('/', [RoomController::class, 'search'])->name('rooms.search');
Route::get('/rooms', [RoomController::class, 'list'])->name('rooms.list');

Route::post('/booking/contact', [BookingController::class, 'contact'])->name('booking.contact');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/{reference}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

// booking flow
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
