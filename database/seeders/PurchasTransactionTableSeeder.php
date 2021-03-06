<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_transaction')->insert([
            'customer_id' => 1,
            'total_spent' => 20,
            'total_saving' => 0,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ]);
        DB::table('purchase_transaction')->insert([
            'customer_id' => 1,
            'total_spent' => 30,
            'total_saving' => 0,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ]);
        DB::table('purchase_transaction')->insert([
            'customer_id' => 1,
            'total_spent' => 60,
            'total_saving' => 0,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ]);
    }
}
