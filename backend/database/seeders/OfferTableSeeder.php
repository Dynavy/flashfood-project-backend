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
        // Creates an offer with a fixed name 'Test' for testing purposes.
        Offer::factory()->fixedOffer([
            'restaurant_id' => 1,
            'name' => 'Test',
            'description' => 'This is a fixed test offer for consistent testing.',
        ])->create();

        Offer::factory(10)->create();
    }
}