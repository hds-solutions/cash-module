<?php return [
    // used on cash module main navigation
    'nav'   => 'Caja',

    'cash_book_id'      => [
        'Libro de Caja',
        '_' => 'Libro de Caja',
        '?' => 'Libro de Caja help text',
    ],

    'description'       => [
        'Descripción',
        '_' => 'Descripción',
        '?' => 'Descripción help text',
    ],

    'currency_id'       => [
        'Moneda',
        '_' => 'Moneda',
        '?' => 'Moneda help text',
    ],

    'start_balance'     => [
        'Balance Inicial',
        '_' => 'Balance Inicial',
        '?' => 'Balance Inicial help text',
    ],

    'balance'           => [
        'Balance',
        '_' => 'Balance',
        '?' => 'Balance help text',
    ],

    'end_balance'       => [
        'Balance Cierre',
        '_' => 'Balance Cierre',
        '?' => 'Balance Cierre help text',
    ],

    'document_status'  => [
        'Estado del Documento',
        '_' => 'Estado del Documento',
        '?' => 'Estado del Documento help text',
    ],

    'details'   => [
        'Detalles'
    ],

    'lines'     => [
        'Líneas',
        '_' => 'Líneas',
        '?' => 'Líneas help text',

    ] + __('cash::cash_line'),

];
