<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Traits\BelongsToCompany;

abstract class X_CashLine extends Base\Model {
    use BelongsToCompany;

    const CASH_TYPE_TransferIn              = 'T+';
    const CASH_TYPE_TransferOut             = 'T-';
    const CASH_TYPE_Difference              = 'DF';
    const CASH_TYPE_CreditNote              = 'CN';
    const CASH_TYPE_EmployeeSalary          = 'ES';
    const CASH_TYPE_EmployeeAnticipation    = 'EA';
    const CASH_TYPE_EmployeeDiscount        = 'ED';
    const CASH_TYPE_GeneralExpense          = 'GE';
    const CASH_TYPE_Invoice                 = 'IN';
    const CASH_TYPE_Receipment              = 'RE';
    const CASH_TYPE_BankDeposit             = 'BD';
    const CASH_TYPES = [
        self::CASH_TYPE_TransferIn              => 'cash::cash_line.cash_type.transfer_in',
        self::CASH_TYPE_TransferOut             => 'cash::cash_line.cash_type.transfer_out',
        self::CASH_TYPE_Difference              => 'cash::cash_line.cash_type.difference',
        self::CASH_TYPE_CreditNote              => 'cash::cash_line.cash_type.credit_note',
        self::CASH_TYPE_EmployeeSalary          => 'cash::cash_line.cash_type.employee_salary',
        self::CASH_TYPE_EmployeeAnticipation    => 'cash::cash_line.cash_type.employee_anticipation',
        self::CASH_TYPE_EmployeeDiscount        => 'cash::cash_line.cash_type.employee_discount',
        self::CASH_TYPE_GeneralExpense          => 'cash::cash_line.cash_type.general_expense',
        self::CASH_TYPE_Invoice                 => 'cash::cash_line.cash_type.invoice',
        self::CASH_TYPE_Receipment              => 'cash::cash_line.cash_type.receipment',
        self::CASH_TYPE_BankDeposit             => 'cash::cash_line.cash_type.bank_deposit',
    ];

    protected $orderBy = [
        'transacted_at' => 'DESC',
    ];

    protected $fillable = [
        'company_id',
        'cash_id',
        'cash_type',
        'currency_id',
        'amount',
        'description',
        'transacted_at',
        'cash_lineable_type',
        'cash_lineable_id',
        'partnerable_type',
        'partnerable_id',
    ];

    protected static $rules = [
        'cash_id'       => [ 'required' ],
        'cash_type'     => [ 'required' ],
        'currency_id'   => [ 'required' ],
        'amount'        => [ 'required', 'numeric' ],
        'description'   => [ 'required' ],
        'transacted_at' => [ 'required', 'date', 'before_or_equal:now' ],
        'cash_lineable_type'    => [ 'sometimes', 'nullable' ],
        'cash_lineable_id'      => [ 'sometimes', 'nullable' ],
        'partnerable_type'      => [ 'sometimes', 'nullable' ],
        'partnerable_id'        => [ 'sometimes', 'nullable' ],
    ];

    public final function setCashTypeAttribute(string $cash_type):void {
        // validate attribute
        if (!array_key_exists($cash_type, self::CASH_TYPES)) return;
        // set attribute
        $this->attributes['cash_type'] = $cash_type;
    }

    public function getAmountAttribute():int|float {
        return $this->attributes['amount'] / pow(10, currency($this->currency_id)->decimals);
    }

    public function setAmountAttribute(int|float $amount) {
        $this->attributes['amount'] = $amount * pow(10, currency($this->currency_id)->decimals);
    }

}
