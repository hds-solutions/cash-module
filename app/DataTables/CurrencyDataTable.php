<?php

namespace HDSSolutions\Laravel\DataTables;

use HDSSolutions\Laravel\Models\Currency as Resource;
use Yajra\DataTables\Html\Column;

class CurrencyDataTable extends Base\DataTable {

    protected array $orderBy = [
        'name'  => 'asc',
    ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.currencies'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('cash::currency.id.0') )
                ->hidden(),

            Column::make('name')
                ->title( __('cash::currency.name.0') ),

            Column::make('code')
                ->title( __('cash::currency.code.0') ),

            Column::make('decimals')
                ->title( __('cash::currency.decimals.0') )
                ->sortable(false),

            Column::computed('actions'),
        ];
    }

}
