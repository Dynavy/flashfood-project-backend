<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class CategoryService
{
    public function store(array $data): Category
    {
        // Validate the Category name and set up personalized validation messages.
        $validator = Validator::make($data, [
            'name' => 'required|string|max:50|unique:categories,name',
        ], [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a string.',
            'name.max' => 'The category name should not exceed 50 characters.',
            'name.unique' => 'The category name must be unique.',
        ]);

        // Handle validation failures
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Category::create($validator->validated());
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