<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => '餐饮',
            'type' => 'expense',
        ]);
        DB::table('categories')->insert([
            'id' => 2,
            'user_id' => 1,
            'name' => '交通',
            'type' => 'expense',
        ]);
    }
}
