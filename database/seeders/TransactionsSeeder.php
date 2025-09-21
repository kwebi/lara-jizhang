<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            'user_id' => 1,
            'amount' => 10.00,
            'type' => 'expense',
            'account_id' => 1,
            'category_id' => 1,
            'member_id' => null,
            'time' => now(),
            'note' => '午餐',
        ]);
        DB::table('transactions')->insert([
            'user_id' => 1,
            'amount' => 15.00,
            'type' => 'expense',
            'account_id' => 1,
            'category_id' => 1,
            'member_id' => null,
            'time' => now(),
            'note' => '水果',
        ]);
    }
}
