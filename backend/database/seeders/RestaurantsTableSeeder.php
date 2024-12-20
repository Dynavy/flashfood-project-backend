<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::factory()->fixedRestaurant([
            'name' => 'Test Restaurant',
            'address' => '123 Test Street',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
            'google_place_id' => 'test_google_place_id',
            'phone' => '912345678',
            'website' => 'https://testrestaurant.com',
            'rating' => 4.5,
        ])->create();
        Restaurant::factory(10)->create();
    }
}