<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function update(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notifications is marked as read');
    }

    public function destroy()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications are marked as read');
    }
}
