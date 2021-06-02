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
            route('backend.cash_movements'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('cash::cash_movement.id.0') )
                ->hidden(),

            Column::computed('created_at')
                ->title( __('cash::cash_movement.created_at.0') )
                ->renderRaw('datetime:created_at;F j, Y H:i'),

            Column::make('cash.cash_book.name')
                ->title( __('cash::cash_movement.cash_id.0') ),

            Column::make('to_cash.cash_book.name')
                ->title( __('cash::cash_movement.to_cash_id.0') ),

            Column::computed('amount')
                ->title( __('cash::cash_movement.amount.0') )
                ->renderRaw('view:cash_movement')
                ->data( view('cash::cash_movements.datatable.amount')->render() ),

            Column::make('description')
                ->title( __('cash::cash_movement.description.0') ),

            Column::make('document_status_pretty')
                ->title( __('cash::cash_movement.document_status.0') ),

            Column::computed('actions'),
        ];
    }

}
