<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

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
            $category = $this->categoryService->show($id);

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
    public function store(Request $request)
    {
        try {
            // Delegate the creation logic to the service layer.
            $category = $this->categoryService->store($request->all());

            return response()->json([
                'message' => 'Category created successfully!',
                'category' => $category,
            ], 201);

            // Status 422  --> server can't process the request, although it understands it.
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return a JSON response indicating validation failure
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'An error occurred while creating the category.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Update a specific category (update).
    public function update(Request $request, $id)
    {
        // Empty method
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