<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restaurant;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition()
    {
        // Template information for Restaurants.
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'google_place_id' => $this->faker->unique()->word,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'rating' => $this->faker->randomFloat(1, 0, 5),
        ];
    }
}