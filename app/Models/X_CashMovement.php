<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Traits\BelongsToCompany;

abstract class X_CashMovement extends Base\Model {
    use BelongsToCompany;

    protected $fillable = [
        'company_id',
        'cash_id',
        'to_cash_id',
        'amount',
        'conversion_rate_id',
        'rate',
        'description',
    ];

    protected static $rules = [
        'cash_id'               => [ 'required' ],
        'to_cash_id'            => [ 'required' ],
        'amount'                => [ 'required', 'numeric', 'min:0' ],
        'conversion_rate_id'    => [ 'sometimes', 'nullable' ],
        'rate'                  => [ 'sometimes', 'nullable', 'numeric', 'min:0' ],
        'description'           => [ 'required' ],
    ];

}
