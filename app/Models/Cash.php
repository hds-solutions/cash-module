<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Interfaces\Document;
use HDSSolutions\Finpar\Traits\HasDocumentActions;
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
    public function scopeOpen(Builder $query, ?CashBook $cashBook = null) {
        // get trait original scope query
        $query = $this->scopeOpenTrait($query);
        // append filter to only specific CashBook
        if ($cashBook !== null) $query->where('cash_book_id', $cashBook->id);
        // return filtered query
        return $query;
    }

    protected function beforeSave(Validator $validator) {
        // check for open Cash
        if (!$this->exists && Cash::open($this->cashBook)->count() > 0)
            // return error
            $validator->errors()->add('cash_book_id', __('cash::cash.already-open', [ 'cashBook' => $this->cashBook->name ]));
    }

    public function prepareIt():?string {
        // check if document has lines
        if (!$this->lines->count()) return $this->documentError( __('cash::cash.no-lines') );
        // return status InProgress
        return Document::STATUS_InProgress;
    }

    public function completeIt():?string {
        // TODO: completeIt() process
        return null;
    }

}
