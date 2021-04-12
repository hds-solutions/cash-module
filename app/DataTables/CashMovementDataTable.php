<?php

namespace HDSSolutions\Finpar\DataTables;

use HDSSolutions\Finpar\Models\CashMovement as Resource;
use Yajra\DataTables\Html\Column;

class CashMovementDataTable extends Base\DataTable {

    protected array $with = [
        'cash.cashBook.currency',
        'toCash.cashBook.currency',
        'conversionRate',
    ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.cashmovements'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('cash::cashmovement.id.0') )
                ->hidden(),

            Column::computed('created_at')
                ->title( __('cash::cashmovement.created_at.0') )
                ->renderRaw('datetime:created_at;F j, Y H:i'),

            Column::make('cash.cash_book.name')
                ->title( __('cash::cashmovement.cash.0') ),

            Column::make('to_cash.cash_book.name')
                ->title( __('cash::cashmovement.toCash.0') ),

            Column::computed('amount')
                ->title( __('cash::cashmovement.amount.0') )
                ->renderRaw('view:cashmovement')
                ->data( view('cash::cashmovements.datatable.amount')->render() ),

            Column::make('description')
                ->title( __('cash::cashmovement.description.0') ),

            Column::make('document_status')
                ->title( __('cash::cashmovement.document_status.0') ),

            Column::computed('actions'),
        ];
    }

}
