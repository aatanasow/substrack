<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\SubscriptionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
    public function store(SubscriptionRequest $request)
    {
        // dd($request->all());

        $data = collect($request->safe()->all())->only([
            'title', 'description', 'start_date', 'price', 'currency', 'status', 'frequency', 'notify', 'link',
        ])->toArray();

        DB::transaction(function () use ($request, $data) {
            if ($request->image_path ?? false) {
                $data['image_path'] = $request->image_path->store('subscriptions', 'public');
            }

            // Auth::user()->subscriptions()->create($request->validated());
            // Auth::user()->subscriptions()->create($request->safe()->except('image_path'));
            Auth::user()->subscriptions()->create($data);
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

        $data = collect($request->safe()->all())->only([
            'title', 'description', 'start_date', 'price', 'currency', 'status', 'frequency', 'notify', 'link',
        ])->toArray();

        DB::transaction(function () use ($request, $data, $subscription) {
            if ($request->image_path ?? false) {
                if ($subscription->image_path ?? false) {
                    Storage::disk('public')->delete($subscription->image_path);
                }
                $data['image_path'] = $request->image_path->store('subscriptions', 'public');
            }

            $subscription->update($data);
        });

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

        $subscription->delete();

        return to_route('subscription.index');
    }
}
