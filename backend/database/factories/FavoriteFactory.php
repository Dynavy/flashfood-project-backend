<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {
        // Ensures user_id and restaurant_id use existing records or create new ones if none exist.
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'restaurant_id' => Restaurant::inRandomOrder()->value('id') ?? Restaurant::factory(),
        ];
    }
}