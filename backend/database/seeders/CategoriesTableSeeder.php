<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creates a category with a fixed name 'Test' for testing purposes.
        Category::factory()->fixedCategory('Test')->create();
        
        Category::factory(10)->create();
    }
}