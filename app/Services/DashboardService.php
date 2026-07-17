<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function upcomingPayments(User $user)
    {
        $subscriptions = $user
            ->subscriptions()
            ->where('status', 'active')
            ->get();

        return $subscriptions
            ->map(function ($subscription) {
                return [
                    'subscription' => $subscription,
                    'next_payment' => $subscription->getNextPaymentDate(),
                ];
            })
            ->sortBy('next_payment')
            ->take(5)
            ->values();
    }

    public function recentTransactions(User $user)
    {
        return $user
            ->payments()
            ->with('subscription')
            ->latest()
            ->take(5)
            ->get();
    }

    public function monthlySpending(User $user, $period = 12)
    {
        $period = $period - 1;
        $payments = DB::table('subscriptions_payments')
            ->join(
                'subscriptions',
                'subscriptions.id',
                '=',
                'subscriptions_payments.subscription_id'
            )
            ->select(
                DB::raw("DATE_FORMAT(payment_date, '%Y-%m') as month"),
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->where('user_id', $user->id)
            ->where('subscriptions_payments.confirmed', true)
            ->where('subscriptions_payments.payment_date', '>=', now()->subMonths($period)->startOfMonth())
            ->groupBy('month', 'currency')
            ->orderBy('month')
            ->get();

        $months = collect();

        for ($i = $period; $i >= 0; $i--) {
            $date = now()->subMonths($i);

            $months->push([
                'key' => $date->format('Y-m'),
                'label' => $date->format('M'),
            ]);
        }

        $currencies = $payments
            ->pluck('currency')
            ->unique()
            ->values();

        $datasets = [];

        foreach ($currencies as $currency) {

            $data = [];

            foreach ($months as $month) {
                $payment = $payments
                    ->where('month', $month['key'])
                    ->where('currency', $currency)
                    ->first();

                $data[] = $payment ? (float) $payment->total : 0;
            }

            $datasets[] = [
                'label' => $currency,
                'data' => $data,
            ];
        }

        $labels = $months->pluck('label');

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

    }

    public function yearlyBreakdown(User $user, $period = 2, $currency = 'USD')
    {
        $period = $period - 1;

        $payments = DB::table('subscriptions_payments')
            ->join(
                'subscriptions',
                'subscriptions.id',
                '=',
                'subscriptions_payments.subscription_id'
            )
            ->select(
                DB::raw("DATE_FORMAT(payment_date, '%Y') as year"),
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->where('user_id', $user->id)
            ->where('subscriptions_payments.confirmed', true)
            ->where('subscriptions_payments.payment_date', '>=', now()->subYears($period)->startOfYear())
            ->groupBy('year', 'currency')
            ->orderBy('year')
            ->get();

        $years = collect();

        for ($i = $period; $i >= 0; $i--) {
            $date = now()->subYears($i);

            $years->push([
                'key' => $date->format('Y'),
                'label' => $date->format('Y'),
            ]);
        }

        $currencies = $payments
            ->pluck('currency')
            ->unique()
            ->values();
        $datasets = [];

        $data = [];

        foreach ($years as $year) {
            $payment = $payments
                ->where('year', $year['key'])
                ->where('currency', $currency)
                ->first();

            $data[] = $payment ? (float) $payment->total : 0;
        }

        $datasets[] = [
            'label' => $currency,
            'data' => $data,
        ];

        $labels = $years->pluck('label');

        return [
            'labels' => $labels,
            'datasets' => $datasets,
            'currencies' => $currencies,
        ];

    }

    public function spendingOverview(User $user, $currency = 'USD')
    {

        $this_month = DB::table('subscriptions_payments')
            ->join(
                'subscriptions',
                'subscriptions.id',
                '=',
                'subscriptions_payments.subscription_id'
            )
            ->select(
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->where('user_id', $user->id)
            ->where('subscriptions_payments.confirmed', true)
            ->where('subscriptions_payments.payment_date', '>=', now()->startOfMonth())
            ->groupBy('currency')
            ->get();

        $this_year = DB::table('subscriptions_payments')
            ->join(
                'subscriptions',
                'subscriptions.id',
                '=',
                'subscriptions_payments.subscription_id'
            )
            ->select(
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->where('user_id', $user->id)
            ->where('subscriptions_payments.confirmed', true)
            ->where('subscriptions_payments.payment_date', '>=', now()->startOfYear())
            ->groupBy('currency')
            ->get();

        $lifetime = DB::table('subscriptions_payments')
            ->join(
                'subscriptions',
                'subscriptions.id',
                '=',
                'subscriptions_payments.subscription_id'
            )
            ->select(
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->where('user_id', $user->id)
            ->where('subscriptions_payments.confirmed', true)
            ->groupBy('currency')
            ->get();

        $data = [];
        $periods = ['lifetime', 'this_year', 'this_month'];

        foreach ($periods as $period) {
            $number = $$period
                ->where('currency', $currency)
                ->first();

            $data[$period] = $number ? (float) $number->total : 0;
        }

        return $data;

    }
}
