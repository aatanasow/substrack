<?php

namespace App\Policies;

use App\Models\Subscription;
use App\Models\User;

class SubscriptionPolicy
{
    public function workWith(User $user, Subscription $subscription): bool
    {
        return $subscription->user->is($user);
    }
}
