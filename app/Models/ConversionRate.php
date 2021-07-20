<?php

namespace HDSSolutions\Laravel\Models;

use Illuminate\Database\Eloquent\Builder;

class ConversionRate extends X_ConversionRate {

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function toCurrency() {
        return $this->belongsTo(Currency::class, 'to_currency_id');
    }

    public function scopeFor(Builder $query, Currency $from, Currency $to) {
        // filter currencies
        return $query
            ->whereIn('currency_id', [ $from->id, $to->id ])
            ->orWhereIn('to_currency_id', [ $from->id, $to->id ]);
    }

    public function scopeValid(Builder $query) {
        // filter valid range
        return $query
            ->where('valid_from', '<', now())
            ->where('valid_until', '>', now());
    }

}
