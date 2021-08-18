<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Traits\BelongsToCompany;

abstract class X_Cash extends Base\Model {
    use BelongsToCompany;

    protected $orderBy = [
        'document_completed_at' => 'DESC',
        'created_at'            => 'DESC',
    ];

    protected $attributes = [
        'start_balance' => 0,
        'end_balance'   => 0,
    ];

    protected $fillable = [
        'cash_book_id',
        'description',
        'start_balance',
        'end_balance',
    ];

    protected static $rules = [
        'cash_book_id'  => [ 'required' ],
        'description'   => [ 'required' ],
        'start_balance' => [ 'required', 'numeric' ],
        'end_balance'   => [ 'required', 'numeric' ],
    ];

    public function getStartBalanceAttribute():int|float {
        return $this->attributes['start_balance'] / pow(10, currency($this->cashBook->currency_id)->decimals);
    }

    public function setStartBalanceAttribute(int|float $start_balance) {
        $this->attributes['start_balance'] = $start_balance * pow(10, currency($this->cashBook->currency_id)->decimals);
    }

    public function getEndBalanceAttribute():int|float {
        return $this->attributes['end_balance'] / pow(10, currency($this->cashBook->currency_id)->decimals);
    }

    public function setEndBalanceAttribute(int|float $end_balance) {
        $this->attributes['end_balance'] = $end_balance * pow(10, currency($this->cashBook->currency_id)->decimals);
    }

}
