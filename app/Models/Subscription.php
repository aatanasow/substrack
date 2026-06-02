<?php

namespace App\Models;

use App\SubscriptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'status' => SubscriptionStatus::class,
    ];

    protected $attributes = [
        'status' => SubscriptionStatus::ACTIVE->value,
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessor to format the date
    public function getBirthDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
