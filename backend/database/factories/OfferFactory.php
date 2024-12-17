<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class OfferFactory extends Factory
{
    protected $model = Offer::class;

    public function definition()
    {
        return [
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
            //'user_id' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'popularity' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['active', 'expired']),
            'valid_from' => $this->faker->date(),
            'valid_until' => $this->faker->date(),
        ];
    }
}
