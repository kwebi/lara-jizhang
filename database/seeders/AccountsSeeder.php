<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->insert([
            'user_id' => 1,
            'name' => '现金',
            'type' => 'cash',
            'balance' => 0,
        ]);
        DB::table('accounts')->insert([
            'user_id' => 1,
            'name' => '支付宝',
            'type' => 'alipy',
            'balance' => 0,
        ]);
    }
}
