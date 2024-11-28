<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    // Get all resources (index).
    public function index() {
        // Empty method
    }

    // Get a specific resource by ID (show).
    public function show($id) {
        // Empty method
    }

    public function store(Request $request) {

        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        // Create a new category using the validated data.
        $category = Category::create([
            'name' => $validated['name'],
        ]);

         // Return a JSON response indicating success.
         return response()->json([
            'message' => 'Category created successfully!',
            'category' => $category,
        ], 201);
    }

    // Update a specific resource (update).
    public function update(Request $request, $id) {
        // Empty method
    }

    // Delete a specific resource (destroy).
    public function destroy($id) {
        // Empty method
    }
}
