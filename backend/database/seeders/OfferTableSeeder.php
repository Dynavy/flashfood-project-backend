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
        Offer::factory(50)->create();
    }
}