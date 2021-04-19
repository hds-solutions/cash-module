<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_Cash extends Base\Model {
    use BelongsToCompany;

    protected $orderBy = [
        'document_completed_at',
    ];

    protected $attributes = [
        'end_balance'   => 0,
    ];

    protected $fillable = [
        'cash_book_id',
        'start_balance',
        'end_balance',
    ];

    protected static $rules = [
        'cash_book_id'  => [ 'required' ],
        'start_balance' => [ 'required', 'numeric' ],
        'end_balance'   => [ 'required', 'numeric' ],
    ];

}
