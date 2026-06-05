<?php

namespace App;

enum SubscriptionFrequency: string
{
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case ANNUALLY = 'annually';
    case ONETIME = 'onetime';

    public function label(): string
    {
        return match ($this) {
            self::MONTHLY => 'Monthly',
            self::QUARTERLY => 'Quarterly',
            self::ANNUALLY => 'Annually',
            self::ONETIME => 'One-time',
        };
    }

    public static function values(): array
    {
        return array_map(fn (SubscriptionFrequency $status) => $status->value, self::cases());
    }

    public static function options(): array
    {
        return collect(SubscriptionFrequency::cases())
            ->mapWithKeys(fn ($option) => [
                $option->value => $option->label()
            ])->toArray();
    }
}
