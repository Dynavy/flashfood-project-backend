<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RestaurantService;
use App\Models\Restaurant;


class RestaurantController extends Controller
{
    protected $restaurantService;

    // Inject CategoryService.
    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    // Create a specific category (create).
    public function store(Request $request)
    {
        try {
            // Delegate the creation logic to the service layer.
            $restaurant = $this->restaurantService->store($request->all());

            return response()->json([
                'message' => 'Restaurant created successfully!',
                'category' => $restaurant,
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
                'message' => 'An error occurred while creating the restaurant.',
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
            $restaurantData = $this->restaurantService->destroy($id);

            return response()->json([
                'message' => "Restaurant '{$restaurantData['name']}' located at '{$restaurantData['address']}' has been deleted successfully."
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => "Restaurant with id $id not found."
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the Restaurant.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
