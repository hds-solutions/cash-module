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

}
