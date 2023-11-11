<?php

namespace App\Helper;

use NumberFormatter;

class Currency
{
    public function __invoke(...$params)
    {
        return static::format(...$params);
    }
    public static function format($value, $currency = null)
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        if ($currency === null) {
            $currency = config('app.currency', 'USD');
        }
        return $formatter->formatCurrency($value, $currency);
    }
}
