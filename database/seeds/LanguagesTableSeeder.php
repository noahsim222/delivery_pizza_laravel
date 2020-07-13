<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* `pizza`.`currencies` */
        $languages = array(
            array(
                'id' => '1',
                'name' => 'English',
                'code' => 'en',
            ),
            array(
                'id' => '2',
                'name' => 'German',
                'code' => 'de'
            )
        );
        \Illuminate\Support\Facades\DB::table('languages')
            ->insert($languages);

    }
}
