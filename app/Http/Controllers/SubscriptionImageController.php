<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SubscriptionImageController extends Controller
{
    public function destroy(Subscription $subscription)
    {
        Gate::authorize('workWith', $subscription);

        Storage::disk('public')->delete($subscription->image_path);

        $subscription->update(['image_path' => null]);

        return back();
    }
}
