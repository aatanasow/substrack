<?php

namespace App\Policies;

use App\Models\SubscriptionPayment;
use App\Models\User;

class SubscriptionPaymentPolicy
{
    public function workWith(User $user, SubscriptionPayment $transaction): bool
    {
        return $transaction->subscription->user->is($user);
    }
}
