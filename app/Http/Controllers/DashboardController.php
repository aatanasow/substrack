<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Enums\SubscriptionCurrency;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index(Request $request, DashboardService $dashboard)
    {
        $user = Auth::user();

        // $validated = $request->validate([
        //     'currency' => ['nullable', Rule::enum(SubscriptionCurrency::class)],
        // ]);

        $currency = $request->currency;
        // validate the query /simple/
        if (! in_array(strtolower($currency), SubscriptionCurrency::values())) {
            $currency = 'USD';
        }

        return view('dashboard', [
            'monthlySpending' => $dashboard->monthlySpending($user),
            'yearlyBreakdown' => $dashboard->yearlyBreakdown($user, 2, $currency),
            'spendingOverview' => $dashboard->spendingOverview($user, $currency),
            'recentTransactions' => $dashboard->recentTransactions($user),
            'upcomingPayments' => $dashboard->upcomingPayments($user),
        ]);

    }
}
