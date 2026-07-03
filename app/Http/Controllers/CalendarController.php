<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events()
    {
        $user = Auth::user();

        $events = [];

        // Past payments

        foreach ($user->subscriptions as $subscription) {

            foreach ($subscription->payments as $payment) {

                if ($payment->confirmed) {

                }

                $events[] = [
                    'title' => $subscription->title.' payment',
                    'start' => $payment->payment_date->toDateString(),
                    'color' => $payment->confirmed ? '#4CAF50' : '#AAAAAA',
                    'extendedProps' => [
                        'price' => $payment->price,
                        'id' => $subscription->id,
                        'type' => 'payment',
                    ],
                ];
            }
        }

        // Future renewals

        foreach ($user->subscriptions as $subscription) {

            if ($subscription->status->value !== 'active') {
                continue;
            }

            $events[] = [
                'title' => $subscription->title.' renewal',
                'start' => $subscription->getNextPaymentDate()->toDateString(),
                'color' => '#F57C00',
                'extendedProps' => [
                    'price' => $subscription->price,
                    'id' => $subscription->id,
                    'type' => 'renewal',
                ],
            ];
        }

        return response()->json($events);
    }
}
