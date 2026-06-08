<?php

namespace App\Enums;

enum SubscriptionStatus: string
{
    case ACTIVE = 'active';
    case PAUSED = 'paused';
    case CANCELED = 'canceled';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::PAUSED => 'Paused',
            self::CANCELED => 'Canceled',
        };
    }

    public static function values(): array
    {
        return array_map(fn (SubscriptionStatus $status) => $status->value, self::cases());
    }

    public static function options(): array
    {
        return collect(SubscriptionStatus::cases())
            ->mapWithKeys(fn ($option) => [
                $option->value => $option->label(),
            ])->toArray();
    }
}
