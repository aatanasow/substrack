<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\SubscriptionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->st;

        // validate the query /simple/
        if (! in_array($status, SubscriptionStatus::values())) {
            $status = null;
        }

        $subscriptions = $user
            ->subscriptions()
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->get();

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
    public function store(StoreSubscriptionRequest $request)
    {
        // dd($request->all());

        $subscription = Auth::user()->subscriptions()->create($request->validated());
        // $subscription = Auth::user()->subscriptions()->create($request->safe()->all());

        // $action->handle($request->safe()->all());

        if($request->image_path) {
            $imagePath = $request->image_path->store('subscriptions', 'public');

            $subscription->update([
                'image_path' => $imagePath
            ]);
        }


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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        Gate::authorize('workWith', $subscription);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        Gate::authorize('workWith', $subscription);

        $subscription->delete();

        return to_route('subscription.index');
    }
}
