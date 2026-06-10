<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionImageController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/help', 'help')->name('help');
Route::view('/contact', 'contact')->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscription.show');
    Route::get('/subscriptions/{subscription}/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::patch('/subscriptions/{subscription}', [SubscriptionController::class, 'update'])->name('subscription.update');
    Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');


    Route::delete('/ideas/{subscription}/image', [SubscriptionImageController::class, 'destroy'])->name('subscription.image.destroy');
});

// Route::middleware(['guest'])->group(function () {

// });

