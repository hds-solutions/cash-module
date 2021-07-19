<?php

namespace HDSSolutions\Finpar\Models;

abstract class X_Currency extends Base\Model {

    protected $attributes = [
        'decimals'  => 0,
    ];

    protected $fillable = [
        'name',
        'code',
        'decimals',
    ];

    protected static $rules = [
        'name'      => [ 'required', 'min:5' ],
        'code'      => [ 'required', 'min:3' ],
        'decimals'  => [ 'required', 'numeric', 'min:0' ],
    ];

    public function getIsCurrentAttribute():bool {
        // return if this currency is the current in use
        return $this->id == backend()->currency()?->getKey();
    }

}
