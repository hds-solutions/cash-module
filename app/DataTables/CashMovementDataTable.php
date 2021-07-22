<?php

namespace HDSSolutions\Laravel\DataTables;

use HDSSolutions\Laravel\Models\CashMovement as Resource;
use HDSSolutions\Laravel\Traits\DatatableAsDocument;
use HDSSolutions\Laravel\Traits\DatatableWithCurrency;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class CashMovementDataTable extends Base\DataTable {
    use DatatableAsDocument;
    use DatatableWithCurrency;

    protected array $with = [
        'cash.cashBook.currency',
        'toCash.cashBook.currency',
        'conversionRate',
    ];

    protected array $orderBy = [
        'document_status'   => 'asc',
        'created_at'        => 'desc',
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

            Column::make('created_at')
                ->title( __('cash::cash_movement.created_at.0') )
                ->renderRaw('datetime:created_at;F j, Y H:i'),

            Column::make('cash.cash_book.name')
                ->title( __('cash::cash_movement.cash_id.0') ),

            Column::make('to_cash.cash_book.name')
                ->title( __('cash::cash_movement.to_cash_id.0') ),

            Column::make('amount')
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

    protected function joins(Builder $query):Builder {
        // add custom JOIN to CashBook.currency
        return $query
            // join to Cash
            ->join('cashes', 'cashes.id', 'cash_movements.cash_id')
                // join to CashBook
                ->join('cash_books', 'cash_books.id', 'cashes.cash_book_id')
            // join to CashTo
            ->join('cashes as to_cashes', 'to_cashes.id', 'cash_movements.to_cash_id')
                // join to CashBook
                ->join('cash_books as to_cash_books', 'to_cash_books.id', 'to_cashes.cash_book_id');
    }

    protected function orderCashCashBookName(Builder $query, string $order):Builder {
        // add custom orderBy for column CashBook.name
        return $query->orderBy('cash_books.name', $order);
    }

    protected function searchCashCashBookName(Builder $query, string $value):Builder {
        // return custom search for CashBook.name
        return $query->where('cash_books.name', 'like', "%$value%");
    }

    protected function filterCashBook(Builder $query, $cash_book_id):Builder {
        // filter only from CashBook
        return $query->where('cash_books.id', $cash_book_id);
    }

    protected function orderToCashCashBookName(Builder $query, string $order):Builder {
        // add custom orderBy for column ToCashBook.name
        return $query->orderBy('to_cash_books.name', $order);
    }

    protected function searchToCashCashBookName(Builder $query, string $value):Builder {
        // return custom search for ToCashBook.name
        return $query->where('to_cash_books.name', 'like', "%$value%");
    }

    protected function filterToCashBook(Builder $query, $cash_book_id):Builder {
        // filter only from CashBook
        return $query->where('to_cash_books.id', $cash_book_id);
    }

}
