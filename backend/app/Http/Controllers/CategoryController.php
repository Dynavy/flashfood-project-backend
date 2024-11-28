<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // Get all resources (index).
    public function index()
    {
        // Empty method
    }

    // Get a specific resource by ID (show).
    public function show($id)
    {
        // Empty method
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50|unique:categories,name',
            ], [
                // Handles the different error messages.
                'name.required' => 'The category name is required.',
                'name.string' => 'The category name must be a string.',
                'name.max' => 'The category name should not exceed 50 characters.',
                'name.unique' => 'The category name must be unique.',
            ]);
            // Return a JSON response indicating failure
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
        // Create a new category using the validated data.
        $category = Category::create([
            'name' => $request->name,
        ]);

        // Return a JSON response indicating success.
        return response()->json([
            'message' => 'Category created successfully!',
            'category' => $category,
        ], 201);
    }

    // Update a specific resource (update).
    public function update(Request $request, $id)
    {
        // Empty method
    }

    // Delete a specific resource (destroy).
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            $categoryName = $category->name;

            $category->delete();

            return response()->json([
                'message' => "Category $categoryName with id $id deleted successfully."
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Category not found.'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}