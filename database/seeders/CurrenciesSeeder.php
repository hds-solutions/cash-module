<?php

namespace HDSSolutions\Finpar\Seeders;

use HDSSolutions\Finpar\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder {

    public function run() {
        // default currencies
        $currencies = [
            // eCommerce packages
            'PYG'   => 'Guaraníes',
            'USD'   => [ 'name' => 'Dólares', 'decimals' => 2 ],
        ];

        // create currencies
        $data = [];
        foreach ($currencies as $code => $name)
            if (is_array($name))
                $data[] = [ 'code' => $code ] + $name;
            else
                $data[] = [
                    'code'      => $code,
                    'name'      => $name,
                    'decimals'  => 0,
                ];

        // insert currencies
        Currency::insert($data);
    }

}
