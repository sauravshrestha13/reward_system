<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'name' => 'Purchased MacBook',
            'status' => 'Completed',
            'sale_amount' => 90000,
            'currency'=>'INR',
            'currency_value'=>0.014,
            'customer_id'=>2,
            'created_at' => '2020-05-18 14:30:56',
            'updated_at' => '2020-05-18 14:30:56',
        ]);

        DB::table('rewards')->insert([
            'expiry_date' => '2021-05-18 14:30:56',
            'expiry_status' => 'Active',
            'reward_amount' => round(90000*0.014),
            'order_id'=>1,
            'created_at' => '2020-05-18 14:30:56',
            'updated_at' => '2020-05-18 14:30:56',
        ]);

        DB::table('orders')->insert([
            'name' => 'Purchased IPhone',
            'status' => 'Completed',
            'sale_amount' => 500,
            'currency'=>'USD',
            'currency_value'=>1.0000,
            'customer_id'=>1,
            'created_at' => '2020-05-20 14:30:56',
            'updated_at' => '2020-05-20 14:30:56',
        ]);

        DB::table('rewards')->insert([
            'expiry_date' => '2021-05-20 14:30:56',
            'expiry_status' => 'Active',
            'reward_amount' => 500,
            'order_id'=>2,
            'created_at' => '2020-05-20 14:30:56',
            'updated_at' => '2020-05-20 14:30:56',
        ]);

        DB::table('orders')->insert([
            'name' => 'Purchased Steam Gift card $100',
            'status' => 'Completed',
            'sale_amount' => 100,
            'currency'=>'USD',
            'currency_value'=>1.0000,
            'customer_id'=>1,
            'created_at' => '2020-06-18 14:30:56',
            'updated_at' => '2020-06-18 14:30:56'
        ]);

        DB::table('rewards')->insert([
            'expiry_date' => '2021-06-18 14:30:56',
            'expiry_status' => 'Active',
            'reward_amount' => 100,
            'order_id'=>3,
            'created_at' => '2020-06-18 14:30:56',
            'updated_at' => '2020-06-18 14:30:56',
        ]);

        DB::table('orders')->insert([
            'name' => 'Purchased Play station',
            'status' => 'Completed',
            'sale_amount' => 50000,
            'currency'=>'NPR',
            'currency_value'=> 0.0085,
            'customer_id'=>3,
            'created_at' => '2020-09-18 14:30:56',
            'updated_at' => '2020-09-18 14:30:56'
        ]);

        DB::table('rewards')->insert([
            'expiry_date' => '2021-09-18 14:30:56',
            'expiry_status' => 'Active',
            'reward_amount' => round(50000*0.0085),
            'order_id'=>4,
            'created_at' => '2020-09-18 14:30:56',
            'updated_at' => '2020-09-18 14:30:56',
        ]);


        DB::table('orders')->insert([
            'name' => 'Purchased IPad',
            'status' => 'Completed',
            'sale_amount' => 60000,
            'currency'=>'NPR',
            'currency_value'=>0.0085,
            'customer_id'=>3,
            'created_at' => '2021-01-18 14:30:56',
            'updated_at' => '2021-01-18 14:30:56'
        ]);

        DB::table('rewards')->insert([
            'expiry_date' => '2022-01-18 14:30:56',
            'expiry_status' => 'Active',
            'reward_amount' => round(60000*0.0085),
            'order_id'=>5,
            'created_at' => '2021-01-18 14:30:56',
            'updated_at' => '2021-01-18 14:30:56',
        ]);

       
    }
}
