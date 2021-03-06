<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'first_name' => "Sigit",
            'last_name' => "Prasetyo",
            'gender' => "male",
            'date_of_birth' => "1992-07-10",
            'contact_number' => "081265177731",
            'email' => "m.sigit.pr@gmail.com",
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ]);
    }
}
