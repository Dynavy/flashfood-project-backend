<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    // The name of the factory's corresponding model.
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * This method generates fake data for the `Review` model using the Faker library.
     * It assigns values to the review's restaurant, user, comment, and likes attributes.
     *
     * - `restaurant_id`: Randomly selects a restaurant from the database.
     * - `user_id`: Randomly selects a user from the database.
     * - `comment`: Generates a random paragraph for the review's comment.
     * - `likes`: Generates a random number between 0 and 1000 for the number of likes.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::inRandomOrder()->first()->id, // Select a random restaurant from the database.
            'user_id' => User::inRandomOrder()->first()->id, // Select a random user from the database.
            'comment' => $this->faker->paragraph(), // Generate a random paragraph as the comment text.
            'likes' => $this->faker->numberBetween(0, 1000), // Generate a random number for likes, between 0 and 1000.
        ];
    }

    /**
     * Create a fixed review for consistent testing.
     *
     * This method ensures that specific reviews always exist for testing purposes.
     *
     * @param array $attributes
     * @return static
     */
    public function fixedReview(array $attributes): self
    {
        return $this->state(fn() => array_merge([
            'restaurant_id' => $attributes['restaurant_id'] ?? Restaurant::inRandomOrder()->first()->id,
            'user_id' => $attributes['user_id'] ?? User::inRandomOrder()->first()->id,
            'comment' => $attributes['comment'] ?? $this->faker->paragraph(),
            'likes' => $attributes['likes'] ?? $this->faker->numberBetween(0, 1000),
        ], $attributes));
    }

}