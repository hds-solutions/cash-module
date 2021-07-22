<?php

namespace HDSSolutions\Laravel\DataTables;

use HDSSolutions\Laravel\Models\CashBook as Resource;
use HDSSolutions\Laravel\Traits\DatatableWithCurrency;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class CashBookDataTable extends Base\DataTable {
    use DatatableWithCurrency;

    protected array $with = [
        'currency',
    ];

    protected array $orderBy = [
        'name'          => 'asc',
        'currency.name' => 'asc',
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

            Column::make('name')
                ->title( __('cash::cash_book.name.0') ),

            Column::make('currency.name')
                ->title( __('cash::cash_book.currency_id.0') ),

            Column::computed('actions'),
        ];
    }

    protected function joins(Builder $query):Builder {
        // add custom JOIN to currencies
        return $query->join('currencies', 'currencies.id', 'cash_books.currency_id');
    }

}
