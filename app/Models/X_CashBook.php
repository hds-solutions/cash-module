<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_CashBook extends Base\Model {
    use BelongsToCompany;

    protected $fillable = [
        'company_id',
        'currency_id',
        'name',
    ];

    protected static $rules = [
        'currency_id'   => [ 'required' ],
        'name'          => [ 'required', 'min:5' ],
    ];

}
