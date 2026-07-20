<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Query\Builder;
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

    private function paymentQuery(User $user)
    {
        return DB::table('subscriptions_payments')
            ->join(
                'subscriptions',
                'subscriptions.id',
                '=',
                'subscriptions_payments.subscription_id'
            )
            ->where('user_id', $user->id)
            ->where('subscriptions_payments.confirmed', true);
    }

    private function applyDateRange(Builder $query, string $unit, int $period)
    {
        $start = match ($unit) {
            'month' => now()->subMonths($period)->startOfMonth(),
            'year' => now()->subYears($period)->startOfYear(),
            default => now(),
        };

        return $query->where('subscriptions_payments.payment_date', '>=', $start);
    }

    private function buildPeriodLabels(int $period, string $unit)
    {
        $period = max(0, $period - 1);
        $periods = collect();

        for ($i = $period; $i >= 0; $i--) {
            $date = match ($unit) {
                'month' => now()->subMonths($i),
                'year' => now()->subYears($i),
                default => now()->subYears($i),
            };

            $periods->push([
                'key' => $unit === 'month' ? $date->format('Y-m') : $date->format('Y'),
                'label' => $date->format($unit === 'month' ? 'M' : 'Y'),
            ]);
        }

        return $periods;
    }

    public function monthlySpending(User $user, $period = 12)
    {
        $period = max(0, $period - 1);
        $payments = $this->paymentQuery($user)
            ->select(
                DB::raw("DATE_FORMAT(payment_date, '%Y-%m') as month"),
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->when($period >= 0, function ($query) use ($period) {
                return $this->applyDateRange($query, 'month', $period);
            })
            ->groupBy('month', 'currency')
            ->orderBy('month')
            ->get();

        $months = $this->buildPeriodLabels($period + 1, 'month');

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
        $period = max(0, $period - 1);

        $payments = $this->paymentQuery($user)
            ->select(
                DB::raw("DATE_FORMAT(payment_date, '%Y') as year"),
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->when($period >= 0, function ($query) use ($period) {
                return $this->applyDateRange($query, 'year', $period);
            })
            ->groupBy('year', 'currency')
            ->orderBy('year')
            ->get();

        $years = $this->buildPeriodLabels($period + 1, 'year');

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

        $datasets = [
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

        $this_month = $this->paymentQuery($user)
            ->select(
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->where('subscriptions_payments.payment_date', '>=', now()->startOfMonth())
            ->groupBy('currency')
            ->get();

        $this_year = $this->paymentQuery($user)
            ->select(
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
            ->where('subscriptions_payments.payment_date', '>=', now()->startOfYear())
            ->groupBy('currency')
            ->get();

        $lifetime = $this->paymentQuery($user)
            ->select(
                DB::raw('upper(subscriptions.currency) as currency'),
                DB::raw('SUM(subscriptions_payments.price) as total')
            )
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
