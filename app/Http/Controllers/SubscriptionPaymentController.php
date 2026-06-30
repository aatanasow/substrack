<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SubscriptionPaymentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $transactions = $user
            ->payments()
            ->with('subscription')
            ->latest()
            ->get();

        return view('transaction.index', [
            'transactions' => $transactions,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        $subscriptions = $user
            ->subscriptions()
            ->latest()
            ->get();

        $subsList = collect($subscriptions)
            ->mapWithKeys(fn ($option) => [
                $option->id => $option->title,
            ])->toArray();

        return view('transaction.create', [
            'subsList' => $subsList,
        ]);
    }

    public function store(Request $request)
    {

        // $data = $request->safe();
        $validated = $request->validate([
            'subscription_id' => ['required'],
            'payment_date' => ['required', 'date'],
            'price' => ['required', 'decimal:0,2'],
        ]);
        // dd($validated['subscription_id']);

        $subscription = Auth::user()->subscriptions()->where('id', $validated['subscription_id'])->first();
        // dd($subscription);

        $subscription->payments()->firstOrCreate(
            ['payment_date' => $validated['payment_date']],
            ['price' => $validated['price'], 'confirmed' => false]
        );

        return to_route('transaction.index')->with('success', 'Transaction created');
    }

    public function edit(SubscriptionPayment $transaction)
    {
        Gate::authorize('workWith', $transaction);

        return view('transaction.edit', [
            'transaction' => $transaction,
        ]);
    }

    public function update(Request $request, SubscriptionPayment $transaction)
    {
        Gate::authorize('workWith', $transaction);

        // dd($transaction->price);

        $validated = $request->validate([
            'payment_date' => ['required', 'date'],
            'price' => ['required', 'decimal:0,2'],
        ]);
        // dd($validated);

        $transaction->update([
            'payment_date' => $validated['payment_date'],
            'price' => $validated['price'],
            'confirmed' => true,
        ]);

        return to_route('transaction.index')->with('success', 'Transaction created');
    }

    public function confirm(SubscriptionPayment $transaction)
    {
        Gate::authorize('workWith', $transaction);

        $transaction->update(['confirmed' => true]);

        return redirect()->back()->with('success', 'Transaction confirmed');

    }

    public function destroy(SubscriptionPayment $transaction)
    {
        Gate::authorize('workWith', $transaction);

        $transaction->delete();

        return to_route('transaction.index')->with('success', 'Transaction deleted');
    }
}
