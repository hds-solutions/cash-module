<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_CashLine extends Base\Model {
    use BelongsToCompany;

    protected $orderBy = [
        'created_at'    => 'ASC',
    ];

    protected $fillable = [
        'company_id',
        'cash_id',
        'cash_type_id',
        'currency_id',
        'amount',
        'description',
        'cash_lineable_type',
        'cash_lineable_id',
    ];

    protected static $rules = [
        'cash_id'       => [ 'required' ],
        'cash_type_id'  => [ 'required' ],
        'currency_id'   => [ 'required' ],
        'amount'        => [ 'required', 'numeric' ],
        'description'   => [ 'required' ],
        'cash_lineable_type'    => [ 'sometimes', 'nullable' ],
        'cash_lineable_id'      => [ 'sometimes', 'nullable' ],
    ];

}
