<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events(Request $request)
    {
        $user = Auth::user();

        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $payments = $user
            ->payments()
            ->whereBetween('payment_date', [
                $start->toDateString(),
                $end->toDateString(),
            ])
            ->with('subscription')
            ->get();

        $events = [];

        // Past payments
        foreach ($payments as $payment) {

            $events[] = [
                'title' => $payment->subscription->title.' payment',
                'start' => $payment->payment_date->toDateString(),
                'color' => $payment->confirmed ? '#4CAF50' : '#AAAAAA',
                'extendedProps' => [
                    'price' => $payment->price,
                    'id' => $payment->subscription->id,
                    'type' => 'payment',
                ],
            ];
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
