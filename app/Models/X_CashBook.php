<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Traits\BelongsToCompany;

abstract class X_CashBook extends Base\Model {
    use BelongsToCompany;

    protected $orderBy = [
        'name'  => 'ASC',
    ];

    protected $fillable = [
        'company_id',
        'currency_id',
        'name',
        'is_public',
    ];

    protected static $rules = [
        'currency_id'   => [ 'required' ],
        'name'          => [ 'required', 'min:5' ],
        'is_public'     => [ 'required', 'boolean' ],
    ];

    protected $attributes = [
        'is_public'     => true,
    ];

}
