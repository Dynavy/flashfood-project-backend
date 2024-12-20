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

    /**
     * Define the model's default state.
     *
     * This method generates fake data for the `Offer` model using the Faker library.
     * It assigns values to the offer's restaurant, name, description, popularity, 
     * status, and valid dates.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Select a random restaurant ID from the database.
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,

            //'user_id' => User::inRandomOrder()->first()->id, // This line is commented out for now.

            'name' => $this->faker->sentence, // Generate a random sentence for the offer's name.
            'description' => $this->faker->paragraph, // Generate a random paragraph for the offer's description.
            'popularity' => $this->faker->numberBetween(0, 100), // Generate a random number for the popularity (between 0 and 100).
            'status' => $this->faker->randomElement(['active', 'expired']), // Randomly select the status ('active' or 'expired').
            'valid_from' => $this->faker->date(), // Generate a random valid-from date.
            'valid_until' => $this->faker->date(), // Generate a random valid-until date.
        ];
    }

    /**
     * Create a fixed offer for consistent testing.
     *
     * This method ensures that specific offers always exist for testing purposes.
     *
     * @param array $attributes
     * @return static
     */
    public function fixedOffer(array $attributes): self
    {
        return $this->state(fn() => array_merge([
            'restaurant_id' => $attributes['restaurant_id'],
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'popularity' => $attributes['popularity'] ?? 0,
            'status' => $attributes['status'] ?? 'active',
            'valid_from' => $attributes['valid_from'] ?? now(),
            'valid_until' => $attributes['valid_until'] ?? now()->addDays(7),
        ], $attributes));
    }

}