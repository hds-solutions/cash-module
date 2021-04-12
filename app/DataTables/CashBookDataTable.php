<?php

namespace HDSSolutions\Finpar\DataTables;

use HDSSolutions\Finpar\Models\CashBook as Resource;
use Yajra\DataTables\Html\Column;

class CashBookDataTable extends Base\DataTable {

    protected array $with = [
        'currency',
    ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.cash_books'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('cash::cash_book.id.0') )
                ->hidden(),

            Column::make('currency.name')
                ->title( __('cash::cash_book.currency_id.0') ),

            Column::make('name')
                ->title( __('cash::cash_book.name.0') ),

            Column::computed('actions'),
        ];
    }

}
