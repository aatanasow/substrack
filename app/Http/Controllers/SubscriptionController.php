<?php

namespace App\Http\Controllers;

use App\Enums\SubscriptionFrequency;
use App\Enums\SubscriptionStatus;
use App\Http\Filters\SubscriptionFilter;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Notifications\SubscriptionCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, SubscriptionFilter $filter)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'status' => ['nullable', Rule::enum(SubscriptionStatus::class)],
            'frequency' => ['nullable', Rule::enum(SubscriptionFrequency::class)],
            'min_price' => ['nullable', 'numeric'],
            'max_price' => ['nullable', 'numeric'],
            'sort' => ['nullable', 'in:frequency,status,price,id,start_date'],
            'direction' => ['nullable', 'in:asc,desc'],
        ]);

        // $status = $request->st;
        // // validate the query /simple/
        // if (! in_array($status, SubscriptionStatus::values())) {
        //     $status = null;
        // }

        $subscriptions = $filter
            ->apply($user->subscriptions(), $validated)
            // ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->paginate(5)
            ->withQueryString();

        return view('subscription.index', [
            'subscriptions' => $subscriptions,
            'statusCount' => Subscription::statusCount($user),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        // dd($request->validated());

        $data = $request->safe()->except(['image_path']);

        if ($request->image_path) {
            $data['image_path'] = $request->image_path->store('subscriptions', 'public');
        }

        DB::transaction(function () use ($data) {
            $subscription = Auth::user()->subscriptions()->create($data);

            // add the first payment - need more detailed logic and confirmation from user
            if ($subscription->start_date->isBefore(today())) {
                $subscription->payments()->create([
                    'payment_date' => $subscription->start_date,
                    'price' => $data['price'],
                    'confirmed' => false,
                ]);
            }

            // notify the user
            Auth::user()->notify(new SubscriptionCreated($subscription));
        });

        return to_route('subscription.index')->with('success', 'Subscription created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        Gate::authorize('workWith', $subscription);

        return view('subscription.show', [
            'subscription' => $subscription,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        Gate::authorize('workWith', $subscription);

        return view('subscription.edit', [
            'subscription' => $subscription,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        // dd($request->all());
        Gate::authorize('workWith', $subscription);

        $data = $request->safe()->except(['image_path']);

        if ($request->image_path ?? false) {
            if ($subscription->image_path ?? false) {
                Storage::disk('public')->delete($subscription->image_path);
            }
            $data['image_path'] = $request->image_path->store('subscriptions', 'public');
        }

        $subscription->update($data);
        // DB::transaction(function () use ($request, $data, $subscription) {
        // });

        return to_route('subscription.index')->with('success', 'Subscription updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        Gate::authorize('workWith', $subscription);

        if ($subscription->image_path ?? false) {
            Storage::disk('public')->delete($subscription->image_path);
        }

        Auth::user()->notifications()->where('data->subscription_id', $subscription->id)->delete();

        $subscription->delete();

        return to_route('subscription.index')->with('success', 'Subscription deleted');
    }
}
