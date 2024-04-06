<?php

namespace App\Helper;

use NumberFormatter;

class Currency
{
    public function __invoke(...$params)
    {
        return static::format(...$params);
    }
    public static function format($value)
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        $currency = null;
        if (config('app.locale') === 'en') {
            $currency = "EGP";
        }
        if (config('app.locale') === 'ar') {
            $currency = "EGP";
        }
        return $formatter->formatCurrency($value, $currency);
    }
}
