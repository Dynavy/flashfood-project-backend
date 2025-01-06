<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryService
{
    /**
     * Retrieve all categories from the database.
     *
     * This method fetches all the categories from the database and returns them as an array.
     *
     * @return array
     */
    public function index(): array
    {
        $categories = Category::all();

        return $categories->toArray();
    }

    /**
     * Retrieve a specific category by its ID.
     *
     * This method fetches a category by its ID from the database.
     * If the category doesn't exist, it will throw a ModelNotFoundException.
     *
     * @param int $id
     * @return array
     */
    public function showByID(int $id): array
    {
        $category = Category::findOrFail($id);

        return $category->toArray();
    }

    /**
     * Find a category by its name.
     *
     * This method retrieves a category using the 'name' attribute. 
     * If the category doesn't exist, it throws a ModelNotFoundException.
     *
     * @param string $name
     * @return Category
     */
    public function findByName($name)
    {
        return Category::where('name', $name)->firstOrFail();
    }

    /**
     * Store a new category in the database.
     *
     * This method creates a new category using the data provided and saves it in the database.
     *
     * @param array $data
     * @return Category
     */
    public function store(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update an existing category by its ID.
     *
     * This method finds a category by its ID and updates it with the new data.
     * It returns both the old and new names of the category.
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data): array
    {
        $category = Category::findOrFail($id);

        $oldName = $category->name;

        $category->update($data);

        return [
            'old_name' => $oldName,
            'new_name' => $category->name,
        ];
    }

    /**
     * Delete a category by its ID.
     *
     * This method deletes a category and returns its name before deletion.
     *
     * @param int $id
     * @return string
     */
    public function destroy(int $id): string
    {
        $category = Category::findOrFail($id);

        // Store the Category name that has been deleted.
        $categoryName = $category->name;

        $category->delete();

        return $categoryName;
    }
}
