<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    // Template food categories.
    // A predefined list of food categories used to generate sample data for the application.
    private $categories = [
        'Mexican Food',
        'Chinese Food',
        'Japanese Cuisine',
        'Italian Cuisine',
        'Pizza',
        'Sushi',
        'Tacos',
        'Burgers',
        'McDonald\'s',
        'Burger King',
        'KFC',
    ];

    /**
     * Define the model's default state.
     *
     * This method generates a random category name from the predefined list and returns it as part of the category's data.
     * It also sets the created and updated timestamps.
     *
     * @return array
     */
    public function definition(): array
    {
        // Select a unique category index from the $categories array, ensuring no duplicates are selected by keeping track of previously used indices.  
        $category = $this->categories[$this->faker->unique()->numberBetween(int1: 0, int2: count(value: $this->categories) - 1)];

        return [
            'name' => $category,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a fixed category for consistent testing.
     *
     * This method ensures that specific categories always exist for testing purposes.
     *
     * @param string $name
     * @return static
     */
    public function fixedCategory(string $name): self
    {
        return $this->state(fn() => [
            'name' => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}