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
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function getNextPaymentDate(): Carbon
    {
        $start = Carbon::parse($this->start_date);
        $day = $start->day;
        $today = Carbon::today();

        $next = $start->copy();
        $next->settings([
            'monthOverflow' => false,
        ]);

        while ($next->lessThanOrEqualTo($today)) {
            $next = match ($this->frequency->value) {
                // move this to the enum
                'monthly' => $next->addMonth(),
                'quarterly' => $next->addMonths(3),
                'annually' => $next->addYear(),
                // default => throw new InvalidArgumentException('Invalid period'),
            };
        }
        $next->day(min($day, $next->daysInMonth));
        return $next;
    }

    public function getSubscriptionPeriods(): int
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::now();

        if($end->greaterThanOrEqualTo($start)){
            return match ($this->frequency->value) {
                // move this to the enum
                'monthly' => $start->diffInMonths($end)+1,
                'quarterly' => intdiv($start->diffInMonths($end), 3)+1,
                'annually' => $start->diffInYears($end)+1,
                // default => throw new InvalidArgumentException('Invalid subscription period'),
            };
        } else {
            return 0;
        }

    }
}
