<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'name' => 'USD',
            'value' => '1.0000',
        ]);
        DB::table('currencies')->insert([
            'name' => 'NPR',
            'value' => '0.0085',
        ]);
        DB::table('currencies')->insert([
            'name' => 'INR',
            'value' => '0.014',
        ]);
    }
}
