<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Mexican Food', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'McDonald\'s', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'KFC', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Burger King', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}