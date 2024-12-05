<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class CategoryService
{
    public function index(): array
    {
        $categories = Category::all();

        return $categories->toArray();
    }

    public function showByID(int $id): array
    {
        $category = Category::findOrFail($id);

        return $category->toArray();
    }

    public function store(array $data): Category
    {
        return Category::create($data);
    }

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

    public function destroy(int $id): string
    {
        $category = Category::findOrFail($id);

        // Store the Category name that has been deleted.
        $categoryName = $category->name;

        $category->delete();

        return $categoryName;
    }
}