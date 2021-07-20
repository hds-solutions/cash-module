<?php

use HDSSolutions\Laravel\Models\Currency;

if (! function_exists('amount')) {
    function amount($amount, int|Currency $currency, bool $raw = false) {
        // load currency
        $currency = $currency instanceof Currency ? $currency : currency($currency);
        // return formated amount
        return $currency->code.' '.number($raw ? ($amount ?? 0) : ($amount ?? 0) / pow(10, $currency->decimals ?? 0), $currency->decimals);
    }
}

if (!function_exists('currency')) {
    function currency(int $currency_id):Currency {
        // get cached currencies
        return backend()->currencies()->firstWhere('id', $currency_id);
    }
}
