<?php

use HDSSolutions\Finpar\Models\Currency;

if (! function_exists('amount')) {
    function amount($amount, Currency $currency) {
        // return formated amount
        return $currency->code.' '.number(($amount ?? 0) / pow(10, $currency->decimals ?? 0), $currency->decimals);
    }
}
