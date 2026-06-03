<?php

namespace App\Models;

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
    ];

    protected $attributes = [
        'status' => SubscriptionStatus::ACTIVE->value,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function formatDate(Carbon $value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d');
    // }

    public function formatPrice(float $price, string $currency)
    {
        return Number::withCurrency($currency, function () use ($price) {
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
