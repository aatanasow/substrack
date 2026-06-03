<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {return view('welcome');})->name('landing');
Route::view('/', 'welcome')->name('landing');
Route::view('/help', 'help')->name('help');

Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index')->middleware('auth');
Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscription.show')->middleware('auth');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
