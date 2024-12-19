<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restaurant;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * This method generates fake data for the `Restaurant` model using the Faker library.
     * It assigns values to the restaurant's name, address, latitude, longitude,
     * google place ID, phone number, website, and rating.
     *
     * @return array
     */
    public function definition()
    {
        // Template information for Restaurants.
        return [
            'name' => $this->faker->company, // Generate a random company name for the restaurant.
            'address' => $this->faker->address, // Generate a random address for the restaurant.
            'latitude' => $this->faker->latitude, // Generate a random latitude value.
            'longitude' => $this->faker->longitude, // Generate a random longitude value.
            'google_place_id' => $this->faker->unique()->word, // Generate a unique word for the Google place ID.
            'phone' => $this->faker->numerify('9########'), // Generate a random phone number (9 digits).
            'website' => $this->faker->url, // Generate a random URL for the restaurant's website.
            'rating' => $this->faker->randomFloat(1, 0, 5), // Generate a random rating between 0 and 5 with 1 decimal point.
        ];
    }
}