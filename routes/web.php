<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\OrganiserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('/user', UserController::class)->names([
    'index' => 'user.index',
    'create' => 'user.create',
    'store' => 'user.store',
    'show' => 'user.show',
    'edit' => 'user.edit',
    'update' => 'user.update',
    'destroy' => 'user.destroy',
]);

Route::get('/concerts/{id}', [UserController::class, 'showConcert'])->name('concerts.show');

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

Route::get('/order/ticket', [OrderController::class, 'ticket'])->name('my.tickets');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/dashboard', AdminController::class)->names([
        'index' => 'admin.dashboard.index',
        'create' => 'admin.dashboard.create',
        'store' => 'admin.dashboard.store',
        'show' => 'admin.dashboard.show',
        'edit' => 'admin.dashboard.edit',
        'update' => 'admin.dashboard.update',
        'destroy' => 'admin.dashboard.destroy',
    ]);

    Route::resource('/concerts', ConcertController::class)->names([
        'index' => 'concerts.index',
        'create' => 'concerts.create',
        'store' => 'concerts.store',
        'show' => 'concerts.show',
        'edit' => 'concerts.edit',
        'update' => 'concerts.update',
        'destroy' => 'concerts.destroy',
    ]);

    Route::resource('/organisers', OrganiserController::class)->names([
        'index' => 'organisers.index',
        'create' => 'organisers.create',
        'store' => 'organisers.store',
        'show' => 'organisers.show',
        'edit' => 'organisers.edit',
        'update' => 'organisers.update',
        'destroy' => 'organisers.destroy',
    ]);
    
    Route::resource('/venues', VenueController::class)->names([
        'index' => 'venues.index',
        'create' => 'venues.create',
        'store' => 'venues.store',
        'show' => 'venues.show',
        'edit' => 'venues.edit',
        'update' => 'venues.update',
        'destroy' => 'venues.destroy',
    ]);
    
    Route::resource('/seats', SeatController::class)->names([
        'index' => 'seats.index',
        'create' => 'seats.create',
        'store' => 'seats.store',
        'show' => 'seats.show',
        'edit' => 'seats.edit',
        'update' => 'seats.update',
        'destroy' => 'seats.destroy',
    ]);
});



// might need to convert all this to Route::resource

