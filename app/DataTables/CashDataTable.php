<?php

namespace HDSSolutions\Finpar\DataTables;

use HDSSolutions\Finpar\Models\Cash as Resource;
use Yajra\DataTables\Html\Column;

class CashDataTable extends Base\DataTable {

    protected array $with = [
        'cashBook.currency',
    ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.cashes'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('cash::cash.id.0') )
                ->hidden(),

            Column::make('cash_book.name')
                ->title( __('cash::cash.cash_book_id.0') ),

            Column::make('description')
                ->title( __('cash::cash.description.0') ),

            Column::make('cash_book.currency.name')
                ->title( __('cash::cash.currency_id.0') ),

            Column::make('start_balance')
                ->title( __('cash::cash.start_balance.0') )
                ->renderRaw('view:cash')
                ->data( view('cash::cashes.datatable.start_balance')->render() ),

            Column::make('end_balance')
                ->title( __('cash::cash.end_balance.0') )
                ->renderRaw('view:cash')
                ->data( view('cash::cashes.datatable.end_balance')->render() ),

            Column::make('document_status')
                ->title( __('cash::cash.document_status.0') ),

            Column::computed('actions'),
        ];
    }

}
