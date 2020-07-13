<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `pizza`.`currencies` */
        $currencies = array(
            array(
                'id' => '1',
                'name' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'precision' => '2',
                'thousand_separator' => ',',
                'decimal_separator' => '.'
            ),
            array(
                'id' => '2',
                'name' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'precision' => '2',
                'thousand_separator' => '.',
                'decimal_separator' => ','
            )
        );
        \Illuminate\Support\Facades\DB::table('currencies')
            ->insert($currencies);

    }
}
