<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'John',
            'currency'=>'USD',
            'credit' => 600,
        ]);
        DB::table('customers')->insert([
            'name' => 'Mary',
            'currency'=>'INR',
            'credit' => 1260,
        ]);
        DB::table('customers')->insert([
            'name' => 'Paul',
            'currency'=>'NPR',
            'credit' => 935,
        ]);
    }
}
