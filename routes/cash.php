<?php

use HDSSolutions\Finpar\Http\Controllers\{
    CurrencyController,
    CashBookController,
    CashController,
    CashMovementController,
};
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

    Route::resource('cash_books',       CashBookController::class,  $name_prefix)
        ->parameters([ 'cash_books' => 'resource' ])
        ->name('index', 'backend.cash_books');

    Route::resource('cashes',           CashController::class,      $name_prefix)
        ->parameters([ 'cashes' => 'resource' ])
        ->name('index', 'backend.cashes');
    Route::post('cashes/{resource}/process',        [ CashController::class, 'processIt' ])
        ->name('backend.cashes.process');

    Route::resource('conversion_rates', ConversionRatesController::class,   $name_prefix)
        ->parameters([ 'conversion_rates' => 'resource' ])
        ->name('index', 'backend.conversion_rates');

    Route::resource('cashmovements',    CashMovementController::class,      $name_prefix)
        ->parameters([ 'cashmovements' => 'resource' ])
        ->name('index', 'backend.cashmovements');
    Route::post('cashmovements/{resource}/process', [ CashMovementController::class, 'processIt' ])
        ->name('backend.cashmovements.process');

});
