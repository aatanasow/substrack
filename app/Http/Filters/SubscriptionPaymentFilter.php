<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SubscriptionPaymentFilter
{
    public function apply(HasManyThrough $query, array $filters): HasManyThrough
    {
        $sort = $filters['sort'] ?? 'payment_date';
        $direction = $filters['direction'] ?? 'desc';

        return $query
            ->when(
                $filters['subscription_id'] ?? null,
                fn ($q, $id) => $q->where('subscription_id', $id)
            )
            ->when(
                isset($filters['confirmed']) && $filters['confirmed'] !== '',
                fn ($q) => $q->where('confirmed', $filters['confirmed'])
            )
            ->when(
                $filters['min_price'] ?? null,
                fn ($q, $price) => $q->where('subscriptions_payments.price', '>=', $price)
            )
            ->when(
                $filters['max_price'] ?? null,
                fn ($q, $price) => $q->where('subscriptions_payments.price', '<=', $price)
            )
            ->orderBy($sort, $direction);
    }
}
