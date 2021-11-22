<?php

namespace HDSSolutions\Laravel\DataTables;

use HDSSolutions\Laravel\Models\Cash as Resource;
use HDSSolutions\Laravel\Traits\DatatableWithCurrency;
use HDSSolutions\Laravel\Traits\DatatableAsDocument;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class CashDataTable extends Base\DataTable {
    use DatatableWithCurrency;
    use DatatableAsDocument;

    protected array $with = [
        'cashBook.currency',
    ];

    protected array $orderBy = [
        'document_status'       => 'asc',
        'document_completed_at' => 'desc',
        // 'created_at'            => 'desc',
        // 'description'           => 'asc',
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

            Column::make('document_status_pretty')
                ->title( __('cash::cash.document_status.0') ),

            Column::computed('actions'),
        ];
    }

    protected function joins(Builder $query):Builder {
        // add custom JOIN to CashBook.currency
        return $query
            // join to CashBook
            ->join('cash_books', 'cash_books.id', 'cashes.cash_book_id')
            // join to currency
            ->join('currencies', 'currencies.id', 'cash_books.currency_id');
    }

    protected function orderCashBookName(Builder $query, string $order):Builder {
        // add custom orderBy for column CashBook.name
        return $query->orderBy('cash_books.name', $order);
    }

    protected function searchCashBookName(Builder $query, string $value):Builder {
        // return custom search for CashBook.name
        return $query->where('cash_books.name', 'like', "%$value%");
    }

    protected function filterCashBook(Builder $query, $cash_book_id):Builder {
        // filter only from CashBook
        return $query->where('cash_book_id', $cash_book_id);
    }

    protected function orderCashBookCurrencyName(Builder $query, string $order):Builder {
        // add custom orderBy for column Currency.name
        return $query->orderBy('currencies.name', $order);
    }

    protected function searchCashBookCurrencyName(Builder $query, string $value):Builder {
        // return custom search for CashBook.name
        return $query->where('currencies.name', 'like', "%$value%");
    }

}
