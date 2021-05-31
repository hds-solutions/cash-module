<?php

namespace HDSSolutions\Finpar\Seeders;

class CashPermissionsSeeder extends Base\PermissionsSeeder {

    public function __construct() {
        parent::__construct('cash');
    }

    protected function permissions():array {
        return [
            $this->resource('currencies'),
            $this->resource('cash_books'),
            $this->resource('cashes'),
            $this->document('cashes'),
            $this->resource('cashmovements'),
            $this->document('cashmovements'),
        ];
    }

    protected function afterRun():void {
        // create Casher role
        $this->role('Cashier', [
            'currencies.*',
            'cash_books.*',
            'cashes.*',
            'cashmovements.*',
        ]);
    }

}
