<?php

namespace App\Http\Controllers\Restaurant;

use App\Services\Category\CategoryService;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Inject the CategoryService into the controller.
    public function __construct(private CategoryService $categoryService) {}

    // Retrieve and return a list of all categories.
    public function index()
    {
        $categories = $this->categoryService->index();

        return response()->json([
            'message' => 'Categories retrieved successfully!',
            'categories' => $categories,
        ], 200);
    }

    // Retrieve and return a category by its ID.
    public function show($id)
    {
        $category = $this->categoryService->showByID($id);

        return response()->json([
            'message' => 'Category retrieved successfully!',
            'category' => $category,
        ], 200);
    }

    // Find and return a category by its name.
    public function findByName($name)
    {
        $categoryName = $this->categoryService->findByName($name);
        return response()->json([
            'message' => 'Category retrieved successfully!',
            'status' => 'success',
            'data' => $categoryName
        ], 200);
    }

    // Create a new category and return the created category.
    public function store(CategoryRequest $request)
    {
        // Delegate the creation logic to the service layer.
        $category = $this->categoryService->store($request->validated());

        return response()->json([
            'message' => 'Category created successfully!',
            'category' => $category,
        ], 201);
    }

    // Update an existing category and return the updated information.
    public function update(CategoryRequest $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $nameChange = $this->categoryService->update($id, $validatedData);

        return response()->json([
            'message' => "The category has been successfully updated from '{$nameChange['old_name']}' to '{$nameChange['new_name']}'."
        ], 200);
    }

    // Delete a category by its ID.
    public function destroy($id)
    {
        // Delegate the deletion logic to the service layer.
        $categoryName = $this->categoryService->destroy($id);

        return response()->json([
            'message' => "Category $categoryName with id $id deleted successfully."
        ], 200);
    }
}
