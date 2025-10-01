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
            'time' => now()->subDays(random_int(1, 600)),
            'note' => '午餐',
        ]);
        DB::table('transactions')->insert([
            'user_id' => 1,
            'amount' => 15.00,
            'type' => 'expense',
            'account_id' => 1,
            'category_id' => 1,
            'member_id' => null,
            'time' => now()->subDays(random_int(1, 600)),
            'note' => '水果',
        ]);
        DB::table('transactions')->insert([
            'user_id' => 1,
            'amount' => 118.00,
            'type' => 'expense',
            'account_id' => 1,
            'category_id' => 2,
            'member_id' => null,
            'time' => now()->subDays(random_int(1, 600)),
            'note' => '打车',
        ]);
        DB::table('transactions')->insert([
            'user_id' => 1,
            'amount' => 28.00,
            'type' => 'expense',
            'account_id' => 1,
            'category_id' => 2,
            'member_id' => null,
            'time' => now()->subDays(random_int(1,600)),
            'note' => '打车',
        ]);
    }
}
