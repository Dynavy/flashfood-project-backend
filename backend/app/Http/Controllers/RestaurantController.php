<?php

namespace App\Http\Controllers;

use App\Services\Restaurant\RestaurantService;
use App\Http\Requests\RestaurantRequest;

class RestaurantController extends Controller
{
    // Inject RestaurantService into the controller.
    public function __construct(private RestaurantService $restaurantService) {}

    // Retrieve and return a paginated list of all restaurants.
    public function index()
    {
        $restaurants = $this->restaurantService->index()->paginate(50);
        return response()->json([
            'message' => 'Restaurants retrieved successfully!',
            'status' => 'success',
            'data' => $restaurants
        ], 200);
    }

    // Retrieve and return a restaurant by its ID.
    public function show($id)
    {
        $restaurant = $this->restaurantService->showByID($id);
        return response()->json([
            'message' => 'Restaurant retrieved successfully!',
            'status' => 'success',
            'data' => $restaurant
        ], 200);
    }

    // Search and return a restaurant by its name.
    public function findByName($name)
    {
        $restaurantName = $this->restaurantService->findByName($name);
        return response()->json([
            'message' => 'Restaurant retrieved successfully!',
            'status' => 'success',
            'data' => $restaurantName
        ], 200);
    }

    // Create and store a new restaurant.
    public function store(RestaurantRequest $request)
    {
        // Delegate creation logic to the service layer.
        $restaurant = $this->restaurantService->store($request->validated());
        return response()->json([
            'message' => 'Restaurant created successfully!',
            'restaurant' => $restaurant,
        ], status: 201);
    }

    // Update a specific restaurant by its ID.
    public function update(RestaurantRequest $request, $id)
    {
        $restaurant = $this->restaurantService->update($id, $request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'Restaurant updated successfully!',
            'data' => $restaurant,
        ], status: 200);
    }

    // Delete a specific restaurant by its ID.
    public function destroy($id)
    {
        // Delegate deletion logic to the service layer.
        $restaurantName = $this->restaurantService->destroy($id);

        return response()->json([
            'message' => "Restaurant $restaurantName with id $id deleted successfully."
        ], 200);
    }
}
