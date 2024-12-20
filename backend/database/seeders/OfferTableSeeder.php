<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;

class OfferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Offer::factory()->fixedOffer([
            'restaurant_id' => 1,
            'name' => 'Test Offer',
            'description' => 'This is a fixed test offer for consistent testing.',
        ])->create();
        Offer::factory(50)->create();
    }
}