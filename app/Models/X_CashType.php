<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_CashType extends Base\Model {

    protected $fillable = [
        'name',
        'transfer',
        'sign',
    ];

    protected $attributes = [
        'transfer'  => false,
    ];

    protected static $rules = [
        'name'      => [ 'required', 'min:5' ],
        'transfer'  => [ 'required', 'boolean' ],
        'sign'      => [ 'required', 'boolean' ],
    ];

}
