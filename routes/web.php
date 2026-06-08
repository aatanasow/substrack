<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionImageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {return view('welcome');})->name('landing');
Route::view('/', 'welcome')->name('landing');
Route::view('/help', 'help')->name('help');
Route::view('/contact', 'contact')->name('contact');

Route::middleware(['auth'])->group(function () {
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscription.show');
    Route::get('/subscriptions/{subscription}/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::patch('/subscriptions/{subscription}', [SubscriptionController::class, 'update'])->name('subscription.update');
    Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');

    Route::post('/logout', [SessionsController::class, 'destroy']);

    Route::delete('/ideas/{subscription}/image', [SubscriptionImageController::class, 'destroy'])->name('subscription.image.destroy');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});
