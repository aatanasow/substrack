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

Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index')->middleware('auth');
Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscription.create')->middleware('auth');
Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscription.store')->middleware('auth');
Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscription.show')->middleware('auth');
Route::get('/subscriptions/{subscription}/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit')->middleware('auth');
Route::patch('/subscriptions/{subscription}', [SubscriptionController::class, 'update'])->name('subscription.update')->middleware('auth');
Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy')->middleware('auth');

Route::delete('/ideas/{subscription}/image', [SubscriptionImageController::class, 'destroy'])->name('subscription.image.destroy')->middleware('auth');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
