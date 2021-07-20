<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Interfaces\Document;
use HDSSolutions\Laravel\Traits\HasDocumentActions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Validator;

class Cash extends X_Cash implements Document {
    use HasDocumentActions { scopeOpen as scopeOpenTrait; }

    public function cashBook() {
        return $this->belongsTo(CashBook::class);
    }

    public function lines() {
        return $this->hasMany(CashLine::class)
            ->ordered();
    }

    public function getCurrencyIdAttribute() {
        return $this->cashBook->currency_id;
    }

    public function currency() {
        return $this->cashBook->currency();
    }

    // @override
    public function scopeOpen(Builder $query, CashBook|int|null $cashBook = null) {
        // get trait original scope query
        $query = $this->scopeOpenTrait($query);
        // append filter to only specific CashBook
        if ($cashBook !== null) $query->where('cash_book_id', $cashBook instanceof CashBook ? $cashBook->id : $cashBook);
        // return filtered query
        return $query;
    }

    public function scopeOfCashBook(Builder $query, CashBook $cashBook) {
        //
        return $query->where('cash_book_id', $cashBook->id);
    }

    protected function beforeSave(Validator $validator) {
        // check for open Cash
        if (!$this->exists && Cash::open($this->cashBook)->count() > 0)
            // return error
            $validator->errors()->add('cash_book_id', __('cash::cash.already-open', [ 'cashBook' => $this->cashBook->name ]));

        // get cashes of current CashBook
        if (!$this->exists && $cash = Cash::ofCashBook($this->cashBook)
            // only completed cash documents
            ->completed()
            // get last one
            ->latest()->first())

            // set Cash.start_balance and end_balance based on last completed Cash
            $this->start_balance = $this->end_balance = $cash->end_balance;
    }

    public function prepareIt():?string {
        // check if document has lines
        if (!$this->lines->count()) return $this->documentError( __('cash::cash.no-lines') );
        // return status InProgress
        return Document::STATUS_InProgress;
    }

    public function approveIt():bool {
        // mark document as approved
        return true;
    }

    public function rejectIt():bool {
        // mark document as rejected
        return true;
    }

    public function completeIt():?string {
        // check if the document is approved
        if (!$this->isApproved()) return $this->documentError( __('cash::cash.not-approved') );

        // TODO: completeIt() process
        return Document::STATUS_Completed;
    }

}
