<?php

namespace HDSSolutions\Finpar\Models;

use App\Models\Base\Model;

abstract class X_Currency extends Model {

    protected $attributes = [
        'decimals'  => 0,
    ];

    protected $fillable = [
        'name',
        'code',
        'decimals',
    ];

    protected static $createRules = [
        'name'      => [ 'required', 'min:5' ],
        'code'      => [ 'required', 'min:3' ],
        'decimals'  => [ 'required', 'numeric', 'min:0' ],
    ];

    protected static $updateRules = [
        'name'      => [ 'required', 'min:5' ],
        'code'      => [ 'required', 'min:3' ],
        'decimals'  => [ 'required', 'numeric', 'min:0' ],
    ];

}
