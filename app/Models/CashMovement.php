<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Interfaces\Document;
use HDSSolutions\Laravel\Traits\HasDocumentActions;

class CashMovement extends X_CashMovement implements Document {
    use HasDocumentActions;

    public function cash() {
        return $this->belongsTo(Cash::class);
    }

    public function toCash() {
        return $this->belongsTo(Cash::class, 'to_cash_id');
    }

    public function conversionRate() {
        return $this->belongsTo(ConversionRate::class);
    }

    public function prepareIt():?string {
        // both origin cash and destination cash must be open
        if ($this->cash->isProcessed() || $this->toCash->isProcessed())
            // return validation error
            return $this->documentError( __('cash::cashmovement.processed') );
        // return document InProgress
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
        if (!$this->isApproved()) return $this->documentError( __('cash::cashmovement.not-approved') );

        // create out movement on origin cash
        $out = $this->cash->lines()->create([
            'cash_type'     => CashLine::CASH_TYPE_TransferOut,
            'description'   => $this->description,
            'currency_id'   => $this->cash->currency_id, // TODO: Fix validation to allow beforeSave() before Validation->validate()
            'amount'        => $this->amount * -1, // negated amount since this is the origin
        ]);
        // create in movement on destination cash
        $in = $this->toCash->lines()->create([
            'cash_type'     => CashLine::CASH_TYPE_TransferIn,
            'description'   => $this->description,
            'currency_id'   => $this->toCash->currency_id, // TODO: Fix validation to allow beforeSave() before Validation->validate()
            'amount'        => $this->amount,
        ]);

        // check if movements got errors
        if (count($out->errors()) > 0 || count($in->errors()) > 0)
            // return document process error
            return $this->documentError( $out->errors()->first() ?: $in->errors()->first() );

        // link movements between them
        $out->referable()->associate( $in );
        $in->referable()->associate( $out );

        // save movements
        $out->save();
        $in->save();

        // re-check for errors
        if (count($out->errors()) > 0 || count($in->errors()) > 0)
            // return document process error
            return $this->documentError( $out->errors()->first() ?: $in->errors()->first() );

        // return document completed status
        return Document::STATUS_Completed;
    }

}
