<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\HasDocumentActions;
use Illuminate\Validation\Validator;

class CashLine extends X_CashLine {

    public function getNetAmountAttribute():int {
        //
        if ($this->currency_id === $this->cash->currency_id) return $this->attributes['amount'];
        // get conversion rates for currencies
        $rates = ConversionRate::for($this->currency, $this->cash->currency)->valid()->get();
        // use conversion rate where currency is from (multiply)
        if ($conversion = $rates->firstWhere('currency_id', $this->currency_id))
            //
            $amount = $this->attributes['amount'] * $conversion->rate;
        // use conversion rate where currency is to (divide)
        elseif ($conversion = $rates->firstWhere('to_currency_id', $this->currency_id))
            //
            $amount = $this->attributes['amount'] / $conversion->rate;
        //
        return ($amount ?? 0)
            / pow(10, $this->currency->decimals)
            * pow(10, $this->cash->currency->decimals);
    }

    public function cash() {
        return $this->belongsTo(Cash::class);
    }

    public function cashType() {
        return $this->belongsTo(CashType::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function referable() {
        return $this->morphTo();
    }

    public function beforeSave(Validator $validator) {
        // set currency from header if not set
        if ($this->currency_id === null) $this->currency()->associate( $this->cash->currency );
    }

    public function afterSave() {
        // update cash ending balande
        $this->cash->update([ 'end_balance' => $this->cash->lines->sum('amount') ]);
    }

}
