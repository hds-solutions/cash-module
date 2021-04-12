<?php

namespace HDSSolutions\Finpar\Models;

class CashBook extends X_CashBook {

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function cashes() {
        return $this->hasMany(Cash::class);
    }

}
