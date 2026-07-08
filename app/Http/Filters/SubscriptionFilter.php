<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionFilter
{
    public function apply(HasMany $query, array $filters): HasMany
    {
        $sort = $filters['sort'] ?? 'start_date';
        $direction = $filters['direction'] ?? 'desc';

        return $query
            ->when(
                isset($filters['frequency']) && $filters['frequency'] !== '',
                fn ($q) => $q->where('frequency', $filters['frequency'])
            )
            ->when(
                isset($filters['status']) && $filters['status'] !== '',
                fn ($q) => $q->where('status', $filters['status'])
            )
            ->when(
                $filters['min_price'] ?? null,
                fn ($q, $price) => $q->where('price', '>=', $price)
            )
            ->when(
                $filters['max_price'] ?? null,
                fn ($q, $price) => $q->where('price', '<=', $price)
            )
            ->orderBy($sort, $direction);
    }
}
