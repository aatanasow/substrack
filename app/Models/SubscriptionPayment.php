<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Guarded([])]
#[Table('subscriptions_payments')]
class SubscriptionPayment extends Model
{
    protected $casts = [
        'payment_date' => 'date',
        'confirmed' => 'boolean',
    ];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
