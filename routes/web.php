<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionImageController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Http\Controllers\UserImageController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/help', 'help')->name('help');
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact');
Route::post('/contact', [ContactUsController::class, 'send'])->name('contact.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::get('/calendar/events', [CalendarController::class, 'events']);

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscription.show');
    Route::get('/subscriptions/{subscription}/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
    Route::patch('/subscriptions/{subscription}', [SubscriptionController::class, 'update'])->name('subscription.update');
    Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');

    Route::delete('/subscriptions/{subscription}/image', [SubscriptionImageController::class, 'destroy'])->name('subscription.image.destroy');

    Route::patch('/profile/image', [UserImageController::class, 'update'])->name('user.image.update');
    Route::delete('/profile/image', [UserImageController::class, 'destroy'])->name('user.image.destroy');

    Route::patch('/notification/{notification}/mark', [NotificationController::class, 'update'])->name('notification.update');
    Route::delete('/notifications/mark', [NotificationController::class, 'destroy'])->name('notification.destroy');

    Route::get('/transactions', [SubscriptionPaymentController::class, 'index'])->name('transaction.index');
    Route::get('/transactions/create', [SubscriptionPaymentController::class, 'create'])->name('transaction.create');
    Route::post('/transactions', [SubscriptionPaymentController::class, 'store'])->name('transaction.store');
    Route::get('/transactions/{transaction}/edit', [SubscriptionPaymentController::class, 'edit'])->name('transaction.edit');
    Route::put('/transactions/{transaction}', [SubscriptionPaymentController::class, 'confirm'])->name('transaction.confirm');
    Route::patch('/transactions/{transaction}', [SubscriptionPaymentController::class, 'update'])->name('transaction.update');
    Route::delete('/transactions/{transaction}', [SubscriptionPaymentController::class, 'destroy'])->name('transaction.destroy');

});

Route::middleware(['guest'])->group(function () {
    Route::get('/two-factor-challenge-recovery', function () {
        return view('auth.two-factor-challenge-recovery');
    })->name('auth.challenge-recovery');
});

if (app()->environment('production')) {
    Route::fallback(function () {
        abort(404);
    });
}
