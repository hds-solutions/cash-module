<?php

use HDSSolutions\Finpar\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'        => config('backend.prefix'),
    'middleware'    => [ 'web', 'auth:'.config('backend.guard') ],
], function() {
    // name prefix
    $name_prefix = [ 'as' => 'backend' ];

    Route::resource('currencies',       CurrencyController::class,  $name_prefix)
        ->parameters([ 'currencies' => 'resource' ])
        ->name('index', 'backend.currencies');

});