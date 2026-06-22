<?php

namespace App\Models;

use App\Enums\SubscriptionCurrency;
use App\Enums\SubscriptionFrequency;
use App\Enums\SubscriptionStatus;
use Database\Factories\SubscriptionFactory;
use Illuminate\Database\Eloquent\Attributes\Guarded;
// use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;

// #[Unguarded]
#[Guarded([])]
class Subscription extends Model
{
    /** @use HasFactory<SubscriptionFactory> */
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'status' => SubscriptionStatus::class,
        'frequency' => SubscriptionFrequency::class,
        'currency' => SubscriptionCurrency::class,
        'price' => 'decimal:2',
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

    public function payments(): HasMany
    {
        return $this->hasMany(SubscriptionPayment::class);
    }

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

    public function getNextPaymentDate(): Carbon
    {
        $start = Carbon::parse($this->start_date);
        $day = $start->day;

        $next = $start->copy();
        $next->settings([
            'monthOverflow' => false,
        ]);

        while ($next->lessThan(Carbon::today())) {
            $next->addMonth($this->frequency->numOfMonths());
        }
        return $next->day(min($day, $next->daysInMonth));
    }

    public function getSubscriptionPeriods(): int
    {
        return $this->payments()->where('confirmed', 1)->count();
    }

    public function getSubscriptionTotal(): string
    {
        return $this->payments()->where('confirmed', 1)->sum('price');

        // $payments = $this->payments()->where('confirmed', 1)->get();
        // return $payments->reduce(function($sum, $payment){
        //     return $sum + $payment->price;
        // });
    }
}
