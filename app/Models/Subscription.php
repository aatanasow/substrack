<?php

namespace App\Models;

use App\SubscriptionCurrency;
use App\SubscriptionFrequency;
use App\SubscriptionStatus;
use Database\Factories\SubscriptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;

class Subscription extends Model
{
    /** @use HasFactory<SubscriptionFactory> */
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'status' => SubscriptionStatus::class,
        'frequency' => SubscriptionFrequency::class,
        'currency' => SubscriptionCurrency::class,
    ];

    protected $attributes = [
        'status' => SubscriptionStatus::ACTIVE->value,
        'frequency' => SubscriptionFrequency::MONTHLY->value,
        'currency' => SubscriptionCurrency::EUR->value,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function formatDate(Carbon $value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d');
    // }

    public static function formatPrice(float $price, SubscriptionCurrency $currency)
    {
        return Number::withCurrency($currency->value, function () use ($price) {
            return Number::currency($price);
        });
    }

    public static function statusCount(User $user): Collection
    {

        // select status, count(*) from ideas group by status;
        $counts = $user->subscriptions()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return collect(SubscriptionStatus::cases())
            ->mapWithKeys(fn ($status) => [
                $status->value => $counts->get($status->value, 0),
            ])
            ->put('all', $user->subscriptions()->count());

    }

}
