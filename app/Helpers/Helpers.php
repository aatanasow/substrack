<?php

namespace App\Helpers;

use NumberFormatter;

class Helpers
{
    public static function formatPrice(float|int|string $amount, string $currency): string
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);

        return $formatter->formatCurrency((float) $amount, $currency);
    }

    // public static function formatPrice(float $price, SubscriptionCurrency $currency)
    // {
    //     return Number::withCurrency($currency->value, function () use ($price) {
    //         return Number::currency($price);
    //     });
    // }

    public static function formatDifference(float|int|string $amount1, float|int|string $amount2): string
    {
        if ($amount1 == 0) {
            return '+100%';
        }

        $sign = '';
        if ($amount2 - $amount1 > 0) {
            $sign = '+';
        } elseif ($amount2 - $amount1 < 0) {
            $sign = '-';
        }

        return $sign.round(abs($amount2 - $amount1) / $amount1 * 100).'%';

    }
}
