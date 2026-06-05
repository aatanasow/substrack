<?php

namespace App;

enum SubscriptionCurrency: string
{
    case USD = 'usd';
    case EUR = 'eur';
    case BGN = 'bgn';
    case GBP = 'gbp';

    public function label(): string
    {
        return match ($this) {
            self::USD => 'USD',
            self::EUR => 'EUR',
            self::BGN => 'BGN',
            self::GBP => 'GBP',
        };
    }

    public static function values(): array
    {
        return array_map(fn (SubscriptionCurrency $status) => $status->value, self::cases());
    }

    public static function options(): array
    {
        return collect(SubscriptionCurrency::cases())
            ->mapWithKeys(fn ($option) => [
                $option->value => $option->label()
            ])->toArray();
    }
}
