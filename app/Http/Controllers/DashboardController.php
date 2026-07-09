<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $transactions = $user
            ->payments()
            ->with('subscription')
            ->latest()
            ->take(5)
            ->get();

        $subscriptions = $user
            ->subscriptions()
            ->where('status','active')
            ->get();

        $upcomingPayments = $subscriptions
        ->map(function ($subscription) {
            return [
                'subscription' => $subscription,
                'next_payment' => $subscription->getNextPaymentDate(),
            ];
        })
        ->sortBy('next_payment')
        ->take(5)
        ->values();

        $monthlyChart = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun' , 'Jul'],
            'values' => ['45.00', '20.86', '67.56', '5.56', '27.56', '55.34', '175.31']
        ];

        $yearlyChart = [
            'labels' => ['2024', '2025', '2026'],
            'values' => ['45.00', '20.86', '67.56']
        ];


        return view('dashboard', [
            'monthlyChart' => $monthlyChart,
            'yearlyChart' => $yearlyChart,
            'transactions' => $transactions,
            'upcomingPayments' => $upcomingPayments,
        ]);

    }
}
