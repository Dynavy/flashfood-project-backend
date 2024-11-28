<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;

    // Template food categories.
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
}
