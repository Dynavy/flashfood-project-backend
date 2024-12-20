<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::factory()->fixedReview([
            'restaurant_id' => 1,
            'user_id' => 1,
            'comment' => 'This is a fixed test review.',
            'likes' => 100,
        ])->create();

        Review::factory()->count(50)->create();
    }
}