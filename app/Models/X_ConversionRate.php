<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_ConversionRate extends Base\Model {
    use BelongsToCompany;

    protected $orderBy = [
        'valid_from'    => 'ASC',
        'valid_until'   => 'ASC',
    ];

    protected $fillable = [
        'company_id',
        'currency_id',
        'to_currency_id',
        'rate',
        'valid_from',
        'valid_until',
    ];

    protected static $rules = [
        'currency_id'       => [ 'required' ],
        'to_currency_id'    => [ 'required' ],
        'rate'              => [ 'required', 'numeric', 'min:0' ],
        'valid_from'        => [ 'required', 'datetime' ],
        'valid_until'       => [ 'required', 'datetime' ],
    ];

}
