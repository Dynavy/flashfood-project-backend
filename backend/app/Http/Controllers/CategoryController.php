<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    protected $categoryService;

    // Inject CategoryService.
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->index();

        return response()->json([
            'message' => 'Categories retrieved successfully!',
            'categories' => $categories,
        ], 200);
    }

    public function show($id)
    {
        try {
            $category = $this->categoryService->showByID($id);

            return response()->json([
                'message' => 'Category retrieved successfully!',
                'category' => $category,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => "Category with id $id not found.",
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while retrieving the category.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Create a specific category (create).
    public function store(CategoryRequest $request)
    {
        try {
            // Delegate the creation logic to the service layer.
            $category = $this->categoryService->store($request->validated());

            return response()->json([
                'message' => 'Category created successfully!',
                'category' => $category,
            ], 201);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'An error occurred while creating the category.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Update a specific category (update).
    public function update(CategoryRequest $request, int $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $nameChange = $this->categoryService->update($id, $validatedData);

            return response()->json([
                'message' => "The category has been successfully updated from '{$nameChange['old_name']}' to '{$nameChange['new_name']}'."
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Category not found.'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Delete a specific resource (destroy).
    public function destroy($id)
    {
        try {
            // Delegate the deletion logic to the service layer.
            $categoryName = $this->categoryService->destroy($id);

            return response()->json([
                'message' => "Category $categoryName with id $id deleted successfully."
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => "Category with id $id not found."
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}