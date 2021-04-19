<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_CashLine extends Base\Model {
    use BelongsToCompany;

    const CASH_TYPE_TransferIn              = 'T+';
    const CASH_TYPE_TransferOut             = 'T-';
    const CASH_TYPE_Difference              = 'DF';
    const CASH_TYPE_CreditNote              = 'CN';
    const CASH_TYPE_EmployeeAnticipation    = 'EA';
    const CASH_TYPE_GeneralExpense          = 'GE';
    const CASH_TYPE_Invoice                 = 'IN';
    const CASH_TYPES = [
        self::CASH_TYPE_TransferIn              => 'cash::cash_line.cash_type.transfer_in',
        self::CASH_TYPE_TransferOut             => 'cash::cash_line.cash_type.transfer_out',
        self::CASH_TYPE_Difference              => 'cash::cash_line.cash_type.difference',
        self::CASH_TYPE_CreditNote              => 'cash::cash_line.cash_type.credit_note',
        self::CASH_TYPE_EmployeeAnticipation    => 'cash::cash_line.cash_type.employee_anticipation',
        self::CASH_TYPE_GeneralExpense          => 'cash::cash_line.cash_type.general_expense',
        self::CASH_TYPE_Invoice                 => 'cash::cash_line.cash_type.invoice',
    ];

    protected $orderBy = [
        'created_at'    => 'ASC',
    ];

    protected $fillable = [
        'company_id',
        'cash_id',
        'cash_type',
        'currency_id',
        'amount',
        'description',
        'cash_lineable_type',
        'cash_lineable_id',
    ];

    protected static $rules = [
        'cash_id'       => [ 'required' ],
        'cash_type'     => [ 'required' ],
        'currency_id'   => [ 'required' ],
        'amount'        => [ 'required', 'numeric' ],
        'description'   => [ 'required' ],
        'cash_lineable_type'    => [ 'sometimes', 'nullable' ],
        'cash_lineable_id'      => [ 'sometimes', 'nullable' ],
    ];

    public final function setCashTypeAttribute(string $cash_type):void {
        // validate attribute
        if (!array_key_exists($cash_type, self::CASH_TYPES)) return;
        // set attribute
        $this->attributes['cash_type'] = $cash_type;
    }

}
