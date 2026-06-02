<?php

namespace App;

enum SubscriptionStatus: string
{
    case ACTIVE = "active";
    case PAUSED = "paused";
    case CANCELED = "canceled";

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::PAUSED => 'Paused',
            self::CANCELED => 'Canceled',
        };
    }
}
